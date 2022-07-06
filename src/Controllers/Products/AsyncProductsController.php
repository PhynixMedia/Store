<?php

namespace Store\Manager\Controllers\Products;

use Illuminate\Http\Request;
use Store\Manager\Controllers\AppController;

class AsyncProductsController extends AppController {

    public function __construct(){

        parent::__construct();
    }

    public function get($id){

        $product = $this->productService->get($id);
        return view('store-app::products.components.modals.quick-view.view', compact('product'))->render();
    }


    public function search(Request $request){

            // set parameters
            $query = [
                'id' => $request->get('select'),
                'query' => $request->get('qr')
            ];

            // create the actual request
            $products = $this->productService->search($query);

            return view('store-app::shop', compact('products'));
    }

     /**
     * this create sessions for recently viewed products
     */
    private static function viewed($id, $product){


    }

}