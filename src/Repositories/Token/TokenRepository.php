<?php 

namespace Store\Manager\Repositories\Token;

use \Store\Manager\Models\ClientToken;
use App\Repositories\CoreRepository;
use App\Traits\RunTraits;

use Carbon\Carbon;

class TokenRepository extends CoreRepository
{

    use RunTraits;

    public function __construct(){

        $this->model = new ClientToken();
    }

    public function lastValid(){

        $date = Carbon::now()->subDays(1)->toDateTimeString();
        return ClientToken::where('created_at','>', $date)->first();
    }
}