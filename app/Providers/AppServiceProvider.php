<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\PlanRepositoryInterface;
use App\Infrastructure\Eloquent\EloquentPlanRepository;

use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Infrastructure\Eloquent\EloquentEmpresaRepository;

use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Infrastructure\Eloquent\EloquentUsuarioRepository;

use App\Domain\Repositories\SuscripcionRepositoryInterface;
use App\Infrastructure\Eloquent\EloquentSuscripcionRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            PlanRepositoryInterface::class,
            EloquentPlanRepository::class
        );

        $this->app->bind(
            EmpresaRepositoryInterface::class,
            EloquentEmpresaRepository::class
        );

        $this->app->bind(
            UsuarioRepositoryInterface::class,
            EloquentUsuarioRepository::class
        );

        $this->app->bind(
            SuscripcionRepositoryInterface::class,
            EloquentSuscripcionRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
