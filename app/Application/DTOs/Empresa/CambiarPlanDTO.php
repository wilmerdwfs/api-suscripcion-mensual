<?php

namespace App\Application\DTOs\Empresa;

class CambiarPlanDTO
{
    public function __construct(
        public readonly int $empresaId,
        public readonly int $planNuevoId
    ) {}
}