<?php

namespace app\controllers;

use app\core\Request;
use app\database\Filters;
use app\database\models\Ship;
use app\database\models\User;
use app\database\Pagination;
use app\support\Auth;
use app\support\Flash;

class ShipController extends Controller 
{
    public function show() 
    {
        if (Auth::isAdmin() || Auth::isEnt()) {
            
            if(array_key_exists('search', $_GET)) {
                $search = strip_tags($_GET['search']);
                $filters = new Filters;
                $filters->orderBy('id', 'desc');
                $pagination = new Pagination;
                $pagination->setItemsPerPage(100);

                $orders = new Ship;
                $orders->setFilters($filters);
                $orders->setPagination($pagination);
                $orders = $orders->where('data_da_entrega', $search);
            }else {
                $filters = new Filters;
                $filters->orderBy('id', 'desc');
                $pagination = new Pagination;
                $pagination->setItemsPerPage(10);

                $orders = new Ship;
                $orders->setFilters($filters);
                $orders->setPagination($pagination);
                $orders = $orders->all();
            }

            $user = new User;
            $users = $user->all();

            $this->view('admin/entregas', ['orders' => $orders, 'users' => $users,'pagination' => $pagination]);
        }else {
            redirect('/');
        }
    }

    public function shiping() 
    {
        $id = Request::input('identrega');

        $data = [
            'identregador' => $id,
            'data_da_entrega' => date('Y-m-d H:m:s'),
            'status' => true
        ];

        $ship = new Ship;
        $updated = $ship->update('id', $id, $data);

        if($updated) {
            Flash::set('success', "Entrega finalizada com sucesso!");
            back();
        }else {
            Flash::set('error', "Ocorreu um erro verifique a sua conexão com a internet!");
            back();
        }
    }
}