<?php

namespace Store\Manager\Controllers\Products;

use Store\Manager\Controllers\AppController;

class CategoryController extends AppController {

    public function __construct(){

        parent::__construct();
    }

    public function all(){

        $products = $this->categoryService->all();
        return view('store-app::category.view', compact('products'));
    }

    public function get($id, $name){

        $products = $this->categoryService->get($id, request()->get('page') ?? 0, $name);
        return view('store-app::category.view', compact('products'));
    }

}