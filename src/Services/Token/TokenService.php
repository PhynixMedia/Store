<?php

namespace Store\Manager\Services\Token;

use Phynixmedia\Locator\Geo;
use Phynixmedia\Store\Store;
use Phynixmedia\Store\Core\StoreConstants;
use Store\Manager\Services\Token\TokenAuthenticate;
use Store\Manager\Repositories\Token\TokenRepository;

class TokenService extends TokenAuthenticate
{

    protected $token_key = 'feramy_token_app';
    protected $tokenRepository;

    /**
     * 
     */
    public function __construct(){

        parent::__construct();
        $this->tokenRepository = new TokenRepository();
    }
    /**
     * This should get token from database
     */
    public function get($request)
    {

        
    }

    /**
     * This should store the new token
     */
    public function set($request)
    {

        
    }

    /**
     * This should return only the token
     */
    public function token()
    {

        session()->forget($this->token_key);

        try{

            /**
             * Get token from session
             */
            if(session()->has($this->token_key))
            {
                return _session($this->token_key);
            }
            
            /**
             * Check database for valid token
             */
            if($result = $this->tokenRepository->get()){

                 /**
                 * set token to session
                 */
                _session($this->token_key, $result->token);

                return $result->token;
            }
            
            /**
             * Request for a fresh token from feramy server
             */
            if($token = $this->requestToken() ){

                /**
                 * set token to session
                 */
                _session($this->token_key, $token);

                /**
                 * set token to database
                 */
                if(!$this->tokenRepository->set(map_request(
                    [
                        'token' => $token, 
                        'expires_in'=>null
                    ]
                ))){

                    return '';
                }

                /**
                 * return token from session
                 */
                return _session($this->token_key);
                 
            }
            return '';

        }catch(\Exception $e){

            \Log::info("Token Service Method: " . $e->getMessage());
            return '';
        }

    } 

    public static function forget($key){

        session()->forget($key);
    }
    
}