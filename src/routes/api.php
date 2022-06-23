<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('cors')->post('login', [ 'as' => 'login', 'uses' => 'AuthApi\AuthenticationController@login']);

Route::middleware('auth:api')->get('logout', [ 'as' => 'logout', 'uses' => 'AuthApi\AuthenticationController@logout']);


/*
|--------------------------------------------------------------------------
| API Group Routes
| 1. Products
| 2. Stocks
| 3. Sales 
| 4. Orders
| 5. 
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:api', 'cors'], 'prefix' => 'v1' ], function() {

    /*
    |--------------------------------------------------------------------------
    | Products Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'products'], function()
    {

    });

    /*
    |--------------------------------------------------------------------------
    | Stocks Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'stocks'], function()
    {

    });

    /*
    |--------------------------------------------------------------------------
    | Sales Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'sales'], function()
    {

    });

    /*
    |--------------------------------------------------------------------------
    | Products Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'orders'], function()
    {

    });
    
});