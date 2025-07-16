<?php

namespace Tests\Unit\Application\UseCases\Plan;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Plan\CreatePlanUseCase;
use App\Application\DTOs\Plan\CreatePlanDTO;
use App\Domain\Repositories\PlanRepositoryInterface;
use App\Domain\Models\Plan;

class CreatePlanUseCaseTest extends TestCase
{
    public function test_crea_plan_correctamente()
    {
        $dto = new CreatePlanDTO(
            nombre: 'Plan Premium',
            precioMensual: 5000,
            limiteUsuarios: 50,
            caracteristicas: 7
        );

        $planRepo = Mockery::mock(PlanRepositoryInterface::class);

        // Esperamos que se llame save con un Plan que tiene ciertas propiedades
        $planRepo->shouldReceive('save')
            ->once()
            ->with(Mockery::on(function ($plan) use ($dto) {
                return $plan instanceof Plan
                    && $plan->nombre === $dto->nombre
                    && $plan->precio_mensual === $dto->precioMensual
                    && $plan->limite_usuarios === $dto->limiteUsuarios  // Nota: cuidado con typo en clave
                    && $plan->caracteristicas === $dto->caracteristicas;
            }))
            ->andReturnUsing(fn($plan) => $plan); // Retorna el mismo plan

        $useCase = new CreatePlanUseCase($planRepo);

        $resultado = $useCase->execute($dto);

        $this->assertInstanceOf(Plan::class, $resultado);
        $this->assertEquals($dto->nombre, $resultado->nombre);
        $this->assertEquals($dto->precioMensual, $resultado->precio_mensual);
        $this->assertEquals($dto->limiteUsuarios, $resultado->limite_usuarios);
        $this->assertEquals($dto->caracteristicas, $resultado->caracteristicas);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}