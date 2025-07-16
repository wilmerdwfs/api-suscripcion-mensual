<?php

namespace App\Domain\Repositories;

interface SuscripcionRepositoryInterface
{
    /**
     * Registrar un cambio de plan en el historial.
     */
    public function registrarHistorialCambio(int $empresaId, int $planAnteriorId, int $planNuevoId): void;

    public function findByEmpresaId(int $empresaId): array;
}