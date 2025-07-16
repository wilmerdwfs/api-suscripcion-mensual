<?php

namespace App\Http\Controllers;

use App\Application\DTOs\Usuario\CreateUsuarioDTO;
use App\Application\DTOs\Usuario\UpdateUsuarioDTO;
use App\Application\UseCases\Usuario\CreateUsuarioUseCase;
use App\Application\UseCases\Usuario\DeleteUsuarioUseCase;
use App\Application\UseCases\Usuario\GetUsuarioUseCase;
use App\Application\UseCases\Usuario\UpdateUsuarioUseCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Usuario\FormCreateUsuarioRequest;

class UsuarioController extends Controller
{
    public function __construct(
        private CreateUsuarioUseCase $createUsuarioUseCase,
        private DeleteUsuarioUseCase $deleteUsuarioUseCase,
        private GetUsuarioUseCase $getUsuarioUseCase,
        private UpdateUsuarioUseCase $updateUsuarioUseCase,
    ) {}

    
    public function index()
    {
        $usuario = Auth()->user(); 

        return $this->getUsuarioUseCase->executeAll( $usuario);
    }

    public function show(int $id)
    {
        return $this->getUsuarioUseCase->execute($id);
    }

    public function store(FormCreateUsuarioRequest $request)
    {
        $usuario = Auth::user();

        $dto = new CreateUsuarioDTO(
            $request->nombre,
            $request->email,
            $request->password,
            $usuario->empresa_id,
        );

    try {
        $usuario = $this->createUsuarioUseCase->execute($dto, $usuario);

        $token = $usuario->createToken('api-token')->plainTextToken;

        return response()->json([
            'usuario' => $usuario,
            'access_token' => $token,
            'autorizacion' => 'Bearer ' . $token,
        ], 201);

    } catch (ValidationException $e) {
        return response()->json(['errors' => $e->errors()], 422);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    public function update(Request $request, int $id)
    {
        $dto = new  UpdateUsuarioDTO(
            $id,
            $request->nombre,
            $request->email
        );

        $usuario = $this->updateUsuarioUseCase->execute($dto);

        return response()->json($usuario);
    }

    public function destroy(int $id)
    {
        $this->deleteUsuarioUseCase->execute($id);

        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }
}