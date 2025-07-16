<?php

namespace Tests\Unit\Domain\ValueObjects\Usuario;

use Tests\TestCase;
use Mockery;
use App\Domain\ValueObjects\Usuario\EmailUsuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use InvalidArgumentException;

class EmailUsuarioTest extends TestCase
{
    private $usuarioRepoMock;

    protected function setUp(): void
    {
        parent::setUp();
        $this->usuarioRepoMock = Mockery::mock(UsuarioRepositoryInterface::class);
    }

    public function test_crea_email_valido_correctamente()
    {
        $this->usuarioRepoMock->shouldReceive('existsEmail')
            ->with('valido@correo.com')
            ->andReturn(false);

        $email = new EmailUsuario('valido@correo.com', $this->usuarioRepoMock);

        $this->assertEquals('valido@correo.com', $email->value());
    }

    public function test_lanza_excepcion_si_email_no_es_valido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('El formato del correo electrónico no es válido.');

        new EmailUsuario('email_invalido', $this->usuarioRepoMock);
    }

    public function test_lanza_excepcion_si_email_ya_existe()
    {
        $this->usuarioRepoMock->shouldReceive('existsEmail')
            ->with('existe@correo.com')
            ->andReturn(true);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Este correo electrónico ya está registrado.');

        new EmailUsuario('existe@correo.com', $this->usuarioRepoMock);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}