<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('greater_than', function($attribute, $value, $parameters) 
        { 
            $other = $parameters[0];
            // var_dump($parameters);
            // dd($value);

            return isset($other) and intval($value) > intval($other);
        });


        Validator::extend('less_than', function($attribute, $value, $parameters)
        {
            $other = Input::get($parameters[0]);
            
            return isset($other) and intval($value) < intval($other);
        });
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
