<?php

namespace Store\Manager\Controllers;

use App\Http\Controllers\Controller;

use Store\Manager\Services\Orders\OrdersService;
use Store\Manager\Services\Products\ProductService;
use Store\Manager\Services\Products\CategoryService;

class AppController extends Controller{

    protected $productService;
    protected $categoryService;
    protected $statisticsService;
    protected $orderService;

    public function __construct(){

        $this->categoryService  = new CategoryService();  
        $this->productService   = new ProductService();
        $this->orderService     = new OrdersService();
    }
    
}