<?php

namespace App\Infrastructure\Eloquent;

use App\Domain\Models\Usuario;
use App\Domain\Repositories\UsuarioRepositoryInterface;

class EloquentUsuarioRepository implements UsuarioRepositoryInterface
{
    public function findById(int $id): Usuario
    {
        $empresaId = auth()->user()->empresa_id;

        return Usuario::where('id', $id)
                  ->where('empresa_id', $empresaId)
                  ->firstOrFail();
    }

    public function save(Usuario $usuario): Usuario
    {
        $usuario->save();
        return $usuario;
    }

    public function getAll(): array
    {
        $empresaId = auth()->user()->empresa_id;

        return Usuario::where('empresa_id', $empresaId)->get()->toArray();
    }

    public function delete(Usuario $usuario): void
    {

        $usuario->delete();
    }

    public function countByEmpresa(int $empresaId): int
    {
        return Usuario::where('empresa_id', $empresaId)->count();
    }
    
    public function emailExists(string $email): bool
    {
        return Usuario::where('email', $email)->exists();
    }
}