<?php 

namespace Store\Manager\Repositories\Products\Category;

use Store\Manager\Models\Products\Category;


class CategoryRepository 
{        
    
    /**
     * 
     */
    public function get($id = false){

        return Category::whereId($id)->first();
    }


    /**
     * 
     */
    public function all(){

        return Category::all();
    }

    /** 
     * 
     */
    public function getWhere(array $where = []){

        if(!$where){
            return false;
        }
        return Category::where($where)->orderBy('namex', 'ASC')->get();
    }

}