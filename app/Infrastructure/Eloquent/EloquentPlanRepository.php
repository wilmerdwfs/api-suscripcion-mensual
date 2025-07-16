<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Models\Plan;
use App\Domain\Repositories\PlanRepositoryInterface;

class EloquentPlanRepository implements PlanRepositoryInterface
{
    public function findById(int $id): Plan
    {
        return Plan::findOrFail($id);
    }

    public function save(Plan $plan): Plan
    {
        $plan->save();
        
        return $plan;
    }

    public function getAll(): array
    {
        return Plan::all()->toArray();
    }

    public function delete(Plan $plan): void
    {
        $plan->delete();
    }
}