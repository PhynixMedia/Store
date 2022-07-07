<?php

namespace Store\Manager\Controllers\Products;

use Store\Manager\Controllers\AppController;
use Illuminate\Http\Request;

class ProductsController extends AppController 
{

    /**
     * 
     */
    public function __construct(){

        parent::__construct();
    }

    public function all(){

        $products = $this->productService->all();

        if($products){
            $related = $this->productService->related(isset($product->namex) ? $product->namex : '');
        }

        $page = "";

        return view('store-app::store.view', compact('products','page', 'related'));

    }

    /**
     * 
     */
    public function get($id, $name){

        $page = (object)['title' => $name];

        $product = $this->productService->get($id);

        $related = null;
        if($product){
            $related = $this->productService->related(isset($product->namex) ? $product->namex : '');
        }

        return view('store-app::products.view', compact('product','page','related'));

    }

    /**
     * 
     */
    public function search(Request $request){

            if(request()->get('qr'))
            {
                session()->put("search", request()->get('qr'));
                session()->save();
            }

            if(! session()->has("search")){

                return redirect()->to(url("/"));
            }

            $search = session()->get("search");

            // create the actual request
            $products = $this->productService->search($search, request()->get('page') ?? 0);

            return view('store-app::store.view', compact('products'));
    }

}