<?php

namespace Tests\Unit\Application\UseCases\Usuario;

use Tests\TestCase;
use Mockery;
use App\Application\UseCases\Usuario\CreateUsuarioUseCase;
use App\Application\DTOs\Usuario\CreateUsuarioDTO;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Services\UsuarioEmailValidatorService;
use App\Domain\Models\Usuario;
use App\Domain\Models\Empresa;
use App\Domain\Models\Plan;

class CreateUsuarioUseCaseTest extends TestCase
{
    public function test_crea_usuario_correctamente()
    {
        // Arrange: Crear el Plan correctamente con forceFill para evitar problemas con fillable
        $plan = new Plan();
        $plan->forceFill([
            'id' => 1,
            'limite_usuarios' => 10,
        ]);

        // Crear la Empresa y asociar el Plan con setRelation
        $empresa = new Empresa();
        $empresa->forceFill([
            'id' => 1,
            'nombre' => 'Mi Empresa',
            'plan_id' => 1,
        ]);
        $empresa->setRelation('plan', $plan);

        // Usuario autenticado (admin)
        $usuarioAutenticado = new Usuario([
            'id' => 99,
            'empresa_id' => 1,
            'email' => 'admin@empresa.com',
            'es_admin' => 1,
        ]);

        // DTO para crear usuario
        $dto = new CreateUsuarioDTO(
            nombre: 'Nuevo Usuario',
            email: 'nuevo@empresa.com',
            password: 'secret',
            empresaId: 1
        );

        // Validar que el plan está bien seteado
        $this->assertNotNull($empresa->plan);
        $this->assertIsInt($empresa->plan->limite_usuarios);
        $this->assertEquals(10, $empresa->plan->limite_usuarios);

        // Mocks de dependencias
        $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);
        $empresaRepo = Mockery::mock(EmpresaRepositoryInterface::class);
        $emailValidator = Mockery::mock(UsuarioEmailValidatorService::class);

        // Expectativas de mocks
        $emailValidator->shouldReceive('validarEmailUnico')
            ->with('nuevo@empresa.com')
            ->once();

        $empresaRepo->shouldReceive('findById')
            ->with(1)
            ->andReturn($empresa);

        $usuarioRepo->shouldReceive('countByEmpresa')
            ->with(1)
            ->andReturn(3);

        $usuarioRepo->shouldReceive('save')
            ->andReturnUsing(function ($usuario) {
                $usuario->id = 101;
                return $usuario;
            });

        // Instanciar el caso de uso
        $useCase = new CreateUsuarioUseCase($usuarioRepo, $empresaRepo, $emailValidator);

        // Act: Ejecutar el caso de uso
        $usuarioCreado = $useCase->execute($dto, $usuarioAutenticado);

        // Assert: Verificar los resultados
        $this->assertInstanceOf(Usuario::class, $usuarioCreado);
        $this->assertEquals('Nuevo Usuario', $usuarioCreado->nombre);
        $this->assertEquals('nuevo@empresa.com', $usuarioCreado->email);
        $this->assertEquals(1, $usuarioCreado->empresa_id);
        $this->assertEquals(101, $usuarioCreado->id);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }
}