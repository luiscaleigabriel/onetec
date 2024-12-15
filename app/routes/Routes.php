<?php
namespace app\routes;

class Routes
{
    public static function get()
    {
        return [
            'get' => [
                '/' => 'HomeController@index',
                '/cart' => 'HomeController@cart',
                '/like' => 'HomeController@like',
                '/contact' => 'ContactController@index',
                '/about' => 'ContactController@about',
                '/search' => 'ShopController@index',
                '/checkout' => 'CheckoutController@index',
                '/register' => 'RegisterController@index',
                '/login' => 'LoginController@index',
                '/logout' => 'LoginController@logout',
                '/count' => 'UserController@index',
                '/myorders' => 'UserController@order',
                '/resetpass' => 'UserController@resetpass',
                '/dash' => 'DashController@index',
                '/orders' => 'DashController@show',
                '/ships' => 'ShipController@show',
                '/categories' => 'CategoryController@show', // Categorias
                '/newcategory' => 'CategoryController@create',
                '/editcategory' => 'CategoryController@edit',
                '/subcategories' => 'SubCategoryController@show', // SubCategorias
                '/newsubcategory' => 'SubCategoryController@create',
                '/editsubcategory' => 'SubCategoryController@edit',
                '/users' => 'AdminController@show', // Usuários
                '/newuser' => 'AdminController@create',
                '/resetpassword' => 'AdminController@reset',
                '/edituser' => 'AdminController@edit',
                '/products' => 'ProductController@show', // Produtos
                '/newproduct' => 'ProductController@create',
                '/editproduct' => 'ProductController@edit',
                '/productdetails' => 'ProductController@details'
            ],
            'post' => [
                '/pdf' => 'ReciboController@index',
                '/auth' => 'LoginController@store',
                '/acount' => 'UserController@update',
                '/register' => 'RegisterController@store',
                '/resetpass' => 'UserController@reset',
                '/pay' => 'CheckoutController@pay',
                '/paypay' => 'CheckoutController@finish',
                '/shiping' => 'ShipController@shiping',
                '/new/category' => 'CategoryController@store', // Categorias
                '/update/category/[0-9]+' => 'CategoryController@update',
                '/delete/category/[0-9]+' => 'CategoryController@delete',
                '/new/subcategory' => 'SubCategoryController@store', // SubCategorias
                '/update/subcategory/[0-9]+' => 'SubCategoryController@update',
                '/delete/subcategory/[0-9]+' => 'SubCategoryController@delete',
                '/new/product' => 'ProductController@store', // Products
                '/update/product/[0-9]+' => 'ProductController@update',
                '/delete/product/[0-9]+' => 'ProductController@delete',
                '/new/user' => 'AdminController@store', // Usuários
                '/update/user/[0-9]+' => 'AdminController@update',
                '/delete/user/[0-9]+' => 'AdminController@delete',
                '/resetpassword' => 'AdminController@resetpass',
            ]
        ];
    }
}
