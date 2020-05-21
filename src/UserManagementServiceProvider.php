<?php

namespace KornerBI\UserManagement;

use Illuminate\Support\ServiceProvider;
use KornerBI\UserManagement\Providers\SeedServiceProvider;

class UserManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'user_management');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'user_management');

        $this->publishes([
            __DIR__.'/config/user-management.php' => config_path('user-management.php')
        ], 'config');
        $this->publishes([
            __DIR__ . '/resources/js/components/SimpleTableComponent.vue' => resource_path('js/components/SimpleTableComponent.vue')
        ], 'vue-components');
    }
}
