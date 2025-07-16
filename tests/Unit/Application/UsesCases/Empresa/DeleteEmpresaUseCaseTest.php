<?php

namespace Tests\Unit\Application\UseCases\Empresa;

use Tests\TestCase;
use Mockery;
use App\Domain\Models\Empresa;
use App\Domain\Models\Usuario;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Application\UseCases\Empresa\DeleteEmpresaUseCase;

class DeleteEmpresaUseCaseTest extends TestCase
{
    public function test_elimina_empresa_y_usuarios_relacionados()
    {
        // Arrange
        $usuario1 = new Usuario(['id' => 1, 'nombre' => 'Usuario 1']);
        $usuario2 = new Usuario(['id' => 2, 'nombre' => 'Usuario 2']);

        $empresa = new Empresa(['id' => 10, 'nombre' => 'Empresa Prueba']);
        $empresa->setRelation('usuarios', collect([$usuario1, $usuario2]));

        $empresaRepo = Mockery::mock(EmpresaRepositoryInterface::class);
        $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);

        $empresaRepo->shouldReceive('findById')
            ->with(10)
            ->once()
            ->andReturn($empresa);

        $usuarioRepo->shouldReceive('delete')->with($usuario1)->once();
        $usuarioRepo->shouldReceive('delete')->with($usuario2)->once();

        $empresaRepo->shouldReceive('delete')->with($empresa)->once();

        $useCase = new DeleteEmpresaUseCase($empresaRepo, $usuarioRepo);

        // Act
        $useCase->execute(10);

        // No se necesitan asserts explícitos; Mockery valida las expectativas
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}