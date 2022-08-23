<?php

namespace Store\Manager\Services\Orders;

class OrdersService
{

    protected $order;

    use \Store\Manager\Traits\Config;

    public function __construct(){
        $this->init();
    }

    private function init(){
        $this->order = self::orders();
    }

    public function checkout(array $params){

        $data = array_merge(self::config(), $params);
        return $this->order->checkout($data);
    }

}