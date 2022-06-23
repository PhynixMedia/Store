<?php

/*
|--------------------------------------------------------------------------
| Store Routes
|--------------------------------------------------------------------------
|
| Here is where you can register store routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
|--------------------------------------------------------------------------
| Store Group Routes
| 1. io
| 2. orders - customers
| 3. products - category
|--------------------------------------------------------------
*/
Route::group(['middleware' => ['web']], function () 
{

    /*
    |--------------------------------------------------------------------------
    | Products Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'store'], function()
    {
        Route::get('list/', 'Store\Manager\Controllers\Products\ProductsController@all')->name('store.view');
        Route::get('/store/search', 'Store\Manager\Controllers\Products\ProductsController@search')->name('store.search');
        Route::get('/{id}/selected/{name}', 'Store\Manager\Controllers\Products\ProductsController@get')->name('store.product.details');
        
        /*--------------------------------------------------------------------------
        | Products Category Routes
        |--------------------------------------------------------------------------*/
        Route::group(['prefix' => 'category'], function()
        {
            Route::get('/', 'Store\Manager\Controllers\Products\Category\CategoryController@all')->name('store.category.view');
            Route::get('/{id}/selected/{name}', 'Store\Manager\Controllers\Products\Category\CategoryController@get')->name('store.category.products');
        });
    });

    /*--------------------------------------------------------------------------
    | Ajax Request Routes
    |--------------------------------------------------------------------------*/
    Route::group(['prefix' => 'ajax'], function()
    {
        Route::get('/get/product/quick-view/{id}', 'Store\Manager\Controllers\Products\ProductsController@_get')->name('store.get.product.quick.view');
    });

});