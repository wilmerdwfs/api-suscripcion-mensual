<?php

namespace Tests\Unit\Application\UseCases\Usuario;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Usuario\UpdateUsuarioUseCase;
use App\Application\DTOs\Usuario\UpdateUsuarioDTO;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Models\Usuario;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateUsuarioUseCaseTest extends TestCase
{
    public function test_actualiza_usuario_correctamente()
    {
        // Arrange
        $usuario = new Usuario([
            'id' => 1,
            'nombre' => 'Antiguo Nombre',
            'email' => 'test@empresa.com',
        ]);

        $dto = new UpdateUsuarioDTO(
            id: 1,
            nombre: 'Nuevo Nombre',
            email: 'nuevo@fake.com',
        );

        $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);
        $usuarioRepo->shouldReceive('findById')
            ->with(1)
            ->once()
            ->andReturn($usuario);

        $usuarioRepo->shouldReceive('save')
            ->with(Mockery::on(function ($u) {
                return $u->nombre === 'Nuevo Nombre';
            }))
            ->once()
            ->andReturnUsing(function ($u) {
                return $u;
            });

        $useCase = new UpdateUsuarioUseCase($usuarioRepo);

        // Act
        $resultado = $useCase->execute($dto);

        // Assert
        $this->assertInstanceOf(Usuario::class, $resultado);
        $this->assertEquals('Nuevo Nombre', $resultado->nombre);
    }

    public function test_lanza_excepcion_si_usuario_no_existe()
    {
      
        $dto = new UpdateUsuarioDTO(
            id: 999,
            nombre: 'Nuevo',
            email: 'dummy@fail.com'
        );

        $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);
        $usuarioRepo->shouldReceive('findById')
            ->with(999)
            ->once()
            ->andThrow(ModelNotFoundException::class);

        $useCase = new UpdateUsuarioUseCase($usuarioRepo);

        // Assert + Act
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Registro no encontrado');
        $this->expectExceptionCode(404);

        $useCase->execute($dto);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}