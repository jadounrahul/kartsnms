<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CliServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Restrict KartsNMS CLI commands
        if (defined('ARTISAN_BINARY') && ARTISAN_BINARY == 'lnms' && $this->app->environment() == 'production') {
            $this->app->register(\NunoMaduro\LaravelConsoleSummary\LaravelConsoleSummaryServiceProvider::class);
        }
    }
}
