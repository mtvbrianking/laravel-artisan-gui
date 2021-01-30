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
                __DIR__.'/../config/artisan-gui.php' => config_path('artisan-gui.php'),
            ], 'artisan-gui-config');

            $this->publishes([
                __DIR__.'/../resources/js/components' => base_path('resources/js/components/artisan-gui'),
            ], 'artisan-gui-components');
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
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
