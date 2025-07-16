<?php
namespace App\Application\UseCases\Empresa;

use App\Application\DTOs\Empresa\UpdateEmpresaDTO;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateEmpresaUseCase
{
    public function __construct(
        private EmpresaRepositoryInterface $empresaRepository
    ) {}

    public function execute(UpdateEmpresaDTO $dto)
    {
        try {
            $empresa = $this->empresaRepository->findById($dto->id);
        } catch (ModelNotFoundException $e) {
            // Puedes lanzar una excepción personalizada o devolver un error
            throw new \Exception("Empresa no encontrada", 404);
        }

        $empresa->nombre = $dto->nombre;

        return $this->empresaRepository->save($empresa);
    }
}