<?php

namespace Store\Manager\Services\Token;

use App\Services\Service;
use Store\Manager\Repositories\Token\TokenRepository;

class TokenService extends Service
{
    protected $token_key = 'feramy_token_app';

    protected $authenticate;

    /**
     * 
     */
    public function __construct(){

        $this->authenticate = new TokenAuthenticate();

        $this->repository = new TokenRepository();
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
            if($result = $this->repository->lastValid()){

                 /**
                 * set token to session
                 */
                _session($this->token_key, $result->token);

                return $result->token;
            }
            
            /**
             * Request for a fresh token from feramy server
             */
            if($token = $this->authenticate->requestToken() ){

                /**
                 * set token to session
                 */
                _session($this->token_key, $token);

                /**
                 * set token to database
                 */
                if(!$this->repository->set(map_request([
                        'token' => $token, 
                        'expires_in'=>null
                    ]
                ))){ return ''; }

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