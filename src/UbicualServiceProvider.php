<?php

namespace Kineticamobile\Ubicual;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;

class UbicualServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'lubichannel');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'lubichannel');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('ubicual.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/lubichannel'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/lubichannel'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/lubichannel'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }
    /**
     * Register the application services.
     */
    public function register()
    {
        // $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'lubichannel');
        $this->app->bind(UbicualConfig::class, function () {
            return new UbicualConfig($this->app['config']['ubicual']);
        });

        Notification::extend('ubicual', function ($app) {
            return new UbicualChannel(
                $this->app->make(Ubicual::class),
                $this->app->make(Dispatcher::class)
            );
        });
    }
}
