<?php

namespace App\Providers;

use Kreait\Firebase;
use Illuminate\Support\ServiceProvider;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Firebase::class, function() {
            return (new Firebase\Factory())
                ->withCredentials(config('database.connections.firebase.credentials'))
                ->create();
        });

        $this->app->alias(Firebase::class, 'firebase');
    }
}