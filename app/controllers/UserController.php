<?php
namespace app\controllers;

use app\controllers\Controller;
use app\core\Request;
use app\database\Filters;
use app\database\models\Order;
use app\database\models\User;
use app\support\Auth;
use app\support\Csrf;
use app\support\Flash;
use app\support\Validate;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::auth()) {
            $user = new User;
            $user = $user->findBy('id', $_SESSION['auth']->id);

            if($user) {
                $this->view('count', [
                    'user' => $user
                ]);
            }else {
                back();
            }
        }else {
            redirect('/');
        }
    }

    public function update()
    {
        Csrf::validateToken();

        $validate = new Validate;
        $validated = $validate->validate([
            'nome' => 'required',
            'email' => 'required|email',
            'endereco' => 'required',
            'telefone' => 'required',
        ]);

        if($validated) {

            $data = [
                'nome' => Request::input('nome'),
                'email' => Request::input('email'),
                'endereco' => Request::input('endereco'),
                'telefone' => Request::input('telefone'),
            ];

            $user = new User;
            $updated = $user->update('id', $_SESSION['auth']->id, $data);

            if($updated) {
                Flash::set('success', 'Dados Atualizados com sucesso!');
                back();
            }else {
                Flash::set('error', 'Ocorreu um erro tente novamente!');
                back();
            }

        }else {
            back();
        }
    }

    public function order() 
    {
        if(Auth::auth()) {
            $filters = new Filters;
            $filters->where('idusuario', '=', $_SESSION['auth']->id);

            $filter = new Filters;
            $filter->orderBy('id', 'desc');

            $order = new Order;
            $order->setFilters($filters);
            $orders = $order->all();

            $newOrder = new Order;
            $newOrder->setFilters($filter);
            $new = $newOrder->first();

            $this->view('orders', ['orders' => $orders, 'new' => $new]);
        }else {
            redirect('/');
        }
    }

    public function resetpass() 
    {
        if(Auth::auth()) {
            $this->view('resetpass');
        }else {
            redirect('/');
        }
    }

    public function reset() 
    {
        if(Auth::auth()) {
            
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
                            redirect('/resetpass');
                        }else {
                            Flash::set('error', 'Ocorreu um erro tente novamente!');
                            redirect('/resetpass');
                        }
                    }else {
                        Flash::set('error', 'Senha incorreta!. Digite a senha correta para alterar com sucesso!');
                        redirect('/resetpass');
                    }

                }else {
                    redirect('/resetpass');
                }
            }else {
                redirect('/resetpass');
            }

        }else {
            redirect('/');
        }
    }
}
