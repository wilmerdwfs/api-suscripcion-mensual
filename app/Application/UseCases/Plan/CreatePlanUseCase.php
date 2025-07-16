<?php
namespace App\Application\UseCases\Plan;

use App\Application\DTOs\Plan\CreatePlanDTO;
use App\Domain\Repositories\PlanRepositoryInterface;
use App\Domain\Models\Plan;

class CreatePlanUseCase
{
    public function __construct(
        private PlanRepositoryInterface $planRepository
    ) {}

    public function execute(CreatePlanDTO $dto)
    {
        $plan = new Plan([
            'nombre' => $dto->nombre,
            'precio_mensual' => $dto->precioMensual,
            'limite_usuarios' => $dto->limiteUsuarios, // corregido aquí
            'caracteristicas' => $dto->caracteristicas,
        ]);

        return $this->planRepository->save($plan);
    }
}