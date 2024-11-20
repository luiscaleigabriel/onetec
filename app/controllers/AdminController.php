<?php

namespace app\controllers;

use app\core\Request;
use app\database\Filters;
use app\database\models\User;
use app\database\Pagination;
use app\support\Auth;
use app\support\Csrf;
use app\support\Flash;
use app\support\Upload;
use app\support\Validate;

class AdminController extends Controller 
{
    public function show() 
    {
        if (Auth::isAdmin()) {

            if(array_key_exists('search', $_GET)) {
                $search = strip_tags($_GET['search']);
                $filters = new Filters;
                $pagination = new Pagination;
                $pagination->setItemsPerPage(100);

                $user = new User;
                $user->setFilters($filters);
                $user->setPagination($pagination);
                $users = $user->where('nome', $search);
            }else {
                $filters = new Filters;
                $pagination = new Pagination;
                $pagination->setItemsPerPage(10);

                $user = new User;
                $user->setFilters($filters);
                $user->setPagination($pagination);
                $users = $user->all();
            }
            

            $this->view('admin/user/show', ['users' => $users, 'pagination' => $pagination]);
        }else {
            redirect('/');
        }
    }

    public function create() 
    {
        if (Auth::isAdmin()) {
            $this->view('admin/user/create');
        }else {
            redirect('/');
        }
    }

    public function update($id) 
    {
        $id = (int) $id[0];

        Csrf::validateToken();

        $validate = new Validate;
        $validated = $validate->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'endereco' => 'required',
            'acesso' => 'required'
        ]);

        $image = Upload::uploadFile('image', './assets/images/user/');

        $data = [
            'nome' => Request::input('nome'),
            'email' => Request::input('email'),
            'telefone' => Request::input('telefone'),
            'endereco' => Request::input('endereco'),
            'acesso' => Request::input('acesso'),
            'admin' => Request::input('acesso') == 'admin' ? true : false,
            'senha' => password_hash('1234', PASSWORD_DEFAULT),
            'imagem' => './assets/images/user/'.$image
        ];

        if ($validated) {
            $user = new User;
            $updated = $user->update('id', $id, $data);

            if ($updated) {
                Flash::set('success', 'Usuário atualizado com sucesso!');
                redirect('/edituser?id='.$id);
            } else {
                Flash::set('error', 'Ocorreu um erro tente novamente!');
                redirect('/edituser?id='.$id);
            }
        }else {
            redirect('/edituser?id='.$id);
        }
    }

    public function edit() 
    {
        if (Auth::isAdmin()) {
            if(array_key_exists('id', $_GET)) {
                $id = $_GET['id'];

                $user = new User;
                $user = $user->findBy('id', $id);

                $this->view('admin/user/edit', ['user' => $user]);
            }else {
                back();
            }
            
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
            'email' => 'required|email',
            'telefone' => 'required',
            'endereco' => 'required',
            'acesso' => 'required'
        ]);

        $userEmail = new User;
        $userEmail = $userEmail->findBy('email', Request::input('email'));

        if($userEmail) {
            Flash::set('error', 'O email digitado já existe!');
            back();
        }else {
            if($_FILES['image']['name'] != '') {
                $image = Upload::uploadFile('image', './assets/images/user/');
    
                if ($validated) {
                    $data = [
                        'nome' => Request::input('nome'),
                        'email' => Request::input('email'),
                        'telefone' => Request::input('telefone'),
                        'endereco' => Request::input('endereco'),
                        'acesso' => Request::input('acesso'),
                        'admin' => Request::input('acesso') == 'admin' ? true : false,
                        'senha' => password_hash('1234', PASSWORD_DEFAULT),
                        'imagem' => './assets/images/user/'.$image
                    ];
                    
                    $user = new User;
                    $created = $user->create($data);
    
                    if ($created) {
                        Flash::set('success', 'Usuário criada com sucesso!');
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

    }

    public function reset() 
    {
        if(Auth::isAdmin()) {
            $this->view('admin/user/resetpass');
        }else {
            redirect('/');
        }
    }

    public function resetpass() 
    {
        Csrf::validateToken();

        $validate = new Validate;
        $validated = $validate->validate([
            'senha' => 'required',
            'novasenha' => 'required',
        ]);

        if($validated) {
            $user = new User;
            $user = $user->findBy('id', $_SESSION['auth']->id);

            if($user)  {

                $password = $user->senha;
                $pass = Request::input('senha');

                if(password_verify($pass, $password)) {
                    $data = [
                        'senha' => password_hash(Request::input('novasenha'), PASSWORD_DEFAULT)
                    ];
        
                    $user = new User;
                    $updated = $user->update('id', $_SESSION['auth']->id, $data);
        
                    if($updated) {
                        Flash::set('success', 'Senha Atualizados com sucesso!');
                        redirect('/resetpassword');
                    }else {
                        Flash::set('error', 'Ocorreu um erro tente novamente!');
                        redirect('/resetpassword');
                    }
                }else {
                    Flash::set('error', 'Senha incorreta!. Digite a senha correta para alterar com sucesso!');
                    redirect('/resetpassword');
                }

            }else {
                redirect('/resetpassword');
            }
        }else {
            redirect('/resetpassword');
        }
    }

    public function delete($id) 
    {
        $id = strip_tags($id[0]);
        
        if ($id) {
            $user = new User;
            $deleted = $user->delete('id', $id);

            if($deleted) {
                Flash::set('success', "Usuário ({$id}) excluida com sucesso!");
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