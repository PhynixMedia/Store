<?php

namespace Store\Manager\Controllers\Products\Category;

use Store\Manager\Controllers\AppController;

class CategoryController extends AppController {


    public function __construct(){

        parent::__construct();
    }


    public function get($id, $name){

        $pagedata = $this->webService->getPage('shop', false);

        $products = $this->categoryService->get($id, request()->get('page') ?? 0, $name);

        return view('store::store.store', compact('pagedata','products'));
    }

}