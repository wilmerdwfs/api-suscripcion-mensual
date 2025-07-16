<?php
namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Repositories\PlanRepositoryInterface;
use App\Infrastructure\Eloquent\Repositories\EloquentPlanRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PlanRepositoryInterface::class,
            EloquentPlanRepository::class
        );
        
        // Más bindings...
    }
}