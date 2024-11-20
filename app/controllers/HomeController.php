<?php

namespace app\controllers;

use app\database\Filters;
use app\database\models\Category;
use app\database\models\Product;

class HomeController extends Controller
{
  public function index()
  {
    // Busca por novos produts
    $filters = new Filters;
    $filters->orderBy('id', 'desc');
    $filters->limit(10);

    $product = new Product;
    $product->setFilters($filters);
    $newProduct = $product->all();

    // Busca por produtos populares
    $filterPopular = new Filters;
    $filterPopular->where('popular', '=', true);
    $filterPopular->limit(10);

    $popular = new Product;
    $popular->setFilters($filterPopular);
    $populares = $popular->all();

    // Busca por 4 produtos aleatórios
    $filtersN = new Filters;
    $filtersN->orderBy('id');
    $filtersN->limit(8);

    $productN = new Product;
    $productN->setFilters($filtersN);  
    $nProducts = $productN ->all();

    $filtersM = new Filters;
    $filtersM->orderBy('id');
    $filtersM->limit(8);

    $category = new Category;
    $category->setFilters($filtersM);
    $categories = $category->all();


    $this->view('home', [
      'newProduct' => $newProduct,
      'populares' => $populares,
      'nProducts' => $nProducts,
      'categories' => $categories
    ]);
  }

  public function cart() 
  {
    $this->view('cart');
  }

  public function like() 
  {
    $this->view('like');
  }
}
