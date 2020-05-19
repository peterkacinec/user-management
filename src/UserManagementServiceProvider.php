<?php

namespace KornerBI\UserManagement;

use Illuminate\Support\ServiceProvider;

class UserManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('KornerBI\UserManagement\Controllers\UserManagementController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'user_management');
//        $this->loadMigrationsFrom(__DIR__.'/path/to/migrations');
//        $this->loadTranslationsFrom(__DIR__.'/path/to/translations', 'courier');
    }
}
