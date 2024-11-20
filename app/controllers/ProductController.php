<?php

namespace app\controllers;

use app\core\Request;
use app\database\Filters;
use app\database\models\Category;
use app\database\models\Product;
use app\database\models\SubCategory;
use app\database\Pagination;
use app\support\Auth;
use app\support\Csrf;
use app\support\Flash;
use app\support\Upload;
use app\support\Validate;

class ProductController extends Controller 
{
    public function show() 
    {
        if (Auth::isAdmin()) {

            if(array_key_exists('search', $_GET)) {
                $search = strip_tags($_GET['search']);
                
                $filters = new Filters;
                $pagination = new Pagination;
                $pagination->setItemsPerPage(200);

                $product = new Product;
                $product->setFilters($filters);
                $product->setPagination($pagination);
                $products = $product->where('nome', $search);
            }else {
                $filters = new Filters;
                $pagination = new Pagination;
                $pagination->setItemsPerPage(8);

                $product = new Product;
                $product->setFilters($filters);
                $product->setPagination($pagination);
                $products = $product->all();
            }

            $category = new Category;
            $categories = $category->all();

            $subcategory = new SubCategory;
            $subcategories = $subcategory->all();

            $this->view('admin/product/show', [
                'products' => $products, 
                'pagination' => $pagination,
                'categories' => $categories,
                'subcategories' => $subcategories
            ]);
        }else {
            redirect('/');
        }
    }

    public function details() 
    {
        if (array_key_exists('product', $_GET)) {
            $id = strip_tags($_GET['product']);

            $product = new Product;
            $product = $product->findBy('id', $id);

            $filters = new Filters;
            $filters->where('idsubcategoria', '=', $product->idsubcategoria);
            $filters->limit(10);

            $products = new Product;
            $products->setFilters($filters);
            $products = $products->all();

            if($product) {
                $this->view('product', [
                    'product' => $product,
                    'products' => $products
                ]);
            }else {
                redirect('/');
            }
            
        }else {
            redirect('/');
        }
    }

    public function create() 
    {
        if (Auth::isAdmin()) {
            $category = new Category;
            $categories = $category->all();

            $subcategory = new SubCategory;
            $subcategories = $subcategory->all();

            $this->view('admin/product/create', [
                'categories' => $categories,
                'subcategories' => $subcategories
            ]);
        }else {
            redirect('/');
        }
    }

    public function store() 
    {
        Csrf::validateToken();

        $validate = new Validate;
        $validated = $validate->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required',
            'preco_anterior' => 'required',
            'quantidade' => 'required',
            'categoria' => 'required',
            'subcategoria' => 'required'
        ]);

       if($_FILES['image']['name'] != '') {
            $image = Upload::uploadFile('image', './assets/images/product/');

            if ($validated) {
                $name = Request::input('nome');
                $slug = str_replace(' ', '-',trim(mb_strtolower($name), '-'));
                $data = [
                    'nome' => Request::input('nome'),
                    'slug' => $slug,
                    'descricao' => Request::input('descricao'),
                    'image' => './assets/images/product/'.$image,
                    'preco' => Request::input('preco'),
                    'preco_anterior' => Request::input('preco_anterior'),
                    'quantidade' => Request::input('quantidade'),
                    'popular' => Request::input('popular'),
                    'idcategoria' => Request::input('categoria'),
                    'idsubcategoria' => Request::input('subcategoria'),
                ];
                
                $product = new Product;
                $ceated = $product->create($data);

                if ($ceated) {
                    Flash::set('success', 'Produto criada com sucesso!');
                    back();
                } else {
                    Flash::set('error', 'Ocorreu um erro tente novamente!');
                    back();
                }
            }else {
                back();
            }
        }else {
            Flash::set('image', "Esse campo é obrigatório");
            back();
        }

    }

    public function edit() 
    {
        if (Auth::isAdmin()) {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $product = new Product;
                $product = $product->findBy('id', $id);

                $category = new Category;
                $categories = $category->all();

                $subcategory = new SubCategory;
                $subcategories = $subcategory->all();
                
                if ($product) {
                    $this->view('admin/product/edit', [
                        'product' => $product,
                        'categories' => $categories,
                        'subcategories' => $subcategories
                    ]);
                }else {
                    back();
                }
            }else {
                back();
            }
        }else {
            redirect('/');
        }
    }

    public function update($id) 
    {
        Csrf::validateToken();
        $id = $id[0];

        $validate = new Validate;
        $validated = $validate->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required',
            'preco_anterior' => 'required',
            'quantidade' => 'required',
            'categoria' => 'required',
            'subcategoria' => 'required'
        ]);

        $image = '';
        $deleteImage = true;
        $name = Request::input('nome');
        $slug = str_replace(' ', '-',trim(mb_strtolower($name), '-'));
        if($_FILES['image']['name'] != '') {
            $image = Upload::uploadFile('image', './assets/images/product/');
            $data = [
                'nome' => Request::input('nome'),
                'slug' => $slug,
                'descricao' => Request::input('descricao'),
                'image' => './assets/images/product/'.$image,
                'preco' => Request::input('preco'),
                'preco_anterior' => Request::input('preco_anterior'),
                'quantidade' => Request::input('quantidade'),
                'popular' => Request::input('popular'),
                'idcategoria' => Request::input('categoria'),
                'idsubcategoria' => Request::input('subcategoria'),
            ];
        }else {
            $deleteImage = false;
            $product = new Product;
            $image = $product->findBy('id', $id);
            $image = $image->image;
            $data = [
                'nome' => Request::input('nome'),
                'slug' => $slug,
                'descricao' => Request::input('descricao'),
                'image' => $image,
                'preco' => Request::input('preco'),
                'preco_anterior' => Request::input('preco_anterior'),
                'quantidade' => Request::input('quantidade'),
                'popular' => Request::input('popular'),
                'idcategoria' => Request::input('categoria'),
                'idsubcategoria' => Request::input('subcategoria'),
            ];
        }

        if ($validated) {
            $product = new Product;
            $image = $product->findBy('id', $id);
            $image = $image->image;
            $updated = $product->update('id', $id, $data);

            if ($updated) {
                if($deleteImage) {
                    Upload::removeFile($image);
                }
                
                Flash::set('success', 'Produto criada com sucesso!');
                redirect('/editproduct?id='.$id);
            } else {
                Flash::set('error', 'Ocorreu um erro tente novamente!');
                redirect('/editproduct?id='.$id);
            }
        }else {
            redirect('/editproduct?id='.$id);
        }
    }

    public function delete($id) 
    {
        $id = strip_tags($id[0]);
        
        if ($id) {
            $product = new Product;
            $image = $product->findBy('id', $id);
            $image = $image->image;
            $deleted = $product->delete('id', $id);

            if($deleted) {
                if(Upload::removeFile($image)) {
                    Flash::set('success', "Produto ({$id}) excluido com sucesso!");
                    back();
                }
            }else {
                Flash::set('error', 'Ocorreu um erro ao excluir! Tente novamente.');
                back();
            }
        }else {
            Flash::set('error', 'Ocorreu um erro ao excluir! Tente novamente.');
            back();
        }
    }
}