<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\Order;
use app\database\models\User;
use app\database\Pagination;
use app\support\Auth;

class DashController extends Controller 
{
    public function index() 
    {
        if (Auth::isAdmin()) {
            $orders = new Order;

            $total = 0;
            $ganhos = 0;
            foreach($orders->all() as $order) {
                $total += $order->total;
                $ganhos += ($order->total * 20) / 100;
            }

            $orders = count($orders->all());

            $user = new User;
            $users = count($user->all());

            $this->view('admin/dash', ['orders' => $orders, 'users' => $users, 'total' => $total, 'ganhos' => $ganhos]);
        }else {
            redirect('/');
        }
    }

    public function show() 
    {
        if (Auth::isAdmin()) {
            
            if(array_key_exists('search', $_GET)) {
                $search = strip_tags($_GET['search']);
                $filters = new Filters;
                $filters->orderBy('id', 'desc');
                $pagination = new Pagination;
                $pagination->setItemsPerPage(100);

                $orders = new Order;
                $orders->setFilters($filters);
                $orders->setPagination($pagination);
                $orders = $orders->where('codigo', $search);
            }else {
                $filters = new Filters;
                $filters->orderBy('id', 'desc');
                $pagination = new Pagination;
                $pagination->setItemsPerPage(10);

                $orders = new Order;
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