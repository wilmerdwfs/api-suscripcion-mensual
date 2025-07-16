<?php

namespace Tests\Unit\Application\UseCases\Plan;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Plan\GetPlanCaracteristicasUseCase;
use App\Domain\Repositories\PlanRepositoryInterface;
use App\Domain\Models\Plan;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Domain\ValueObjects\Plan\Caracteristicas;

class GetPlanCaracteristicasUseCaseTest extends TestCase
{
    public function test_devuelve_caracteristicas_correctamente()
    {
        $caracteristicasInt = 5; // valor arbitrario, ajusta según tus flags en Caracteristicas

        $plan = new Plan([
            'id' => 1,
            'caracteristicas' => $caracteristicasInt,
        ]);

        $planRepo = Mockery::mock(PlanRepositoryInterface::class);
        $planRepo->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($plan);

        $useCase = new GetPlanCaracteristicasUseCase($planRepo);

        $resultado = $useCase->execute(1);

        $this->assertIsArray($resultado);
        $this->assertArrayHasKey('DOMINIO_PERSONALIZADO', $resultado);
        $this->assertArrayHasKey('ACCESO_API', $resultado);
        $this->assertArrayHasKey('PANEL_ANALITICAS', $resultado);

        // Opcional: Asumiendo que Caracteristicas::fromInt(5) devuelve true/false
        $caracts = Caracteristicas::fromInt($caracteristicasInt);
        $this->assertEquals($caracts->tieneDominioPersonalizado(), $resultado['DOMINIO_PERSONALIZADO']);
        $this->assertEquals($caracts->tieneAccesoApi(), $resultado['ACCESO_API']);
        $this->assertEquals($caracts->tienePanelAnaliticas(), $resultado['PANEL_ANALITICAS']);
    }

    public function test_lanza_excepcion_si_plan_no_existe()
    {
        $planRepo = Mockery::mock(PlanRepositoryInterface::class);
        $planRepo->shouldReceive('findById')
            ->with(999)
            ->once()
            ->andReturnNull();

        $useCase = new GetPlanCaracteristicasUseCase($planRepo);

        $this->expectException(ModelNotFoundException::class);
        $this->expectExceptionMessage('Plan no encontrado');

        $useCase->execute(999);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}