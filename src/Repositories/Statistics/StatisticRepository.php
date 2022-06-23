<?php 

namespace Store\Manager\Repositories\Statistics;

use Store\Manager\Models\Statistics\StoreVisits;

use App\Traits\RunTraits;

class StatisticRepository {


    use RunTraits;

    public function __construct(){


    }

    /**
     * 
     */
    public function setViewCount($request){

        RunTraits::updateOrCreate(new StoreVisits(), $request->all());
    }

    /**
     * 
     */
    public function getViewCount($id =  false){


    }

    /**
     * 
     */
    public function setUniqueVisitCount($request){

        return RunTraits::updateOrCreate(new StoreVisits(), $request->all(), ['ip'=>$request->get('ip')]);
    }

    /**
     * 
     */
    public function getUniqueVisitCount($id =  false){


    }

}