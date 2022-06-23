<?php 

namespace Store\Manager\Repositories\Products;

use Store\Manager\Models\Products\Products;
use Store\Manager\Models\Products\Quantity;
use Store\Manager\Models\Products\Prices;
use Store\Manager\Models\Products\Sizes;
use Store\Manager\Models\Products\Images;

use DB;

class ProductRepository {

    /**
    * This section use relationship to get record from other table 
    * example sizes has one record in prices
    */
    public function get($id = false, $num = 18)
    {
        if($id){
            return Products::with('Images')->with('Prices')->with('quantity')->with('sizes.prices')
            ->where('id','=', $id)
            ->whereHas('prices', function ($query) 
            {
                $query->where('status', '=', 1);
            })->first();
        }

        return Products::with('Images')->with('prices')->with('quantity')->with('sizes.prices')
        ->where('public', '>=', 0)
        ->whereHas('prices', function ($query) 
        {
            $query->where('status', '=', 1);
        })->paginate($num);
    }

    /**
     * 
     * 
     */
    public function getProductDetailsByOutlet($productid, $outletid)
    {

        return Products::with('images')
            ->with(['sizes.prices' => function ($query) use ($outletid) {
                $query->where('outlet_id', $outletid);
            }])->with(['sizes.quantity' => function ($query) use ($outletid){
                $query->where('outlet_id', $outletid);
            }])->where(['id'=>$productid])->first();
    }

    /**
     * 
     * 
     */
    public function getProductsByOutlet($outletid)
    {

        return Products::with('images')
            ->with(['sizes.prices' => function ($query) use ($outletid) {
                $query->where('outlet_id', $outletid);
            }])->with(['sizes.quantity' => function ($query) use ($outletid){
                $query->where('outlet_id', $outletid);
            }])->paginate(20);
    }

    /***
     * 
     */
    public function getByCategory($categoryid)
    {

        if($categoryid){
            return Products::with('Images')->with('Prices')->with('Quantity')->with('Sizes')
            ->where('category_id','=', $categoryid)
            ->where('public', '>=', 0)
            ->whereHas('Prices', function ($query) 
            {
                $query->where('status', '=', 1);
            })->inRandomOrder()->paginate(18);
        }
        return false;
    }
        
    /**
    * Use the whereHas for sub query when there is need to get all 
    * records with special filtering for relationships
    */
    public function all($randomize = true)
    {

        $products = Products::with('Images')->with('Prices')->with('Quantity')->with('category')
        ->with('sizes.prices', 'sizes.quantity')
        ->where('public', '>=', 0)
        ->whereHas('Prices', function ($query) 
        {
            $query->where('status', '=', 1);
        });

        if($randomize)
        {
            return $products->inRandomOrder()->paginate(12);
        }
        return $products->paginate(18);
    }

    /**
    * Use the whereHas for sub query when there is need to get all 
    * records with special filtering for relationships
    */
    public function latest()
    {
    
        return Products::with('Images')->with('Prices')->with('Quantity')->with('Sizes')->with('category')
        ->where('is_latest', '=', 1)
        ->where('public', '>=', 0)
        ->whereHas('Prices', function ($query) 
        {
            $query->where('status', '=', 1);
        })->inRandomOrder()->paginate(8);
    }

    /**
    * Use the whereHas for sub query when there is need to get all 
    * records with special filtering for relationships
    */
    public function related(string $search)
    {

        // print $search;
        $terms = explode(" ", $search);
        if(count($terms ?? []) == 0){
            return false;
        }

        $count = (int) round(12 / count($terms));

        $allItems = new \Illuminate\Database\Eloquent\Collection;

        foreach($terms as $index => $term){
            
            $_query = Products::with('Images')->with('Prices')->with('Quantity')->with('Sizes')->with('category')
            ->where('public', '>=', 0)
            ->whereHas('Prices', function ($query)
            {
                $query->where('status', '=', 1);
            });

            $result = $_query->where('namex', 'like', "%{$term}%")->take($count)->get();
            $allItems = $allItems->merge($result);

            if($index >= 2){
                break;
            }
        }
        
        return $allItems;
    }

    /**
    * Use the whereHas for sub query when there is need to get all 
    * records with special filtering for relationships
    */
    public function alsoview()
    {
    
        return Products::with('Images')->with('Prices')->with('Quantity')->with('Sizes')->with('category')
        ->where('is_latest', '=', 1)
        ->where('public', '>=', 0)
        ->whereHas('Prices', function ($query) 
        {
            $query->where('status', '=', 1);
        })->inRandomOrder()->paginate(8);
    }



    /**
     * 
     */
    public function views()
    {
        return Products::with('Images')->with('Prices')->with('Quantity')->with('Sizes')->with('category')
        ->where('view_count', '>', 0)
        ->whereHas('Prices', function ($query) 
        {
            $query->where('status', '=', 1);
        })->orderBy('view_count', 'DESC')->inRandomOrder()->paginate(8);
    }

    /**
     * 
     */
    public function viewCount($id)
    {
        return Products::whereId($id)->increment('view_count', 1);
    }

    /**
     * 
     */
    public function mode($key)
    {

        return Products::with('Images')->with('Prices')->with('Quantity')->with('Sizes')->with('category')
        ->where('conditions', '=', $key)
        ->where('public', '>=', 0)
        ->whereHas('Prices', function ($query) 
        {
            $query->where('status', '=', 1);
        })->inRandomOrder()->paginate(20);
    }

    /**
    * Use the whereHas for sub query when there is need to get all 
    * records with special filtering for relationships
    */
    public function search($search)
    {
        if(!is_array($search))
        {
        
            return Products::with('Images')->with('Prices')->with('Quantity')->with('Sizes')->with('category')
                ->where('namex','LIKE','%'.$search.'%')
                ->where('public', '>=', 0)
                ->whereHas('Prices', function ($query) 
                {
                    $query->where('status', '=', 1);
                })->paginate(20);

        }else{

            $search = (object)$search;

            return Products::with('Images')->with('Prices')->with('Quantity')->with('Sizes')->with('category')
            ->where('category_id','=',$search->id)
            ->where('public', '>=', 0)
            ->where('namex','LIKE','%'.$search->query.'%')
            ->whereHas('Prices', function ($query) 
            {
                $query->where('status', '=', 1);
            })->paginate(20);
        }
    }

}