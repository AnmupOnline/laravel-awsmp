<?php

namespace Anmup\LaravelAwsMp;

use Illuminate\Support\ServiceProvider;


class AwsMpServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Publish Config
         */
        $this->publishes([ __DIR__.'/config/awsmp.php' => config_path('awsmp.php')], 'awsmp-config');
        $this->publishes([ __DIR__.'/database/migrations' => database_path('migrations')], 'awsmp-migrations');

        /**
         * Load Route
         */
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        /**
         * Load Migrations
         */
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        $this->mergeConfigFrom( __DIR__.'/config/awsmp.php', 'awsmp');

    }
}