<?php

namespace App\Domain\ValueObjects\Empresa;

class LimiteUsuarios
{
    public function __construct(
        private int $limite,
        private int $actual
    ) {}

    public function excedido(): bool
    {
        return $this->actual >= $this->limite;
    }

    public function disponibles(): int
    {
        return max(0, $this->limite - $this->actual);
    }

    public function mensajeError(): string
    {
        return 'Se alcanzó el límite de usuarios según el plan actual.';
    }
}