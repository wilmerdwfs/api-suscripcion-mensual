<?php
namespace App\Application\DTOs\Plan;

class UpdatePlanDTO
{
    public function __construct(
        public int $id,
        public string $nombre,
        public int $precioMensual,
        public int $limiteUsuarios,
        public string $caracteristicas
    ) {}
}