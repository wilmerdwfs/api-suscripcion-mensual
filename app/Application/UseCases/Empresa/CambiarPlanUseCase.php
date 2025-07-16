<?php

namespace App\Application\UseCases\Empresa;

use App\Domain\Repositories\SuscripcionRepositoryInterface;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Application\DTOs\Empresa\CambiarPlanDTO;
use App\Domain\Policies\EmpresaPolicy;

class CambiarPlanUseCase
{
    public function __construct(
        private EmpresaRepositoryInterface $empresaRepo,
        private SuscripcionRepositoryInterface $suscripcionRepo
    ) {}
    
    public function execute(CambiarPlanDTO $dto, $usuarioAutenticado): void
    {
        DB::transaction(function() use ($dto,$usuarioAutenticado) {
            $empresa = $this->empresaRepo->findById($dto->empresaId);
            
            $policy = new EmpresaPolicy();

            if (! $policy->manage($usuarioAutenticado, $empresa)) {
                throw new \Exception("No autorizado para gestionar esta empresa.");
            }

            if ($empresa->plan_id === $dto->planNuevoId) {
                throw new \Exception("Ya tienes este plan activo.");
            }

            // Registrar historial
            $this->suscripcionRepo->registrarHistorialCambio(
                $empresa->id,
                $empresa->plan_id, // plan anterior
                $dto->planNuevoId
            );

            // Actualizar empresa
            $empresa->plan_id = $dto->planNuevoId;
            $this->empresaRepo->save($empresa);
        });
    }
}