<?php

namespace Extsalt\Otp;

use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerResources();

        if ($this->app->runningInConsole()) {
            $this->registerPublishing();
        }
    }

    /**
     * Register resources
     *
     * @return  void
     */
    private function registerResources()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->registerFacades();
    }

    /**
     * Register publishable resources
     *
     * @return void
     */
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/sms.php' => config_path('sms.php'),
            __DIR__ . '/../database/migrations' => database_path('migrations')
        ], 'extsalt-sms');
    }

    /**
     * Register facades
     *
     * @return void
     */
    protected function registerFacades()
    {
        $this->app->singleton('SMS', function ($app) {
            return \Extsalt\Otp\SMSVendorBuilder::build();
        });
    }
}