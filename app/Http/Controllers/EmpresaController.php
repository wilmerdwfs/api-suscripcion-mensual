<?php
namespace App\Http\Controllers;

use App\Application\UseCases\Empresa\CreateEmpresaUseCase;
use App\Application\UseCases\Empresa\GetEmpresaUseCase;
use App\Application\UseCases\Empresa\UpdateEmpresaUseCase;
use App\Application\UseCases\Empresa\DeleteEmpresaUseCase;
use App\Application\UseCases\Empresa\CambiarPlanUseCase;
use App\Application\UseCases\Empresa\GetSuscripcionesUseCase;

use App\Application\DTOs\Empresa\CreateEmpresaDTO;
use App\Application\DTOs\Empresa\UpdateEmpresaDTO;
use App\Application\DTOs\Empresa\CambiarPlanDTO;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\Empresa\UpdateEmpresaRequest;
use App\Http\Requests\Empresa\StoreEmpresaRequest;
use App\Http\Requests\Empresa\FormCambiarPlanRequest;

class EmpresaController extends Controller
{
     public function __construct(
        private CreateEmpresaUseCase $createEmpresaUseCase,
        private GetEmpresaUseCase $getEmpresaUseCase,
        private UpdateEmpresaUseCase $updateEmpresaUseCase,
        private DeleteEmpresaUseCase $deleteEmpresaUseCase,
        private CambiarPlanUseCase $cambiarPlanUseCase,
        private GetSuscripcionesUseCase $getSuscripcionesUseCase,
    ) {}

    public function index()
    {
        return $this->getEmpresaUseCase->executeAll();
    }

    public function show(int $id)
    {
        return $this->getEmpresaUseCase->execute($id);
    }

    public function store(StoreEmpresaRequest $request)
    {  
        $dto = new CreateEmpresaDTO(
            $request->nombreEmpresa,
            $request->planId,
            $request->nombreUsuario,
            $request->emailUsuario,
            $request->passwordUsuario
        );

        $usuario = $this->createEmpresaUseCase->execute($dto);

        return  $usuario;
    }

    public function update(UpdateEmpresaRequest $request, int $id)
    {
        $dto = new UpdateEmpresaDTO(
            $id,
            $request->nombre
        );

        $plan = $this->updateEmpresaUseCase->execute($dto);

        return response()->json($plan);
    }

    public function destroy(int $id)
    {
        $this->deleteEmpresaUseCase->execute($id);

        return response()->json(['message' => 'Plan eliminado correctamente']);
    }

    public function cambiarPlan(FormCambiarPlanRequest $request)
    {
        $usuario = Auth::user();
        
        $dto = new CambiarPlanDTO(
            empresaId:  Auth()->user()->empresa_id,
            planNuevoId: $request->planId
        );

        try {
            $this->cambiarPlanUseCase->execute($dto, $usuario);

            return response()->json(['mensaje' => 'Plan cambiado correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function suscripciones()
    {
        $usuario = Auth::user();

        $empresaId = $usuario->empresa_id;

        $suscripciones = $this->getSuscripcionesUseCase->execute($empresaId, $usuario);

        return response()->json($suscripciones);
    }
}