<?php

namespace Sedhossein\Pregex;

use Illuminate\Support\ServiceProvider;

class PersianRegexServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->make('Sedhossein\PersianRegex\Pregex.php');
        $this->app->singleton(Pregex::class, function ($app) {
            return new Pregex();
        });
    }



}
