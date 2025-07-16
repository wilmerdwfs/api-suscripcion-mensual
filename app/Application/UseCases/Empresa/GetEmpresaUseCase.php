<?php

namespace App\Application\UseCases\Empresa;

use App\Domain\Repositories\EmpresaRepositoryInterface;

class GetEmpresaUseCase
{
    public function __construct(
        private EmpresaRepositoryInterface $empresaRepository
    ) {}

    public function execute(int $id)
    {
        return $this->empresaRepository->findById($id);
    }

    public function executeAll()
    {
        return $this->empresaRepository->getAll();
    }
}