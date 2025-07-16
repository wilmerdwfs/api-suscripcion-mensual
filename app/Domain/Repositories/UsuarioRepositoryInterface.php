<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Usuario;

interface UsuarioRepositoryInterface
{
    public function save(Usuario $usuario): Usuario;
    public function findById(int $id): ?Usuario;
    public function getAll(): array;
    public function delete(Usuario $usuario): void;
    public function countByEmpresa(int $empresaId): int;
    public function emailExists(string $email): bool;
}