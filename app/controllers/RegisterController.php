<?php

namespace app\controllers;

use app\core\Request;
use app\database\models\User;
use app\support\Auth;
use app\support\Csrf;
use app\support\Flash;
use app\support\Validate;

class RegisterController extends Controller 
{
    public function index() 
    {
        if(!Auth::auth()) {
            $this->view('register');
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
            'email' => 'email|required',
            'senha' => 'required'
        ]);

        if($validated) {

            $findEmail = new User;
            $findEmail = $findEmail->findBy('email', Request::input('email'));

            if($findEmail) {
                Flash::set('error', 'Já foi criada uma conta com esse email!. Por favor faça login');
                redirect('/register');
            }else {
                $data = [
                    'nome' => strip_tags(Request::input('nome')),
                    'email' => Request::input('email'),
                    'senha' => password_hash(strip_tags(Request::input('senha')), PASSWORD_DEFAULT)
                ];
    
                $user = new User;
                $created = $user->create($data);
    
                if ($created) {
                    $password = strip_tags(Request::input('senha'));
    
                    $user = new User;
                    $user = $user->findBy('email', $data['email']);
    
                    if ($user) {
                        $bd_pass = $user->senha;
    
                        if (password_verify($password, $bd_pass)) {
                            Auth::loginAs($user);
                        }else {
                            Flash::set('error', 'Senha incorreta!');
                            redirect('/login');
                        }
                        
                    }
                } else {
                    Flash::set('error', 'Ocorreu um erro tente novamente!');
                    redirect('/register');
                }
            }

        }else {
            redirect('/register');
        }
    }
}