<?php

namespace Store\Manager\Controllers;

use App\Http\Controllers\Controller;

use Store\Manager\Services\Products\ProductService;
use Store\Manager\Services\Products\Category\CategoryService;
use Store\Manager\Services\Statistics\StatisticService;

class AppController extends Controller{

    protected $productService;
    protected $categoryService;
    protected $statisticsService;

    public function __construct(){

        $this->categoryService  = new CategoryService();  
        $this->productService   = new ProductService();
        $this->statisticsService = new StatisticService();
    }
    
}