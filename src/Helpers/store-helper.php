<?php



/**
 * STORE HELPER FUNCTION FOR GENERIC PAGES
 * ====================================================================== */

function _session($key, $value = false){

    if(! $value){

        return session()->get($key) ?? '';
    }

    session()->put($key, $value);
    session()->save();
}

/**
 * This method should load category only once
 * into the session to prevent repeated request to server
 */
function _category()
{

    try{

        $category = _session('category');

        // if in session, return it
        if($category = _session('category')){

            return menu_sorter($category);
        }

        $response = (new Store\Manager\Services\Products\CategoryService())->all();

        $category = _parser($response->category);

        session()->put('category', $category);
        session()->save();

        $category = _session('category');

        return menu_sorter($category);

    }catch(\Exception $e){

        return null;
    }
}

function menu_sorter($category){

    if(! $category){
        return null;
    }
    $categories = [];

    foreach ($category as $row){

        $parent = _value($row, "parent", 0);

        if($parent !== 0){

            if(!array_key_exists($parent, $categories)){
                continue;
            }

            $parent_cat = $categories[$parent];
            $parent_cat->sub[] = $row;
            $categories[$parent] = $parent_cat;
        }

        if($parent === 0) {
            $categories[$row->id] = $row;
        }

    }
    return $categories;
}


/**
 * This parse all response from server
 */
function _parser($response){

    try{

        $data = json_decode($response);

        return $data->data;

    }catch(\Exception $e){

        return null;
    }
}

/**
 *
 */
function _products(){

    try{

        $response = (new Store\Manager\Services\Products\ProductService())->all();

        $products =  _parser($response->products);

        return $products->data;

    }catch(\Exception $e){

        return null;
    }
}

/**
 *
 */
function _deals(){

    return false; // (new Store\Manager\Services\Sales\DealsService())->deals();
}

/**
 *
 */
function _sales()
{
    try{

        $products = (new Store\Manager\Services\Products\ProductService())->sales();
        return $products->products->data ?? null;

    }catch(\Exception $e){
        return null;
    }
}

/**
 *
 */
function _related(string $search = null)
{
    if(!$search){ return false; }
    try{

        $products = (new Store\Manager\Services\Products\ProductService())->related($search);
        return $products->products->data ?? null;

    }catch(\Exception $e){
        return null;
    }
}

/**
 *
 */
function _latest()
{
//            return false; // (new Store\Manager\Services\Products\ProductService())->latest();
    try{

        $products = (new Store\Manager\Services\Products\ProductService())->latest();
        return $products->products->data ?? null;

    }catch(\Exception $e){
        return null;
    }
}

/**
 *
 */
function _views()
{
    return false; // (new Store\Manager\Services\Products\ProductService())->views();
}

function two_sort_products($products = null, $num = 2)
{

    try
    {
        if(! $products)
        {
            return null;
        }


        $counter = 0;

        $array = []; // placeholder for main list
        $list = []; // placeholder for column list

        foreach($products as $product){

            if($counter == $num){

                $array[] = $list; //set list to the array
                $list = []; // reset to empty the list array
                $counter = 0; // reset counter
            }

            if($counter < $num)
            {
                $list[] = $product; // add product to list array placeholder
                $counter++; //counter to increment the list of columns
            }

        }

        return $array;

    }catch(\Exception $e){

        return null;
    }
}
