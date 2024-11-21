<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\Ship;
use app\database\models\User;
use app\database\Pagination;
use app\support\Auth;

class ShipController extends Controller 
{
    public function show() 
    {
        if (Auth::isAdmin()) {
            
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

            $this->view('admin/orders', ['orders' => $orders, 'users' => $users,'pagination' => $pagination]);
        }else {
            redirect('/');
        }
    }
}