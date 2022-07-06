<?php

namespace Store\Manager\Services\Products;


class ProductService
{
    use \Store\Manager\Traits\Config;

    public function __construct(){

        $this->init();
    }

    protected $products;

    private function init(){
        $this->products = self::products();
    }

    public function get($id){

        $params = array_merge(self::config(), ['productid' => $id]);
        $response = $this->products->get($params);
        return $this->products->parser($response, "products");
    }

    public function all(){

        $response = $this->products->all(self::config());

        if(! $response = $this->products->parser($response, "products")){
            return null;
        }
        return $this->products->paginator($response, "store.search", []);
    }

    /**
     *
     */
    public function sales()
    {
        $params = array_merge(self::config(), ['conditions' => 1]);
        return $this->products->find($params);
    }

    /**
     *
     */
    public function search($search = false, $pager = 0)
    {
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

        $params = array_merge(self::config(), ['search' => $search]);
        $response = $this->products->related($params);
        return $this->products->parser($response, "products");
    }

    /**
     *
     */
    public function latest($search)
    {

        $params = array_merge(self::config(), ['search' => $search]);
        $response = $this->products->related($params);
        return $this->products->parser($response, "products");
    }


    /**
     *
     */
    public function getOnSales()
    {

        $params = array_merge(self::config(), ['conditions' => 2]);
        $response = $this->products->find($params);
        $products = $this->products->parser($response, "products");
        return $this->products->paginator($products, "store.search", []);
    }

    /**
     *
     */
    public function views(){}

    /**
     *
     */
    public function getNew(){ }

}