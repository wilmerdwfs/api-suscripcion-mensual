<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Plan;

interface PlanRepositoryInterface
{
    public function findById(int $id): ?Plan;
    public function save(Plan $plan): Plan;
    public function getAll(): array;
    public function delete(Plan $plan): void;
}