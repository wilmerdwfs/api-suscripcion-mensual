<?php

namespace Tests\Unit\Domain\ValueObjects\Plan;

use PHPUnit\Framework\TestCase;
use App\Domain\ValueObjects\Plan\Caracteristicas;

class CaracteristicasTest extends TestCase
{
    public function test_from_int_interpreta_correctamente_los_flags()
    {
        $caracteristicas = Caracteristicas::fromInt(3); // 1 (DOMINIO) + 2 (API)

        $this->assertTrue($caracteristicas->tieneDominioPersonalizado());
        $this->assertTrue($caracteristicas->tieneAccesoApi());
        $this->assertFalse($caracteristicas->tienePanelAnaliticas());
    }

    public function test_activar_y_desactivar_dominio_personalizado()
    {
        $c = new Caracteristicas();
        $this->assertFalse($c->tieneDominioPersonalizado());

        $c->activarDominioPersonalizado();
        $this->assertTrue($c->tieneDominioPersonalizado());

        $c->desactivarDominioPersonalizado();
        $this->assertFalse($c->tieneDominioPersonalizado());
    }

    public function test_activar_y_desactivar_acceso_api()
    {
        $c = new Caracteristicas();
        $this->assertFalse($c->tieneAccesoApi());

        $c->activarAccesoApi();
        $this->assertTrue($c->tieneAccesoApi());

        $c->desactivarAccesoApi();
        $this->assertFalse($c->tieneAccesoApi());
    }

    public function test_activar_y_desactivar_panel_analiticas()
    {
        $c = new Caracteristicas();
        $this->assertFalse($c->tienePanelAnaliticas());

        $c->activarPanelAnaliticas();
        $this->assertTrue($c->tienePanelAnaliticas());

        $c->desactivarPanelAnaliticas();
        $this->assertFalse($c->tienePanelAnaliticas());
    }
}