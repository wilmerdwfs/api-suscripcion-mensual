<?php
namespace App\Application\UseCases\Usuario;

use App\Domain\Repositories\UsuarioRepositoryInterface;

class DeleteUsuarioUseCase
{
    public function __construct(
        private UsuarioRepositoryInterface $usuarioRepository
    ) {}

    public function execute(int $id)
    {
        $usuario = $this->usuarioRepository->findById($id);
        $this->usuarioRepository->delete($usuario);
    }
}