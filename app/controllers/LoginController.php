<?php

namespace app\controllers;

use app\core\Request;
use app\database\models\User;
use app\support\Auth;
use app\support\Csrf;
use app\support\Flash;
use app\support\Validate;

class LoginController extends Controller 
{
    public function index() 
    {
        if(!Auth::auth()) {
            $this->view('login');
        }else {
            redirect('/');
        }
    }

    public function store() 
    {
        Csrf::validateToken();

        $validate = new Validate;
        $validated = $validate->validate([
            'email' => 'email|required',
            'senha' => 'required'
        ]);

        if($validated) {
            $email = strip_tags(Request::input('email'));
            $password = strip_tags(Request::input('senha'));

            $user = new User;
            $user = $user->findBy('email', $email);

            if ($user) {
                $bd_pass = $user->senha;

                if (password_verify($password, $bd_pass)) {
                    Auth::loginAs($user);
                }else {
                    Flash::set('error', 'Senha incorreta!');
                    redirect('/login');
                }
                
            } else {
                Flash::set('error', 'Usuário ou senha inválida!');
                redirect('/login');
            }
        }else {
            redirect('/login');
        }
    
    }

    public function logout() {
        if (Auth::auth()) {
            Auth::logout();
        }else {
            redirect('/login');
        }
    }
}