<?php 

namespace Store\Manager\Repositories\Token;

use App\Models\Token\ClientToken;
use App\Traits\RunTraits;

use Carbon\Carbon;

class TokenRepository
{

    use RunTraits;

    /** 
     * Constructor to bind model to repo
     */
    public function __construct()
    {

    }

    /** 
     * 
     */
    public function set($request){

        return RunTraits::create(new ClientToken(), $request->all());
    }

    /** 
     * 
     */
    public function get(){

        $date = Carbon::now()->subDays(2)->toDateTimeString();

        \Log::info("Token Repository --> " . $date);

        return ClientToken::where('created_at','>', $date)->first();
    }
}