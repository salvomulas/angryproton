<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FPDFServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the FPDF application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('FPDF', function ($app) {
            return new \fpdf\FPDF();
        });
    }
}
