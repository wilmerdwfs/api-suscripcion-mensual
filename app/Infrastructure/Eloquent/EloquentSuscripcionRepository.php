<?php

namespace App\Infrastructure\Eloquent;

use App\Domain\Models\PlanesSuscripcion;
use App\Domain\Repositories\SuscripcionRepositoryInterface;
use Carbon\Carbon;

class EloquentSuscripcionRepository implements SuscripcionRepositoryInterface
{
   public function registrarHistorialCambio(int $empresaId, int $planAnteriorId, int $planNuevoId): void
   {
        // Desactivar la suscripción activa anterior
        PlanesSuscripcion::where('empresa_id', $empresaId)
        ->where('estado', 1)
        ->update(['estado' => 0]);

        // Registrar nuevo plan como activo
        PlanesSuscripcion::create([
            'empresa_id' => $empresaId,
            'plan_anterior_id' => $planAnteriorId,
            'plan_nuevo_id' => $planNuevoId,
            'estado' => 1,
            'fecha' => now()->toDateString(),
        ]);
    }

    public function findByEmpresaId(int $empresaId): array
    {
        return PlanesSuscripcion::where('empresa_id', $empresaId)->get()->toArray();
    }
}