<?php

namespace Tests\Unit\Application\UseCases\Empresa;

use Tests\TestCase;
use App\Application\UseCases\Empresa\CambiarPlanUseCase;
use App\Application\DTOs\Empresa\CambiarPlanDTO;
use App\Domain\Models\Empresa;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Repositories\SuscripcionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Mockery;

class CambiarPlanUseCaseTest extends TestCase
{
   public function test_cambiar_plan_correctamente()
{
    $empresaRepo = Mockery::mock(EmpresaRepositoryInterface::class);
    $suscripcionRepo = Mockery::mock(SuscripcionRepositoryInterface::class);

    $useCase = new CambiarPlanUseCase($empresaRepo, $suscripcionRepo);

    $empresa = new Empresa();
    $empresa->id = 1;
    $empresa->plan_id = 1;

    $dto = new CambiarPlanDTO(
        empresaId: 1,
        planNuevoId: 2
    );

    $empresaRepo->shouldReceive('findById')->with(1)->andReturn($empresa);
    $suscripcionRepo->shouldReceive('registrarHistorialCambio')->once()->with(1, 1, 2);
    $empresaRepo->shouldReceive('save')->once();

    DB::shouldReceive('transaction')->andReturnUsing(function ($callback) {
        $callback();
    });

    $useCase->execute($dto);

    $this->assertEquals(2, $empresa->plan_id);
}
}