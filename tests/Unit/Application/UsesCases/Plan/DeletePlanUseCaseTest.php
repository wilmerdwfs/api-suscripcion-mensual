<?php

namespace Tests\Unit\Application\UseCases\Plan;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Plan\DeletePlanUseCase;
use App\Domain\Repositories\PlanRepositoryInterface;
use App\Domain\Models\Plan;

class DeletePlanUseCaseTest extends TestCase
{
    public function test_elimina_plan_correctamente()
    {
        $plan = new Plan(['id' => 1, 'nombre' => 'Plan de prueba']);

        $planRepo = Mockery::mock(PlanRepositoryInterface::class);

        // Esperamos que findById se llame con id 1 y retorne el plan
        $planRepo->shouldReceive('findById')
            ->once()
            ->with(1)
            ->andReturn($plan);

        // Esperamos que delete se llame con el objeto plan
        $planRepo->shouldReceive('delete')
            ->once()
            ->with($plan);

        $useCase = new DeletePlanUseCase($planRepo);

        $useCase->execute(1);

        // No assert explícito: Mockery valida que se cumplan las expectativas
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}