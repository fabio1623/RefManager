<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\AccessRequest;
use App\DefaultPassword;

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
        
        // $passwords = DefaultPassword::all();
        // if (count($passwords) > 0) {
        //     $password_created = true;
        // }
        // else {
        //     $password_created = false;
        // }
        // $password = DefaultPassword::find(1);

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
