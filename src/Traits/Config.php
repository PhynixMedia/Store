<?php

namespace Store\Manager\Traits;

use Phynixmedia\Store\Store;
use Phynixmedia\Store\Core\StoreConstants;
use Store\Manager\Services\Token\TokenService;

trait Config {

    protected $store;

    private static function token(){

        return (new TokenService())->token() ?? '';
    }

    public static function config(){

        return [
            'companyid'     => (int) config("store-app.company_id"),
            'outletid'      => (int) config("store-app.outlet_id"),
        ];
    }

    public static function category(){

        return (new Store())->load(self::token(), StoreConstants::CATEGORY_BRIDGE);
    }

    public static function products(){

        return (new Store())->load(self::token(), StoreConstants::PRODUCTS_BRIDGE);
    }

    public static function customers(){

        return (new Store())->load(self::token(), StoreConstants::CUSTOMERS_BRIDGE);
    }

    public static function orders(){
        
        return (new Store())->load(self::token(), StoreConstants::ORDERS_BRIDGE);
    } 

    public static function voucher(){

        return (new Store())->load(self::token(), StoreConstants::VOUCHER_BRIDGE);
    }
}