<?php

namespace app\controllers;

use app\core\Request;
use app\database\Filters;
use app\database\models\Category;
use app\database\Pagination;
use app\support\Auth;
use app\support\Csrf;
use app\support\Flash;
use app\support\Validate;

class CategoryController extends Controller 
{
    public function show() 
    {
        if (Auth::isAdmin()) {

            if(array_key_exists('search', $_GET)) {
                $search = strip_tags($_GET['search']);
                
                $filters = new Filters;
                $pagination = new Pagination;
                $pagination->setItemsPerPage(200);

                $category = new Category;
                $category->setFilters($filters);
                $category->setPagination($pagination);
                $categories = $category->where('nome', $search);
            }else {
                $filters = new Filters;
                $pagination = new Pagination;
                $pagination->setItemsPerPage(6);

                $category = new Category;
                $category->setFilters($filters);
                $category->setPagination($pagination);
                $categories = $category->all();
            }

            $this->view('admin/category/categories', ['categories' => $categories, 'pagination' => $pagination]);
        }else {
            redirect('/');
        }
    }

    public function create() 
    {
        if (Auth::isAdmin()) {
            $this->view('admin/category/create');
        }else {
            redirect('/');
        }
    }

    public function edit() 
    {
        if (Auth::isAdmin()) {

            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                $category = new Category;
                $category = $category->findBy('id', $id);
                
                if ($category) {
                    $this->view('admin/category/edit', ['category' => $category]);
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
        ]);

        if ($validated) {
            $name = Request::input('nome');
            $slug = str_replace(' ', '-',trim(mb_strtolower($name), '-'));
            $data = [
                'nome' => $name,
                'slug' => $slug
            ];
            
            $category = new Category;
            $updated = $category->update('id', $id, $data);

            if ($updated) {
                Flash::set('success', 'Categoria atualizada com sucesso!');
                redirect('/editcategory?id='.$id);
            } else {
                Flash::set('error', 'Ocorreu um erro tente novamente!');
                redirect('/editcategory?id='.$id);
            }
        }else {
            redirect('/editcategory?id='.$id);
        }
    }

    public function store() 
    {
        Csrf::validateToken();

        $validate = new Validate;
        $validated = $validate->validate([
            'nome' => 'required',
        ]);

        if ($validated) {
            $name = Request::input('nome');
            $slug = str_replace(' ', '-',trim(mb_strtolower($name), '-'));
            $data = [
                'nome' => $name,
                'slug' => $slug
            ];
            
            $category = new Category;
            $ceated = $category->create($data);

            if ($ceated) {
                Flash::set('success', 'Categoria criada com sucesso!');
                back();
            } else {
                Flash::set('error', 'Ocorreu um erro tente novamente!');
                back();
            }
        }else {
            back();
        }
    }

    public function delete($id) 
    {
        $id = strip_tags($id[0]);
        
        if ($id) {
            $category = new Category;
            $deleted = $category->delete('id', $id);

            if($deleted) {
                Flash::set('success', "Categoria ({$id}) excluida com sucesso!");
                back();
            }else {
                Flash::set('error', 'Ocorreu um erro ao excluir! Tente novamente.');
                back();
            }
        }else {
            Flash::set('error', 'Ocorreu um erro ao excluir!');
            back();
        }
    }
}