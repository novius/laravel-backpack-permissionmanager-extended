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

        // Setups the routes for the application
        $this->setupRoutes($this->app->router);

        // Publishes the extended config
        $this->publishes([$appRootDir.'/config/permission-extended.php' => base_path().'/config/backpack-permission-extended.php'], 'config');

        $this->loadViewsFrom($appRootDir.'/resources/views', 'backpack-permission-extended');

        // Merges the current package config into the Backpack\PermissionManager config
        $this->mergeConfigTo($appRootDir.'/config/permission-extended.php', 'laravel-permission');

        // Merges the Backpack\PermissionManager local config into the Backpack\PermissionManager config
        if (file_exists(config_path('laravel-permission.php'))) {
            $this->mergeConfigTo(config_path('laravel-permission.php'), 'laravel-permission');
        }

        // Merges the current local package config into the Backpack\PermissionManager config
        if (file_exists(config_path('backpack-permission-extended.php'))) {
            $this->mergeConfigTo(config_path('backpack-permission-extended.php'), 'laravel-permission');
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
        $routeFilePath = '/routes/backpack/permissionmanager-extended.php';

        // Loads the route file from the local app if exists
        if (file_exists(base_path().$routeFilePath)) {
            $this->loadRoutesFrom(base_path().$routeFilePath);
        }
        // Otherwise loads the route file from the current package
        else {
            $this->loadRoutesFrom(dirname(__DIR__, 1).$routeFilePath);
        }
    }
}
