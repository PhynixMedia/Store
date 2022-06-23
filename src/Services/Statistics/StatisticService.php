<?php

namespace Store\Manager\Services\Statistics;

use Store\Manager\Repositories\Statistics\StatisticRepository;
use Phynixmedia\Locator\Geo;

class StatisticService
{
    protected $statsRepository;

    /**
     * 
     */
    public function __construct(){

        $this->statsRepository = new StatisticRepository();
    }
    /**
     * 
     */
    public function setProductViewCount($request)
    {

        return $this->statsRepository->set($request);
    }

    public function createVisit(){

        try{

            if(!session()->has('visited')){

                if($response = (new Geo)->get(request()->ip())){

                    $response = array_merge($response->_array(), ['ip'=>request()->ip()]);

                    $request = map_request($response);
                    if($this->setUniqueVisitCount($request)){

                        session()->put('visited', true);
                    }
                }
            }
        }catch(\Exception $e){
            \Log::info($e->getMessage());
        }
    }

    public function setUniqueVisitCount($request){

        $params = [
                    'ip'                => $request->get('ip'),
                    'city'              => $request->get('geoplugin_city'),
                    'region'            => $request->get('geoplugin_region'),
                    'code'              => $request->get('geoplugin_regionCode'),
                    'country_code'      => $request->get('geoplugin_countryCode'),
                    'country_name'      => $request->get('geoplugin_countryName'),
                    'continent_name'    => $request->get('geoplugin_continentName'),
                    'latitude'          => $request->get('geoplugin_latitude'),
                    'longitude'         => $request->get('geoplugin_longitude'),
                    'radius'            => $request->get('geoplugin_locationAccuracyRadius'),
                    'timezone'          => $request->get('geoplugin_timezone'),
                    'currency_code'     => $request->get('geoplugin_currencyCode'),
                    'currency_symbol'       => $request->get('geoplugin_currencySymbol'),
                    'currency_symbol_utf'   => $request->get('geoplugin_currencySymbol_UTF8'),
        ];

        $request = map_request($params);

        return $this->statsRepository->setUniqueVisitCount($request);
    }
}