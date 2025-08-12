<?php
namespace App\Http\Controllers;

use App\Repositories\Interfaces\ClienteRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;

class ClienteController extends Controller
{
    private ClienteRepositoryInterface $clienteRepository;

    public function __construct(ClienteRepositoryInterface $clienteRepository)
    {
        $this->clienteRepository = $clienteRepository;
    }

    public function index()
    {
        $clientes = $this->clienteRepository->all();
        return response()->json($clientes);
    }

    public function show(int $id)
    {
        $cliente = $this->repository->findById($id);
        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
        return response()->json($cliente);
    }

    public function store(ClienteRequest $request)
    {
        $data = $request->all();
        $cliente = $this->clienteRepository->create($data);
        return response()->json($cliente, 201);
    }

    public function update(int $id, Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'sometimes|required|string',
            'documento' => 'sometimes|required|string',
            'email' => 'sometimes|required|email',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
        ]);

        try {
            $cliente = $useCase->execute($id, $validated);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        return response()->json($cliente);
    }

    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response()->json(null, 204);
    }
}