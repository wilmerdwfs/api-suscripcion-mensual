<?php
namespace App\Application\DTOs\Plan;

class CreatePlanDTO
{
    public function __construct(
        public readonly string $nombre,
        public readonly int $precioMensual,
        public readonly int $limiteUsuarios,
        public readonly int $caracteristicas
    ) {}
}