<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\AccessRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $requests = AccessRequest::where('seen', 0)->get();

        $requests_number = count($requests);

        view()->share('requests_number', $requests_number);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
