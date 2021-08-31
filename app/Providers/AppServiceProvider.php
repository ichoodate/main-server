<?php

namespace App\Providers;

use Database\Seeds\DatabaseSeeder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind('DatabaseSeeder', DatabaseSeeder::class);
    }
}
