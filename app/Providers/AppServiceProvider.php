<?php

namespace App\Providers;

use Domain\PlanetRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\SwapiPlanetRepository;

class AppServiceProvider extends ServiceProvider
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
        $this->app->singleton(PlanetRepositoryInterface::class, SwapiPlanetRepository::class);
    }
}
