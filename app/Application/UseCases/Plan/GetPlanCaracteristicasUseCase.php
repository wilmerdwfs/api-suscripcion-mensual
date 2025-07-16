<?php
namespace App\Application\UseCases\Plan;

use App\Domain\Repositories\PlanRepositoryInterface;
use App\Domain\ValueObjects\Plan\Caracteristicas;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GetPlanCaracteristicasUseCase
{
    public function __construct(
        private PlanRepositoryInterface $planRepository
    ) {}

    public function execute(int $planId): array
    {
        $plan = $this->planRepository->findById($planId);

        if (!$plan) {
            throw new ModelNotFoundException("Plan no encontrado");
        }

        $caracteristicas = Caracteristicas::fromInt($plan->caracteristicas);

        return [
            'DOMINIO_PERSONALIZADO' => $caracteristicas->tieneDominioPersonalizado(),
            'ACCESO_API' => $caracteristicas->tieneAccesoApi(),
            'PANEL_ANALITICAS' => $caracteristicas->tienePanelAnaliticas(),
        ];
    }
}