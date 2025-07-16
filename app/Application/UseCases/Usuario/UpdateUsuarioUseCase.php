<?php
namespace App\Application\UseCases\Usuario;

use App\Application\DTOs\Usuario\UpdateUsuarioDTO;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateUsuarioUseCase
{
    public function __construct(
        private UsuarioRepositoryInterface $usuarioRepository
    ) {}

    public function execute(UpdateUsuarioDTO $dto)
    {
        try {
            $empresa = $this->usuarioRepository->findById($dto->id);
        } catch (ModelNotFoundException $e) {
            // Puedes lanzar una excepción personalizada o devolver un error
            throw new \Exception("Registro no encontrado", 404);
        }

        $empresa->nombre = $dto->nombre;

        return $this->usuarioRepository->save($empresa);
    }
}