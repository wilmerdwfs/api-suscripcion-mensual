<?php
namespace App\Application\DTOs\Empresa;

class CreateEmpresaDTO
{
    public function __construct(
        public readonly string $nombreEmpresa,
        public readonly int $planId,
        public readonly string $nombreUsuario,
        public readonly string $emailUsuario,
        public readonly string $passwordUsuario
    ) {}
}