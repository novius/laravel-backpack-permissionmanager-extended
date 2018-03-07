<?php

namespace Novius\Backpack\PermissionManager;

use Illuminate\Support\ServiceProvider;
use Backpack\PermissionManager\PermissionManagerServiceProvider as OriginalPermissionManagerServiceProvider;

class PermissionManagerServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $appRootDir = dirname(__DIR__, 1);

        // Setups the routes
        $this->setupRoutes($this->app->router);

        // Publishes the config, routes and lang files
        $this->publishes([$appRootDir.'/config' => config_path('backpackextended')], 'config');
        $this->publishes([$appRootDir.'/routes' => base_path().'/routes/backpackextended'], 'routes');
        $this->publishes([$appRootDir.'/resources/lang' => resource_path('lang/vendor/backpack-permissionmanager-extended')], 'lang');
        $this->publishes([$appRootDir.'/resources/views' => resource_path('views/vendor/backpack-permissionmanager-extended')], 'views');

        // Loads the views
        $this->loadViewsFrom($appRootDir.'/resources/views', 'backpack-permissionmanager-extended');

        // Loads the translations
        $this->loadTranslationsFrom($appRootDir.'/resources/lang', 'backpack-permissionmanager-extended');

        // Merges the current package config into the Backpack\PermissionManager config
        $this->mergeConfigTo($appRootDir.'/config/permissionmanager.php', 'laravel-permission');

        // Merges the Backpack\PermissionManager local config into the Backpack\PermissionManager config
        if (file_exists(config_path('laravel-permission.php'))) {
            $this->mergeConfigTo(config_path('laravel-permission.php'), 'laravel-permission');
        }

        // Merges the current local package config into the Backpack\PermissionManager config
        if (file_exists(config_path('backpackextended/permissionmanager.php'))) {
            $this->mergeConfigTo(config_path('backpackextended/permissionmanager.php'), 'laravel-permission');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Registers Backpack\PermissionManager service provider
        $this->app->register(OriginalPermissionManagerServiceProvider::class);
    }

    /**
     * Merges the specified config from another package. Does the opposite of mergeConfigFrom().
     *
     * @param $path
     * @param $key
     */
    protected function mergeConfigTo($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        $this->app['config']->set($key, array_merge($config, require $path));
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function setupRoutes()
    {
        // Loads the route file from the local app if exists
        if (file_exists(base_path('routes/backpackextended/permissionmanager.php'))) {
            $this->loadRoutesFrom(base_path('routes/backpackextended/permissionmanager.php'));
        }
        // Otherwise loads the route file from the current package
        else {
            $this->loadRoutesFrom(dirname(__DIR__, 1).'/routes/permissionmanager.php');
        }
    }
}
