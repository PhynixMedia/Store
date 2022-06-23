<?php

namespace Store\Manager\Services\Sales;

use Store\Manager\Repositories\Sales\DealsRepository;

class DealsService
{
    protected $dealsRepository;

    /**
     * 
     */
    public function __construct(){

        $this->dealsRepository = new DealsRepository();
    }
    /**
     * 
     */
    public function deals()
    {
        return $this->dealsRepository->all();
    }


    /**
     * 
     */
    public function coupons()
    {
        
    }


}