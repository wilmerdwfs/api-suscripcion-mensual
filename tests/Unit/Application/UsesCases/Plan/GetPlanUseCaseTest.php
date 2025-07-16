<?php

namespace Tests\Unit\Application\UseCases\Plan;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Plan\GetPlanUseCase;
use App\Domain\Repositories\PlanRepositoryInterface;
use App\Domain\ValueObjects\Plan\Caracteristicas;
use App\Domain\Models\Plan;

class GetPlanUseCaseTest extends TestCase
{
    public function test_obtiene_plan_por_id_con_caracteristicas()
    {
        $plan = new Plan([
            'id' => 1,
            'nombre' => 'Plan Básico',
            'precio_mensual' => 15000,
            'limite_usuarios' => 20,
            'caracteristicas' => 3, // DOMINIO_PERSONALIZADO + ACCESO_API
        ]);

        $planRepo = Mockery::mock(PlanRepositoryInterface::class);
        $planRepo->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($plan);

        $useCase = new GetPlanUseCase($planRepo);

        $resultado = $useCase->execute(1);

        $this->assertIsArray($resultado);
        $this->assertEquals('Plan Básico', $resultado['nombre']);
        $this->assertTrue($resultado['caracteristicas']['DOMINIO_PERSONALIZADO']);
        $this->assertTrue($resultado['caracteristicas']['ACCESO_API']);
        $this->assertFalse($resultado['caracteristicas']['PANEL_ANALITICAS']);
    }

    public function test_lanza_excepcion_si_plan_no_existe()
    {
        $planRepo = Mockery::mock(PlanRepositoryInterface::class);
        $planRepo->shouldReceive('findById')
            ->with(999)
            ->once()
            ->andReturn(null);

        $useCase = new GetPlanUseCase($planRepo);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Plan no encontrado');

        $useCase->execute(999);
    }

    public function test_obtiene_todos_los_planes_con_caracteristicas()
    {
        $planes = [
            [
                'id' => 1,
                'nombre' => 'Plan A',
                'precio_mensual' => 10000,
                'limite_usuarios' => 10,
                'caracteristicas' => 1 // DOMINIO_PERSONALIZADO
            ],
            [
                'id' => 2,
                'nombre' => 'Plan B',
                'precio_mensual' => 20000,
                'limite_usuarios' => 50,
                'caracteristicas' => 7 // Todas activas
            ],
        ];

        $planRepo = Mockery::mock(PlanRepositoryInterface::class);
        $planRepo->shouldReceive('getAll')
            ->once()
            ->andReturn($planes);

        $useCase = new GetPlanUseCase($planRepo);

        $resultado = $useCase->executeAll();

        $this->assertCount(2, $resultado);
        $this->assertTrue($resultado[0]['caracteristicas']['DOMINIO_PERSONALIZADO']);
        $this->assertFalse($resultado[0]['caracteristicas']['ACCESO_API']);
        $this->assertTrue($resultado[1]['caracteristicas']['PANEL_ANALITICAS']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}