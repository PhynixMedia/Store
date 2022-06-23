<?php

namespace Store\Manager\Models\Statistics;

use Illuminate\Database\Eloquent\Model;

class StoreVisits extends Model
{

    protected $table = "store_visits";

    protected $fillable = [ 
        'ip',
        'city',
        'region',
        'code',
        'country_code',
        'country_name',
        'continent_name',
        'latitude',
        'longitude',
        'radius',
        'timezone',
        'currency_symbol',
    ];

    public function products(){
        return $this->hasOne('Store\Manager\Models\Products\Products', 'id', 'products_id');
    }
}