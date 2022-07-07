<?php

namespace Store\Manager\Services\Token;

use App\Services\Service;
use Carbon\Carbon;
use Store\Manager\Models\ClientToken;
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

    public function getToken(){

        if(! session()->has($this->token_key))
        {
            return null;
        }
        return session()->get($this->token_key);
    }

    public function lastToken(){

        if(! $result = $this->repository->lastValid()){
            return null;
        }
        /** * set token to session */
        session()->put($this->token_key, $result->token);
        return $result->token;
    }

    public function storeToken($token){

        $expiry = Carbon::now()->subDays(1)->format("Y-m-d H:i:s");
        if(! $this->repository->set(map_request([ 'token' => $token, 'expires_in' => $expiry ]))){
            return false;
        }
        return true;
    }

    public function generateToken(){

        return $this->authenticate->requestToken();
    }

    public function token(){

        session()->forget($this->token_key);

        if($token = $this->getToken()){
            return $token;
        }

        if($token = $this->lastToken()){
            return $token;
        }

        $token = $this->generateToken();

        if(!$this->storeToken($token)){
            return null;
        }

        return $token;
    }

    public static function forget($key){

        session()->forget($key);
    }
    
}