<?php

namespace Tests\Unit\Application\UseCases\Usuario;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Usuario\DeleteUsuarioUseCase;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Models\Usuario;

class DeleteUsuarioUseCaseTest extends TestCase
{
    public function test_elimina_usuario_correctamente()
    {
        $usuarioId = 123;

        // Crear mock de usuario (puede ser un simple objeto o instancia real)
        $usuario = new Usuario(['id' => $usuarioId]);

        // Mock del repositorio
        $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);

        // Definir expectativas:
        // findById debe recibir el id y devolver el usuario
        $usuarioRepo->shouldReceive('findById')
            ->with($usuarioId)
            ->once()
            ->andReturn($usuario);

        // delete debe recibir el usuario
        $usuarioRepo->shouldReceive('delete')
            ->with($usuario)
            ->once();

        // Instanciar el caso de uso con el mock
        $useCase = new DeleteUsuarioUseCase($usuarioRepo);

        // Ejecutar el método
        $useCase->execute($usuarioId);

        // No assert explícito porque Mockery verifica las expectativas
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}