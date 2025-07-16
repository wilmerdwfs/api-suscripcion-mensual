<?php
namespace App\Application\DTOs\Usuario;

class UpdateUsuarioDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $nombre,
        public readonly string $email
    ) {}
}