<?php
namespace Bmatovu\ArtisanGui\Tests;

use Bmatovu\ArtisanGui\ArtisanGuiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Add package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ArtisanGuiServiceProvider::class,
        ];
    }
}
