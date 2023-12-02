<?php

namespace Unibrick\PAuth;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class PAuthServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'unibrick');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'unibrick');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'pauth');

        $this->configurePublishing();
        $this->configureRoutes();
        $this->configureComponents();
    }

    public function configureComponents(): void
    {
        Blade::componentNamespace('Unibrick\\PAuth\\View\\Components', 'pauth');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/pauth.php', 'unibrick.pauth');

        // Register the service the package provides.
        $this->app->singleton('pauth', function ($app) {
            return new PAuth;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pauth'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/pauth.php' => config_path('unibrick/pauth.php'),
        ], 'pauth.config');


        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/unibrick'),
        ], 'pauth.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/unibrick'),
        ], 'pauth.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }

    /**
     * Configure the publishable resources offered by the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/pauth.php' => config_path('unibrick/pauth.php'),
            ], 'pauth-config');

            // Publishing the views.
            $this->publishes([
                __DIR__ . '/../stubs/views' => base_path('resources/views'),
            ], 'pauth-views');

//            $this->publishes([
//                __DIR__.'/../stubs/CreateNewUser.php' => app_path('Actions/Fortify/CreateNewUser.php'),
//                __DIR__.'/../stubs/FortifyServiceProvider.php' => app_path('Providers/FortifyServiceProvider.php'),
//                __DIR__.'/../stubs/PasswordValidationRules.php' => app_path('Actions/Fortify/PasswordValidationRules.php'),
//                __DIR__.'/../stubs/ResetUserPassword.php' => app_path('Actions/Fortify/ResetUserPassword.php'),
//                __DIR__.'/../stubs/UpdateUserProfileInformation.php' => app_path('Actions/Fortify/UpdateUserProfileInformation.php'),
//                __DIR__.'/../stubs/UpdateUserPassword.php' => app_path('Actions/Fortify/UpdateUserPassword.php'),
//            ], 'fortify-support');

//            $this->publishes([
//                __DIR__.'/../database/migrations' => database_path('migrations'),
//            ], 'fortify-migrations');
        }
    }

    /**
     * Configure the routes offered by the application.
     *
     * @return void
     */
    protected function configureRoutes()
    {
        if (PAuth::$registersRoutes) {
            Route::group([
                'namespace' => 'Unibrick\PAuth\Http\Controllers',
                'domain' => config('unibrick.pauth.domain'),
                'prefix' => config('unibrick.pauth.prefix'),
            ], function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
            });
        }
    }
}
