<?php
namespace Tests\Integration\Infrastructure\Eloquent;

use Tests\TestCase;
use App\Infrastructure\Eloquent\EloquentEmpresaRepository;
use App\Domain\Models\Empresa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EloquentEmpresaRepositoryTest extends TestCase
{
    use RefreshDatabase; // Limpia la BD entre tests

    protected EloquentEmpresaRepository $repositorio;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repositorio = new EloquentEmpresaRepository();
    }

    public function test_guardar_y_buscar_por_id()
    {
        $empresa = Empresa::factory()->create(['nombre' => 'Empresa Test']);

        $encontrada = $this->repositorio->findById($empresa->id);

        $this->assertEquals($empresa->id, $encontrada->id);
        $this->assertEquals('Empresa Test', $encontrada->nombre);
    }

    public function test_obtener_todas_devuelve_array()
    {
        Empresa::factory()->count(3)->create();

        $todas = $this->repositorio->getAll();

        $this->assertIsArray($todas);
        $this->assertCount(3, $todas);
    }

    public function test_eliminar_quita_empresa()
    {
        $empresa = Empresa::factory()->create();

        $this->repositorio->delete($empresa);

        $this->assertDatabaseMissing('empresas', ['id' => $empresa->id]);
    }
}