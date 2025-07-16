<?php

namespace Tests\Unit\Application\UseCases\Usuario;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Usuario\GetUsuarioUseCase;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Models\Usuario;

class GetUsuarioUseCaseTest extends TestCase
{
    public function test_obtiene_usuario_por_id()
    {
        $usuarioId = 42;
        $usuario = new Usuario(['id' => $usuarioId]);

        $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);
        $usuarioRepo->shouldReceive('findById')
            ->with($usuarioId)
            ->once()
            ->andReturn($usuario);

        $useCase = new GetUsuarioUseCase($usuarioRepo);

        $resultado = $useCase->execute($usuarioId);

        $this->assertSame($usuario, $resultado);
    }

    public function test_obtiene_todos_los_usuarios_si_es_admin()
{
    // Empresa relacionada
    $empresa = new \App\Domain\Models\Empresa(['id' => 1]);

    // Usuario autenticado (admin de esa empresa)
    $usuario = new Usuario([
        'id' => 1,
        'empresa_id' => 1,
        'es_admin' => 1,
    ]);
    $usuario->setRelation('empresa', $empresa);

    // Mock del repositorio
    $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);
    $usuarioRepo->shouldReceive('getAll')
        ->once()
        ->andReturn(['usuario1', 'usuario2']);

    // Ejecutar el caso de uso
    $useCase = new GetUsuarioUseCase($usuarioRepo);

    // Act
    $resultado = $useCase->executeAll($usuario);

    // Assert
    $this->assertIsArray($resultado);
    $this->assertCount(2, $resultado);
}


    public function test_lanza_excepcion_si_no_es_admin()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No autorizado para gestionar esta empresa.');

        $usuario = new Usuario([
            'id' => 2,
            'empresa_id' => 1,
            'es_admin' => 0, // no es admin
        ]);

        $empresa = new \App\Domain\Models\Empresa(['id' => 1]);
        $usuario->setRelation('empresa', $empresa);

        $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);

        $useCase = new GetUsuarioUseCase($usuarioRepo);

        $useCase->executeAll($usuario);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}