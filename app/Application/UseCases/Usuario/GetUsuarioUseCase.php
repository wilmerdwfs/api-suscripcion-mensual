<?php

namespace App\Application\UseCases\Usuario;

use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Policies\EmpresaPolicy;

class GetUsuarioUseCase
{
    public function __construct(
        private UsuarioRepositoryInterface $usuarioRepository
    ) {}

    public function execute(int $id)
    {
        return $this->usuarioRepository->findById($id);
    }

    public function executeAll($usuario): array
    {
        $empresa = $usuario->empresa;

        $policy = new EmpresaPolicy();

        if (! $policy->manage($usuario, $empresa)) {
            throw new \Exception("No autorizado para gestionar esta empresa.");
        }

        return $this->usuarioRepository->getAll();
    }
}