<?php

namespace Store\Manager\Services\Token;

use Store\Manager\Repositories\Token\TokenRepository;
use Phynixmedia\Locator\Geo;

use Phynixmedia\Store\Store;
use Phynixmedia\Store\Core\StoreConstants;

class TokenAuthenticate
{

    protected $store;

    /**
     * 
     */
    public function __construct(){

        $this->store = new Store();
    }
    

    /**
             * Request for a fresh token from feramy server
             */
    public function requestToken()
    {
        try{

            $response = $this->store::config(['publish'=> env('FERAMY_PUBLISH'),'secret' => env('FERAMY_SECRET')]);

            
            \Log::info("Authenticate requestToken Method: " . json_encode((array) $response->getToken()));
            
            $bearer = json_decode($response->getToken()->bearer);

            return $bearer->access_token;

        }catch(\Exception $e){

            \Log::info("Authenticate requestToken Method: " . $e->getMessage());
            return '';
        }

    }
    
}