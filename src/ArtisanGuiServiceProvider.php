<?php

namespace Bmatovu\ArtisanGui;

use Illuminate\Support\ServiceProvider;

class ArtisanGuiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/artisan-gui.php' => base_path('config/artisan-gui.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/artisan-gui.php', 'artisan-gui');
    }
}
