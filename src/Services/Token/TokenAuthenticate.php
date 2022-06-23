<?php

namespace Store\Manager\Services\Token;

use Phynixmedia\Store\Store;

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

            $bearer = json_decode($response->getToken()->bearer);

            return $bearer->access_token;

        }catch(\Exception $e){

            \Log::info("Authenticate requestToken Method: " . $e->getMessage());
            return '';
        }

    }
    
}