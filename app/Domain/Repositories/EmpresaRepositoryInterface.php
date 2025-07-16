<?php
namespace App\Domain\Repositories;

use App\Domain\Models\Empresa;

interface EmpresaRepositoryInterface
{
    public function findById(int $id): ?Empresa;
    public function save(Empresa $empresa): Empresa;
    public function getAll(): array;
    public function delete(Empresa $empresa): void;
} 