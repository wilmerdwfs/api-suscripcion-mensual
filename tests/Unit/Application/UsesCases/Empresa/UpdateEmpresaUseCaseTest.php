<?php

namespace Tests\Unit\Application\UseCases\Empresa;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Empresa\UpdateEmpresaUseCase;
use App\Application\DTOs\Empresa\UpdateEmpresaDTO;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Models\Empresa;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateEmpresaUseCaseTest extends TestCase
{
    public function test_actualiza_empresa_correctamente()
    {
        // Arrange
        $empresa = new Empresa([
            'id' => 1,
            'nombre' => 'Nombre Antiguo',
        ]);

        $dto = new UpdateEmpresaDTO(
            id: 1,
            nombre: 'Nuevo Nombre'
        );

        $empresaRepo = Mockery::mock(EmpresaRepositoryInterface::class);
        $empresaRepo->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($empresa);

        $empresaRepo->shouldReceive('save')
            ->with(Mockery::on(function ($e) {
                return $e->nombre === 'Nuevo Nombre';
            }))
            ->once()
            ->andReturnUsing(fn($e) => $e);

        $useCase = new UpdateEmpresaUseCase($empresaRepo);

        // Act
        $resultado = $useCase->execute($dto);

        // Assert
        $this->assertInstanceOf(Empresa::class, $resultado);
        $this->assertEquals('Nuevo Nombre', $resultado->nombre);
    }

    public function test_lanza_excepcion_si_empresa_no_existe()
    {
        $dto = new UpdateEmpresaDTO(
            id: 999,
            nombre: 'Cualquiera'
        );

        $empresaRepo = Mockery::mock(EmpresaRepositoryInterface::class);
        $empresaRepo->shouldReceive('findById')
            ->with(999)
            ->once()
            ->andThrow(ModelNotFoundException::class);

        $useCase = new UpdateEmpresaUseCase($empresaRepo);

        // Assert + Act
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Empresa no encontrada');
        $this->expectExceptionCode(404);

        $useCase->execute($dto);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}