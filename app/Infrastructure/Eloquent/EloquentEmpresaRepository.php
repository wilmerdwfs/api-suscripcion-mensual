<?php
namespace App\Infrastructure\Eloquent;

use App\Domain\Models\Empresa;
use App\Domain\Repositories\EmpresaRepositoryInterface;

class EloquentEmpresaRepository implements EmpresaRepositoryInterface
{
    public function findById(int $id): Empresa
    {
        return Empresa::findOrFail($id);
    }

    public function save(Empresa $empresa): Empresa
    {
        $empresa->save();
        
        return $empresa;
    }

    public function getAll(): array
    {
        return Empresa::all()->toArray();
    }

    public function delete(Empresa $empresa): void
    {
        $empresa->delete();
    }
}