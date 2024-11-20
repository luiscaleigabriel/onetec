<?php

namespace app\support;

use app\database\models\User;
use stdClass;

class Auth 
{
    public static function loginAs($user) 
    {
        if (!(Session::has(('auth') && !Session::has(('admin'))))) {
            $stdClass = new stdClass;
            $stdClass->id = $user->id;
            $stdClass->name = $user->nome;
            $stdClass->image = $user->imagem;
            $stdClass->access = $user->acesso;

            

            Session::set('auth', $stdClass);

            if ($user->admin) {
                Session::set('admin', true);
                redirect('/dash');
            }else {
                redirect('/checkout');
            }

        }
    }

    public static function auth() 
    {
        if (Session::has('auth')) {
            return true;
        }

        return false;
    }

    public static function isEnt() 
    {
        if (Session::has('auth')) {
            $user = Session::get('auth');
            if ($user->access === 'entregador') {
                return true;
            }

            return false;
        }
    }

    public static function isAdmin() 
    {
        if (Session::has('auth')) {
            $user = Session::get('auth');

            if ($user->access === 'admin') {
                return true;
            }

            return false;
        }
    }

    public static function logout() 
    {
        if (Session::has('auth')) {
            Session::destroy();
            redirect('/');
        }
    }
}