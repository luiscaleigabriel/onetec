<?php

namespace app\controllers;

use app\core\Request;
use app\database\Filters;
use app\database\models\Category;
use app\database\models\SubCategory;
use app\database\Pagination;
use app\support\Auth;
use app\support\Csrf;
use app\support\Flash;
use app\support\Validate;

class SubCategoryController extends Controller 
{
    public function show() 
    {
        if (Auth::isAdmin()) {

            if(array_key_exists('search', $_GET)) {
                $search = strip_tags($_GET['search']);
            
                $filters = new Filters;
                $pagination = new Pagination;
                $pagination->setItemsPerPage(200);

                $subcategory = new SubCategory;
                $subcategory->setFilters($filters);
                $subcategory->setPagination($pagination);
                $subcategories = $subcategory->where('nome', $search);
            }else {
                $filters = new Filters;
                $pagination = new Pagination;
                $pagination->setItemsPerPage(6);

                $subcategory = new SubCategory;
                $subcategory->setFilters($filters);
                $subcategory->setPagination($pagination);
                $subcategories = $subcategory->all();
            }

            $category = new Category;
            $categories = $category->all();

            $this->view('admin/subcategory/index', ['subcategories' => $subcategories, 'pagination' => $pagination, 'categories' => $categories]);
        }else {
            redirect('/');
        }
    }

    public function create() 
    {
        if (Auth::isAdmin()) {
            $category = new Category;
            $categories = $category->all();

            $this->view('admin/subcategory/create', ['categories' => $categories]);
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
            'categoria' => 'required'
        ]);

        if ($validated) {
            $name = Request::input('nome');
            $slug = str_replace(' ', '-',trim(mb_strtolower($name), '-'));
            $idcategoria = Request::input('categoria');
            $data = [
                'nome' => $name,
                'slug' => $slug,
                'idcategoria' => $idcategoria
            ];
            
            $subcategory = new SubCategory;
            $ceated = $subcategory->create($data);

            if ($ceated) {
                Flash::set('success', 'SubCategoria criada com sucesso!');
                back();
            } else {
                Flash::set('error', 'Ocorreu um erro tente novamente!');
                back();
            }
        }else {
            back();
        }
    }

    public function edit() 
    {
        if (Auth::isAdmin()) {

            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $subcategory = new SubCategory;
                $subcategory = $subcategory->findBy('id', $id);

                $category = new Category;
                $categories = $category->all();
                
                if ($category) {
                    $this->view('admin/subcategory/edit', ['subcategory' => $subcategory, 'categories' => $categories]);
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
            'categoria' => 'required'
        ]);

        if ($validated) {
            $name = Request::input('nome');
            $slug = str_replace(' ', '-',trim(mb_strtolower($name), '-'));
            $idcategoria = Request::input('categoria');
            $data = [
                'nome' => $name,
                'slug' => $slug,
                'idcategoria' => $idcategoria
            ];
            
            $subcategory = new SubCategory;
            $updated = $subcategory->update('id', $id, $data);

            if ($updated) {
                Flash::set('success', 'SubCategoria atualizada com sucesso!');
                redirect('/editsubcategory?id='.$id);
            } else {
                Flash::set('error', 'Ocorreu um erro tente novamente!');
                redirect('/editsubcategory?id='.$id);
            }
        }else {
            redirect('/editsubcategory?id='.$id);
        }
    }

    public function delete($id) 
    {
        $id = strip_tags($id[0]);
        
        if ($id) {
            $subcategory = new SubCategory;
            $deleted = $subcategory->delete('id', $id);

            if($deleted) {
                Flash::set('success', "SubCategoria ({$id}) excluida com sucesso!");
                back();
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