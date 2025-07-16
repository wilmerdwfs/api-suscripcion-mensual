<?php

namespace App\Application\UseCases\Plan;

use App\Domain\Repositories\PlanRepositoryInterface;
use App\Domain\ValueObjects\Plan\Caracteristicas;

class GetPlanUseCase
{
    public function __construct(
        private PlanRepositoryInterface $planRepository
    ) {}

    public function execute(int $id): array
    {
        $plan = $this->planRepository->findById($id);

        if (!$plan) {
            throw new \Exception("Plan no encontrado");
        }

        $caracteristicas = Caracteristicas::fromInt($plan->caracteristicas);

        return [
            'id' => $plan->id,
            'nombre' => $plan->nombre,
            'precio_mensual' => $plan->precio_mensual,
            'limite_usuarios' => $plan->limite_usuarios,
            'caracteristicas' => [
                'DOMINIO_PERSONALIZADO' => $caracteristicas->tieneDominioPersonalizado(),
                'ACCESO_API' => $caracteristicas->tieneAccesoApi(),
                'PANEL_ANALITICAS' => $caracteristicas->tienePanelAnaliticas(),
            ]
        ];
    }

  public function executeAll(): array
{
    $planes = $this->planRepository->getAll(); // Devuelve array

    return array_map(function ($plan) {
        $caracteristicas = Caracteristicas::fromInt($plan['caracteristicas']);

        return [
            'id' => $plan['id'],
            'nombre' => $plan['nombre'],
            'precio_mensual' => $plan['precio_mensual'],
            'limite_usuarios' => $plan['limite_usuarios'],
            'caracteristicas' => [
                'DOMINIO_PERSONALIZADO' => $caracteristicas->tieneDominioPersonalizado(),
                    'ACCESO_API' => $caracteristicas->tieneAccesoApi(),
                    'PANEL_ANALITICAS' => $caracteristicas->tienePanelAnaliticas(),
            ]
        ];
    }, $planes);
}
}
