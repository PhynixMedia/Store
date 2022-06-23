<?php 

namespace Store\Manager\Repositories\Sales;

use Store\Manager\Models\Orders\Rewards\Deals;

class DealsRepository {


    /**
     * @return active $deals 
     */
    public function all($randomize = true)
    {


        $products = Deals::with('items.products', 'items.products.images', 'items.size', 'items.products.prices')
        ->where('status', '=', 1)->where('expires_at','>=', \Carbon\Carbon::now());
        

        if($randomize)
        {
            return $products->inRandomOrder()->paginate(20);
        }
        return $products->paginate(20);
    }

}