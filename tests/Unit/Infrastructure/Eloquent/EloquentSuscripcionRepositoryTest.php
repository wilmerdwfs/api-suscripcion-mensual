<?php

namespace Tests\Integration\Infrastructure\Eloquent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Domain\Models\Empresa;
use App\Domain\Models\Plan;
use App\Domain\Models\PlanesSuscripcion;
use App\Infrastructure\Eloquent\EloquentSuscripcionRepository;

class EloquentSuscripcionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected EloquentSuscripcionRepository $repositorio;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositorio = new EloquentSuscripcionRepository();
    }

    public function test_registra_y_actualiza_historial_de_suscripcion()
    {
        // Crear empresa y planes
        $empresa = Empresa::factory()->create();
        $planAnterior = Plan::factory()->create();
        $planNuevo = Plan::factory()->create();

        // Crear suscripción activa previa
        PlanesSuscripcion::create([
            'empresa_id' => $empresa->id,
            'plan_anterior_id' => $planAnterior->id,
            'plan_nuevo_id' => $planAnterior->id,
            'estado' => 1,
            'fecha' => now()->toDateString(),
        ]);

        // Registrar nuevo cambio de plan (desactiva anterior y crea uno nuevo activo)
        $this->repositorio->registrarHistorialCambio($empresa->id, $planAnterior->id, $planNuevo->id);

        // Verificar que el nuevo registro se creó con estado activo
        $this->assertDatabaseHas('planes_suscripciones', [
            'empresa_id' => $empresa->id,
            'plan_anterior_id' => $planAnterior->id,
            'plan_nuevo_id' => $planNuevo->id,
            'estado' => 1,
        ]);

        // Verificar que hay dos registros para la empresa
        $this->assertEquals(2, PlanesSuscripcion::where('empresa_id', $empresa->id)->count());

        // Verificar que solo uno está activo
        $this->assertEquals(1, PlanesSuscripcion::where('empresa_id', $empresa->id)->where('estado', 1)->count());
    }

    public function test_obtener_suscripciones_por_empresa()
    {
        $empresa = Empresa::factory()->create();
        $plan = Plan::factory()->create();

        // Crear 2 registros de suscripción para la empresa
        PlanesSuscripcion::factory()->count(2)->create([
            'empresa_id' => $empresa->id,
            'plan_anterior_id' => $plan->id,
            'plan_nuevo_id' => $plan->id,
            'estado' => 0,
        ]);

        // Obtener las suscripciones con el repositorio
        $resultados = $this->repositorio->findByEmpresaId($empresa->id);

        $this->assertIsArray($resultados);
        $this->assertCount(2, $resultados);
        $this->assertEquals($empresa->id, $resultados[0]['empresa_id']);
    }
}