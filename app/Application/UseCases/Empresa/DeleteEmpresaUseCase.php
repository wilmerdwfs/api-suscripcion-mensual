<?php
namespace App\Application\UseCases\Empresa;

use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class DeleteEmpresaUseCase
{
    public function __construct(
        private EmpresaRepositoryInterface $empresaRepo,
        private UsuarioRepositoryInterface $usuarioRepo
    ) {}

    public function execute(int $id): void
    {
        DB::transaction(function () use ($id) {
            $empresa = $this->empresaRepo->findById($id);

            if (!$empresa) {
                throw new ModelNotFoundException("Empresa no encontrada");
            }

            foreach ($empresa->usuarios as $usuario) {
                $this->usuarioRepo->delete($usuario);
            }

            $this->empresaRepo->delete($empresa);
        });
    }   
}