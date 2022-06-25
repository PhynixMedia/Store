<?php

namespace Store\Manager\Services\Products;

class CategoryService
{

    use \Store\Manager\Traits\Config;

    protected $category;

    /**
     *
     */
    public function __construct(){

    }

    public function init(){

        $this->category = self::category();
    }

    /**
     * Returns all categories only
     */
    public function all(){

        $this->init();

        return self::category()->all(self::config());
    }


    /**
     * Returns category products by it's id
     */
    public function get($id = false, int $pager = 0, $name = null){

        $this->init();

        $params = self::config();

        $params['categoryid'] = $id;

        $response = $this->category->getProducts($params, $pager);

        $products = $this->category->parser($response, "category");

        if(! $products ){
            return false;
        }

        return $this->category->paginator($products, 'store.category.products', ["id"=>$id, "name"=>$name]);

    }

}