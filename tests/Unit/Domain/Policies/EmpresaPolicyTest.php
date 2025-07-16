<?php

namespace Tests\Unit\Domain\Policies;

use Tests\TestCase;
use App\Domain\Policies\EmpresaPolicy;
use App\Domain\Models\Usuario;
use App\Domain\Models\Empresa;

class EmpresaPolicyTest extends TestCase
{
    public function test_manage_permite_si_usuario_es_admin_y_empresa_coincide()
    {
        $usuario = new Usuario();
        $usuario->es_admin = 1;
        $usuario->empresa_id = 5;

        $empresa = new Empresa();
        $empresa->id = 5;

        $policy = new EmpresaPolicy();

        $this->assertTrue($policy->manage($usuario, $empresa));
    }

    public function test_manage_deniega_si_usuario_no_es_admin()
    {
        $usuario = new Usuario();
        $usuario->es_admin = 0;  // no admin
        $usuario->empresa_id = 5;

        $empresa = new Empresa();
        $empresa->id = 5;

        $policy = new EmpresaPolicy();

        $this->assertFalse($policy->manage($usuario, $empresa));
    }

    public function test_manage_deniega_si_empresa_no_coincide()
    {
        $usuario = new Usuario();
        $usuario->es_admin = 1;
        $usuario->empresa_id = 5;

        $empresa = new Empresa();
        $empresa->id = 10;  // distinta empresa

        $policy = new EmpresaPolicy();

        $this->assertFalse($policy->manage($usuario, $empresa));
    }
}