<?php

declare(strict_types=1);

namespace AlizHarb\Flare\Tests;

use AlizHarb\Flare\FlareServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

/**
 * Base test case for Flare package tests.
 */
abstract class TestCase extends Orchestra
{
    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            LivewireServiceProvider::class,
            FlareServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('flare.position', 'bottom end');
        $app['config']->set('flare.duration', 5000);
        $app['config']->set('flare.max_visible', 3);
        $app['config']->set('flare.stack_expanded', false);
    }
}
