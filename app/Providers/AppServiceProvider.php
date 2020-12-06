<?php
namespace App\Providers;

use App\Services\Impl\NbViewsServiceImpl;
use App\Services\NbViewsService;
use Illuminate\Support\ServiceProvider;

/**
 * Базовый провайдер
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(NbViewsService::class, function ($app) {
            return new NbViewsServiceImpl();
        });
    }
}
