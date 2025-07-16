<?php

namespace Tests\Unit\Domain\Services;

use Tests\TestCase;
use Mockery;
use App\Domain\Services\UsuarioEmailValidatorService;
use App\Domain\Repositories\UsuarioRepositoryInterface;

class UsuarioEmailValidatorServiceTest extends TestCase
{
    private $usuarioRepoMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usuarioRepoMock = Mockery::mock(UsuarioRepositoryInterface::class);
    }

    public function test_valida_email_unico_correctamente()
    {
        $this->usuarioRepoMock->shouldReceive('emailExists')
            ->with('nuevo@correo.com')
            ->andReturn(false);

        $service = new UsuarioEmailValidatorService($this->usuarioRepoMock);

        // No debe lanzar excepción
        $service->validarEmailUnico('nuevo@correo.com');

        $this->assertTrue(true); // Solo para afirmar que no hubo error
    }

    public function test_lanza_excepcion_si_email_ya_existe()
    {
        $this->usuarioRepoMock->shouldReceive('emailExists')
            ->with('existente@correo.com')
            ->andReturn(true);

        $service = new UsuarioEmailValidatorService($this->usuarioRepoMock);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('El email ya está registrado.');

        $service->validarEmailUnico('existente@correo.com');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}