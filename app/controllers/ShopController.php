<?php 

namespace app\controllers;

use app\database\Filters;
use app\database\models\Category;
use app\database\models\Product;
use app\database\models\SubCategory;

class ShopController extends Controller 
{
    public function index() 
    {
        if(array_key_exists('category', $_GET)) {

            $id = (int) strip_tags($_GET['category']);

            $filtersS = new Filters;
            $filtersS->limit(20);

            $category = new Category;
            $categories = $category->all();

            $subCategory = new SubCategory;
            $subCategory->setFilters($filtersS);
            $subCategories = $subCategory->all();

            $filters = new Filters;
            $filters->where('idcategoria', '=', $id);

            $product = new Product;
            $product->setFilters($filters);
            $products = $product->all();

            $this->view('shop', [
                'categories' => $categories,
                'subCategories' => $subCategories,
                'products' => $products,
            ]);

        }else if(array_key_exists('subcategory', $_GET)) {

            $id = (int) $_GET['subcategory'];

            $category = new Category;
            $categories = $category->all();

            $filtersS = new Filters;
            $filtersS->limit(20);

            $subCategory = new SubCategory;
            $subCategory->setFilters($filtersS);
            $subCategories = $subCategory->all();

            $filters = new Filters;
            $filters->where('idsubcategoria', '=', $id);

            $product = new Product;
            $product->setFilters($filters);
            $products = $product->all();

            $this->view('shop', [
                'categories' => $categories,
                'subCategories' => $subCategories,
                'products' => $products,
            ]);

        }else if(array_key_exists('name', $_GET)) {

            $value = strip_tags($_GET['name']);

            $category = new Category;
            $categories = $category->all();

            $filtersS = new Filters;
            $filtersS->limit(20);

            $subCategory = new SubCategory;
            $subCategory->setFilters($filtersS);
            $subCategories = $subCategory->all();

            $product = new Product;
            
            if($value != '') {
                $products = $product->where('nome', $value);
            }else {
                $filters = new Filters;
                $filters->limit(9);
                $product->setFilters($filters);
                $products = $product->all();
            }

            $this->view('shop', [
                'categories' => $categories,
                'subCategories' => $subCategories,
                'products' => $products,
            ]);

        }else {
            back();
        }
    }
}