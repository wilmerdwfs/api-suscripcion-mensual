<?php
namespace App\Http\Controllers;

use App\Application\UseCases\Plan\CreatePlanUseCase;
use App\Application\UseCases\Plan\GetPlanUseCase;
use App\Application\UseCases\Plan\UpdatePlanUseCase;
use App\Application\UseCases\Plan\DeletePlanUseCase;
// ... otros use cases
use App\Application\DTOs\Plan\CreatePlanDTO;
use App\Application\DTOs\Plan\UpdatePlanDTO;
// ... otros DTOs
use Illuminate\Http\Request;
use App\Http\Requests\Plan\StorePlanRequest;
use App\Http\Requests\Plan\UpdatePlanRequest;

class PlanController extends Controller
{
     public function __construct(
        private CreatePlanUseCase $createPlanUseCase,
        private GetPlanUseCase $getPlanUseCase,
        private UpdatePlanUseCase $updatePlanUseCase,
        private DeletePlanUseCase $deletePlanUseCase
    ) {}

    public function index()
    {
        return $this->getPlanUseCase->executeAll();
    }

    public function show(int $id)
    {
        return $this->getPlanUseCase->execute($id);
    }

    public function store(StorePlanRequest $request)
    {  
        $dto = new CreatePlanDTO(
            $request->nombre,
            $request->precioMensual,
            $request->limiteUsuarios,
            $request->caracteristicas
        );

        $plan = $this->createPlanUseCase->execute($dto);
        
        return response()->json([
            'mensaje' => 'Plan creado correctamente',
            'plan' => $plan, 
        ], 201);
    }

    public function update(UpdatePlanRequest $request, int $id)
    {
        $dto = new UpdatePlanDTO(
            $id,
            $request->nombre,
            $request->precioMensual,
            $request->limiteUsuarios,
            $request->caracteristicas
        );

        $plan = $this->updatePlanUseCase->execute($dto);

        return response()->json([
            'mensaje' => 'Plan actualizado correctamente',
            'plan' => $plan,
        ]);
    }

    public function destroy(int $id)
    {
        $this->deletePlanUseCase->execute($id);

        return response()->json(['message' => 'Plan eliminado correctamente']);
    }
    
    // ... otros métodos
}