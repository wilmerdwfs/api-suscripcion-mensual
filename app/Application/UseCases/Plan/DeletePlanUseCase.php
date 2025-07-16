<?php
namespace App\Application\UseCases\Plan;

use App\Domain\Repositories\PlanRepositoryInterface;

class DeletePlanUseCase
{
    public function __construct(
        private PlanRepositoryInterface $planRepository
    ) {}

    public function execute(int $id)
    {
        $plan = $this->planRepository->findById($id);
        $this->planRepository->delete($plan);
    }
}