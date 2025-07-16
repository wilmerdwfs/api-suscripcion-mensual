<?php

namespace Tests\Integration\Infrastructure\Eloquent;

use Tests\TestCase;
use App\Domain\Models\Plan;
use App\Infrastructure\Eloquent\EloquentPlanRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentPlanRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected EloquentPlanRepository $repositorio;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositorio = new EloquentPlanRepository();
    }

    public function test_guardar_y_buscar_por_id()
    {
        $plan = Plan::factory()->create([
            'nombre' => 'Plan Básico',
            'precio_mensual' => 1000,
            'limite_usuarios' => 10,
            'caracteristicas' => 1
        ]);

        $encontrado = $this->repositorio->findById($plan->id);

        $this->assertEquals($plan->id, $encontrado->id);
        $this->assertEquals('Plan Básico', $encontrado->nombre);
    }

    public function test_obtener_todos_devuelve_array()
    {
        Plan::factory()->count(3)->create();

        $todos = $this->repositorio->getAll();

        $this->assertIsArray($todos);
        $this->assertCount(3, $todos);
    }

    public function test_eliminar_quita_el_plan()
    {
        $plan = Plan::factory()->create();

        $this->repositorio->delete($plan);

        $this->assertDatabaseMissing('planes', ['id' => $plan->id]);
    }
}