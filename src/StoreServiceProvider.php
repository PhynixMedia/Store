<?php

namespace Store\Manager;

use Illuminate\Support\ServiceProvider;

class StoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes/web.php';
        include __DIR__ . '/routes/api.php';

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        //register the view
        $this->mergeConfigFrom(__DIR__ . '/config/store-app.php', 'store-app');
        $this->publishes([
            __DIR__ . '/config/store-app.php' => config_path('store-app.php'),
            __DIR__ . '/views' => resource_path('views/vendor/store/'),
        ]);

        //register the view
        $this->loadViewsFrom(resource_path('views/vendor/store'), 'store-app');

    }

}
