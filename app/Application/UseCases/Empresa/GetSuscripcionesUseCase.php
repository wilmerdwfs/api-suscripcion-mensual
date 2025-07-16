<?php

namespace App\Application\UseCases\Empresa;
use App\Domain\Policies\EmpresaPolicy;
use App\Domain\Models\Usuario;
use App\Domain\Repositories\SuscripcionRepositoryInterface;

class GetSuscripcionesUseCase
{
    public function __construct(
        private SuscripcionRepositoryInterface $suscripcionRepo
    ) {}

    public function execute(int $empresaId, Usuario $usuarioAutenticado): array
    {
        $empresa = $usuarioAutenticado->empresa;
        $policy = new EmpresaPolicy();

        if (! $policy->manage($usuarioAutenticado, $empresa)) {
            throw new \Exception("No autorizado para gestionar esta empresa.");
        }

        return $this->suscripcionRepo->findByEmpresaId($empresaId);
    }
}