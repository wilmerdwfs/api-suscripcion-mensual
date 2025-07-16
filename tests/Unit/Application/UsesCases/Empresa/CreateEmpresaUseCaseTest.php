<?php

namespace Tests\Unit\Application\UseCases\Empresa;

use Tests\TestCase;
use Mockery;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Application\UseCases\Empresa\CreateEmpresaUseCase;
use App\Application\DTOs\Empresa\CreateEmpresaDTO;
use App\Domain\Models\Empresa;
use App\Domain\Models\Usuario;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Repositories\SuscripcionRepositoryInterface;

class CreateEmpresaUseCaseTest extends TestCase
{
    public function test_crea_empresa_y_usuario_correctamente()
    {
        // Arrange
        $dto = new CreateEmpresaDTO(
            nombreEmpresa: 'Mi Empresa Nueva',
            nombreUsuario: 'Admin User',
            emailUsuario: 'admin@nueva.com',
            passwordUsuario: 'secret123',
            planId: 2
        );

        $empresa = new Empresa([
            'id' => 1,
            'nombre' => 'Mi Empresa Nueva',
            'plan_id' => 2,
        ]);

        $usuario = Mockery::mock(Usuario::class)->makePartial();
        $usuario->id = 10;
        $usuario->nombre = 'Admin User';
        $usuario->email = 'admin@nueva.com';
        $usuario->empresa_id = 1;
        $usuario->es_admin = 1;

        $usuario->shouldReceive('createToken')
            ->once()
            ->with('api-token')
            ->andReturn((object)['plainTextToken' => 'fake-token']);

        // Mocks
        $empresaRepo = Mockery::mock(EmpresaRepositoryInterface::class);
        $empresaRepo->shouldReceive('save')
            ->once()
            ->with(Mockery::on(fn($e) => $e->nombre === $dto->nombreEmpresa))
            ->andReturnUsing(function ($e) use ($empresa) {
                $e->id = $empresa->id;
                return $e;
            });

        $usuarioRepo = Mockery::mock(UsuarioRepositoryInterface::class);
        $usuarioRepo->shouldReceive('save')
            ->once()
            ->with(Mockery::on(fn($u) => $u->email === $dto->emailUsuario))
            ->andReturn($usuario);

        $suscripcionRepo = Mockery::mock(SuscripcionRepositoryInterface::class);
        $suscripcionRepo->shouldReceive('registrarHistorialCambio')
            ->once()
            ->with($empresa->id, $dto->planId, $dto->planId);

        // Ejecutar caso de uso
        $useCase = new CreateEmpresaUseCase($empresaRepo, $usuarioRepo, $suscripcionRepo);

        DB::shouldReceive('transaction')
            ->once()
            ->andReturnUsing(fn($closure) => $closure());

        // Act
        $response = $useCase->execute($dto);

        // Assert
        $this->assertInstanceOf(JsonResponse::class, $response);
        $data = $response->getData(true);

        $this->assertEquals('Admin User', $data['usuario']['nombre']);
        $this->assertEquals('admin@nueva.com', $data['usuario']['email']);
        $this->assertEquals('Bearer', $data['token_type']);
        $this->assertEquals('Bearer fake-token', $data['autorizacion']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}