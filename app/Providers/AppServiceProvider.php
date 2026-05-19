<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SuccessMessageService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SuccessMessageService::class, function ($app) {
            return new SuccessMessageService();
        });    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
