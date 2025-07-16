<?php

namespace Tests\Unit\Application\UseCases\Empresa;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Empresa\GetEmpresaUseCase;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Models\Empresa;

class GetEmpresaUseCaseTest extends TestCase
{
    public function test_obtiene_empresa_por_id()
    {
        // Arrange
        $empresa = new Empresa([
            'id' => 1,
            'nombre' => 'Empresa Demo',
            'plan_id' => 1,
        ]);

        $empresaRepo = Mockery::mock(EmpresaRepositoryInterface::class);
        $empresaRepo->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($empresa);

        $useCase = new GetEmpresaUseCase($empresaRepo);

        // Act
        $resultado = $useCase->execute(1);

        // Assert
        $this->assertInstanceOf(Empresa::class, $resultado);
        $this->assertEquals('Empresa Demo', $resultado->nombre);
    }

    public function test_obtiene_todas_las_empresas()
    {
        $empresa1 = new Empresa(['id' => 1, 'nombre' => 'Empresa 1']);
        $empresa2 = new Empresa(['id' => 2, 'nombre' => 'Empresa 2']);

        $empresaRepo = Mockery::mock(EmpresaRepositoryInterface::class);
        $empresaRepo->shouldReceive('getAll')
            ->once()
            ->andReturn([$empresa1, $empresa2]);

        $useCase = new GetEmpresaUseCase($empresaRepo);

        // Act
        $resultado = $useCase->executeAll();

        // Assert
        $this->assertIsArray($resultado);
        $this->assertCount(2, $resultado);
        $this->assertEquals('Empresa 1', $resultado[0]->nombre);
        $this->assertEquals('Empresa 2', $resultado[1]->nombre);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}