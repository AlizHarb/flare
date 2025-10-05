<?php

declare(strict_types=1);

namespace AlizHarb\Flare;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

/**
 * FlareServiceProvider registers and bootstraps the Flare toast notification system.
 *
 * This service provider handles:
 * - Registering the FlareManager singleton
 * - Registering Livewire and Blade components
 * - Creating custom Blade directives
 * - Publishing configuration and assets
 */
final class FlareServiceProvider extends ServiceProvider
{
    /**
     * Register services in the container.
     *
     * Binds the FlareManager as a singleton and merges package configuration.
     */
    public function register(): void
    {
        $this->app->singleton('flare', fn($app) => new FlareManager());

        $this->app->alias('flare', FlareManager::class);

        $this->mergeConfigFrom(
            __DIR__.'/../config/flare.php',
            'flare'
        );
    }

    /**
     * Bootstrap application services.
     *
     * Registers components, directives, and publishable resources.
     */
    public function boot(): void
    {
        $this->registerLivewireComponents();
        $this->registerBladeComponents();
        $this->registerBladeDirectives();
        $this->registerPublishables();
    }

    /**
     * Register Livewire components used by Flare.
     *
     * Registers the main toast display component for Livewire.
     */
    protected function registerLivewireComponents(): void
    {
        Livewire::component('flare-toasts', \AlizHarb\Flare\Livewire\Toasts::class);
    }

    /**
     * Register Blade components used by Flare.
     *
     * Registers individual toast and toast group Blade components.
     */
    protected function registerBladeComponents(): void
    {
        Blade::component('flare::toast', \AlizHarb\Flare\View\Components\Toast::class);
        Blade::component('flare::toast.group', \AlizHarb\Flare\View\Components\ToastGroup::class);
    }

    /**
     * Register custom Blade directives.
     *
     * Creates @flareScripts and @flareStyles directives for easy asset inclusion.
     */
    protected function registerBladeDirectives(): void
    {
        Blade::directive('flareScripts', fn() => "<?php echo app('flare')->scripts(); ?>");

        Blade::directive('flareStyles', fn() => "<?php echo app('flare')->styles(); ?>");
    }

    /**
     * Register publishable resources.
     *
     * Makes configuration, views, and assets publishable to the application.
     */
    protected function registerPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/flare.php' => config_path('flare.php'),
            ], 'flare-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/flare'),
            ], 'flare-views');

            $this->publishes([
                __DIR__.'/../resources/js' => public_path('vendor/flare'),
                __DIR__.'/../resources/css' => public_path('vendor/flare'),
            ], 'flare-assets');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'flare');
    }
}
