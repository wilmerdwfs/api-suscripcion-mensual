<?php

namespace Tests\Unit\Application\UseCases\Plan;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Plan\UpdatePlanUseCase;
use App\Application\DTOs\Plan\UpdatePlanDTO;
use App\Domain\Repositories\PlanRepositoryInterface;
use App\Domain\Models\Plan;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdatePlanUseCaseTest extends TestCase
{
    public function test_actualiza_plan_correctamente()
    {
        $dto = new UpdatePlanDTO(
            id: 1,
            nombre: 'Nuevo Plan',
            precioMensual: 20000,
            limiteUsuarios: 50,
            caracteristicas: 7
        );

        $plan = new Plan([
            'id' => 1,
            'nombre' => 'Antiguo Plan',
            'precio_mensual' => 10000,
            'limite_usuarios' => 20,
            'caracteristicas' => 3
        ]);

        $planRepo = Mockery::mock(PlanRepositoryInterface::class);
        $planRepo->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($plan);

        $planRepo->shouldReceive('save')
            ->with(Mockery::on(function ($p) use ($dto) {
                return $p->nombre === $dto->nombre &&
                       $p->precio_mensual === $dto->precioMensual &&
                       $p->limite_usuarios === $dto->limiteUsuarios &&
                       $p->caracteristicas === $dto->caracteristicas;
            }))
            ->once()
            ->andReturnUsing(fn($p) => $p);

        $useCase = new UpdatePlanUseCase($planRepo);
        $resultado = $useCase->execute($dto);

        $this->assertInstanceOf(Plan::class, $resultado);
        $this->assertEquals($dto->nombre, $resultado->nombre);
        $this->assertEquals($dto->precioMensual, $resultado->precio_mensual);
        $this->assertEquals($dto->limiteUsuarios, $resultado->limite_usuarios);
        $this->assertEquals($dto->caracteristicas, $resultado->caracteristicas);
    }

    public function test_lanza_excepcion_si_no_encuentra_plan()
    {
        $dto = new UpdatePlanDTO(
            id: 999,
            nombre: 'No Existe',
            precioMensual: 1000,
            limiteUsuarios: 10,
            caracteristicas: 0
        );

        $planRepo = Mockery::mock(PlanRepositoryInterface::class);
        $planRepo->shouldReceive('findById')
            ->with(999)
            ->once()
            ->andThrow(ModelNotFoundException::class);

        $useCase = new UpdatePlanUseCase($planRepo);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Plan no encontrado');
        $this->expectExceptionCode(404);

        $useCase->execute($dto);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}