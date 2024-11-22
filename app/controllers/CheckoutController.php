<?php

namespace app\controllers;

use app\core\Request;
use app\database\models\Order;
use app\database\models\Product;
use app\database\models\Ship;
use app\database\models\User;
use app\support\Auth;
use app\support\Flash;
use Exception;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;

class CheckoutController extends Controller 
{
    public function index() 
    {
        if(Auth::auth()) {
            $user = new User;
            $user = $user->findBy('id',$_SESSION['auth']->id);
            
            $this->view('checkout', ['user' => $user]);
        }else {
            Flash::set('error', 'Faça login para finalizar a compra!');
            redirect('/login');
        }
    }

    public function pay() 
    {
        if(Auth::auth()) {
            $this->view('pay');
        }else {
            Flash::set('error', 'Faça login para finalizar a compra!');
            redirect('/login');
        }
    }

    public function finish() 
    {
        
        $cardNumber = Request::input('card-number'); 
        $cardExpiryMonth = Request::input('card-expiry-month'); 
        $cardExpiryYear = Request::input('card-expiry-year'); 
        $total = Request::input('total');

        if($cardExpiryYear > date('Y')) {
            if($cardNumber == '424242424242') {
                $product = Request::input('data');
                $products = explode('-', $product);
        
                foreach($products as $product) {
                    if(!empty($product)) {
                        [$id, $qtd] = explode('+', $product);
                        $productFound = new Product;
                        $productFound = $productFound->findBy('id', $id);
                        $quantidade = $productFound->quantidade - $qtd;
    
                        $data = [
                            'quantidade' => $quantidade
                        ];
    
                        $newProduct = new Product;
                        $newProduct = $newProduct->update('id', $id, $data);
                    }
                }
        
                $data = [
                    'codigo' => '#'.uniqid(),
                    'total' => $total,
                    'status' => true,
                    'idusuario' => $_SESSION['auth']->id
                ];
        
                $order = new Order;
                $created = $order->create($data);

                $ship = new Ship;
                $shipData = ['status' => false]; 
                $ship = $ship->create($shipData);

                if($created) {
                    Flash::set('success', 'Compra realizada com sucesso!');
                    redirect('/myorders');
                }else {
                    Flash::set('error', 'Ocorru um erro. Verifique a sua conexão a internet!');
                    redirect('/myorders');
                }
        
            }else if($cardNumber == '555555555555')  {
                if($total <= 100000 && $total != 0) {
                    $product = Request::input('data');
                    $products = explode('-', $product);
            
                    foreach($products as $product) {
                        if(!empty($product)) {
                            [$id, $qtd] = explode('+', $product);
                            $productFound = new Product;
                            $productFound = $productFound->findBy('id', $id);
                            $quantidade = $productFound->quantidade - $qtd;
        
                            $data = [
                                'quantidade' => $quantidade
                            ];
        
                            $newProduct = new Product;
                            $newProduct = $newProduct->update('id', $id, $data);
                        }
                    }
            
                    $data = [
                        'codigo' => '#'.uniqid(),
                        'total' => $total,
                        'status' => true,
                        'idusuario' => $_SESSION['auth']->id
                    ];
            
                    $order = new Order;
                    $created = $order->create($data);

                    $ship = new Ship;
                    $shipData = ['status' => false]; 
                    $ship = $ship->create($shipData);
    
                    if($created) {
                        Flash::set('success', 'Compra realizada com sucesso!');
                        redirect('/myorders');
                    }else {
                        Flash::set('error', 'Ocorru um erro. Verifique a sua conexão a internet!');
                        redirect('/myorders');
                    }
            
                }else {
                    Flash::set('error', 'A compra não pode ser realizada!');
                    redirect('/myorders');
                }
            }else {
                Flash::set('error', 'Ocorru um erro. Verifique a sua conexão a internet!');
                redirect('/myorders');
            }
        }  else {
            Flash::set('error', 'Ocorru um erro. Verifique se os dados do cartão de debito estam correto!');
            redirect('/myorders');
        }
            
    }
}