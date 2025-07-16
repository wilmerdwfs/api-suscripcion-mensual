<?php
namespace App\Application\UseCases\Plan;

use App\Application\DTOs\Plan\UpdatePlanDTO;
use App\Domain\Repositories\PlanRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdatePlanUseCase
{
    public function __construct(
        private PlanRepositoryInterface $planRepository
    ) {}

    public function execute(UpdatePlanDTO $dto)
    {
        try {
            $plan = $this->planRepository->findById($dto->id);
        } catch (ModelNotFoundException $e) {
            // Puedes lanzar una excepción personalizada o devolver un error
            throw new \Exception("Plan no encontrado", 404);
        }

        $plan->nombre = $dto->nombre;
        $plan->precio_mensual = $dto->precioMensual;
        $plan->limite_usuarios = $dto->limiteUsuarios;
        $plan->caracteristicas = $dto->caracteristicas;

        return $this->planRepository->save($plan);
    }
}