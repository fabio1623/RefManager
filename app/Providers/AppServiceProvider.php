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
        $default_password = 'azerty';

        view()->share(['requests_number'=>$requests_number, 'default_password'=>$default_password]);
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
