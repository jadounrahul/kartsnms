<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use KartsNMS\Config;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Config::load();
    }
}
