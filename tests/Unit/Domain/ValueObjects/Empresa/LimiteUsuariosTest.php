<?php

namespace Tests\Unit\Domain\ValueObjects\Empresa;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObjects\Empresa\LimiteUsuarios;

class LimiteUsuariosTest extends TestCase
{
    public function test_no_excede_el_limite()
    {
        $limite = new LimiteUsuarios(limite: 10, actual: 5);

        $this->assertFalse($limite->excedido());
        $this->assertEquals(5, $limite->disponibles());
    }

    public function test_excede_el_limite()
    {
        $limite = new LimiteUsuarios(limite: 10, actual: 10);

        $this->assertTrue($limite->excedido());
        $this->assertEquals(0, $limite->disponibles());
    }

    public function test_disponibles_nunca_menor_a_cero()
    {
        $limite = new LimiteUsuarios(limite: 5, actual: 8);

        $this->assertTrue($limite->excedido());
        $this->assertEquals(0, $limite->disponibles());
    }

    public function test_mensaje_error_es_correcto()
    {
        $limite = new LimiteUsuarios(1, 1);

        $this->assertEquals(
            'Se alcanzó el límite de usuarios según el plan actual.',
            $limite->mensajeError()
        );
    }
}