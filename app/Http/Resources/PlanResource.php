<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Domain\ValueObjects\Caracteristicas;

class PlanResource extends JsonResource
{
    public function toArray($request)
    {
        // Asumiendo que $this es un modelo Plan con campo 'caracteristicas' como int
        $caracts = Caracteristicas::fromInt($this->caracteristicas);

        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'precio_mensual' => $this->precio_mensual,
            'limite_usuarios' => $this->limite_usuarios,
            'caracteristicas' => [
                'dominio_personalizado' => $caracts->hasCustomDomain(),
                'acceso_api' => $caracts->hasApiAccess(),
                'panel_analiticas' => $caracts->hasAnalyticsDashboard(),
            ],
        ];
    }
}