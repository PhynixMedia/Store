<?php

namespace Store\Manager\Traits;

use Phynixmedia\Store\Store;
use Phynixmedia\Store\Core\StoreConstants;

trait Config {

    protected $store;

    public static function config(){
        return [
            'companyid'     => store_keys()->companyid,
            'outletid'      => store_keys()->outletid,
        ];
    }

    public static function category(){

        // _logger("Config:category ", store_token());
        return (new Store())->load(store_token(), StoreConstants::CATEGORY_BRIDGE);
    }

    public static function products(){

        // _logger("Config:category ", store_token());
        return (new Store())->load(store_token(), StoreConstants::PRODUCTS_BRIDGE);
    }

    public static function customers(){

        // _logger("Config:category ", store_token());
        return (new Store())->load(store_token(), StoreConstants::CUSTOMERS_BRIDGE);
    }

    public static function orders(){
        
        // _logger("Config:category ", store_token());
        return (new Store())->load(store_token(), StoreConstants::ORDERS_BRIDGE);
    } 

    public static function voucher(){

        return (new Store())->load(store_token(), StoreConstants::VOUCHER_BRIDGE);
    }
}