<?php
namespace App\Application\DTOs\Empresa;

class UpdateEmpresaDTO
{
    public function __construct(
        public int $id,
        public string $nombre
    ) {}
}