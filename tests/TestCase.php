<?php
namespace Bmatovu\ArtisanGui\Tests;

use Bmatovu\ArtisanGui\ArtisanGuiServiceProvider;
use Illuminate\Container\Container;
use Illuminate\Contracts\Console\Kernel;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setup(): void
    {
        parent::setUp();

        $dummyCommand = new DummyCommand();

        Container::getInstance()
            ->make(Kernel::class)
            ->registerCommand($dummyCommand);
    }

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
