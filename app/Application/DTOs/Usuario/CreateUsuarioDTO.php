<?php
namespace App\Application\DTOs\Usuario;

class CreateUsuarioDTO
{
    public function __construct(
        public readonly string $nombre,
        public readonly string $email,
        public readonly string $password,
        public readonly int $empresaId
    ) {}
}