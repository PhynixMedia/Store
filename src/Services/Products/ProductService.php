<?php

namespace Store\Manager\Services\Products;


class ProductService
{

    use \Store\Manager\Traits\Config;

    protected $products;

    /**
     * 
     */
    public function __construct(){


    }

    public function init(){

        $this->products = self::products();
    }

    public function get($id){

        $this->init();

        $params = array_merge(self::config(), ['productid' => $id]);

        $response = $this->products->get($params);

        return $this->products->parser($response, "products");

    }

    public function all(){

        $this->init();

        return $this->products->all(self::config());
    }

     /**
     * 
     */
    public function sales()
    {
        $this->init();

        $params = array_merge(self::config(), ['conditions' => 1]); 
        return $this->products->find($params);
    }

    /**
     * 
     */
    public function search($search = false, $pager = 0)
    {

        $this->init();

        if(! $search){
            return false;
        }

        $params = array_merge(self::config(), ['search' => $search]); 

        $response = $this->products->search($params, $pager);

        $products = $this->products->parser($response, "products");

        return $this->products->paginator($products, "store.search", []);
    }

    /**
     * 
     */
    public function related(string $search)
    {

        $this->init();

        $params = array_merge(self::config(), ['search' => $search]); 

        $response = $this->products->related($params);

        return $this->products->parser($response, "products");
    }

    /**
     * 
     */
    public function latest()
    {

        $this->init();

        $params = array_merge(self::config(), ['search' => $search]); 

        $response = $this->products->related($params);

        return $this->products->parser($response, "products");
    }


    /**
     * 
     */
    public function getOnSales()
    {

        $this->init();

        $params = array_merge(self::config(), ['conditions' => 2]); 

        $response = $this->products->find($params);

        $products = $this->products->parser($response, "products");

        return $this->products->paginator($products, "store.search", []);
    }


    /**
     * 
     */
    public function viewCount($id): void
    {
        
    }

     /**
     * 
     */
    public function views()
    {

        
    }

    /**
     * 
     */
    public function getNew()
    {

        
    }

}