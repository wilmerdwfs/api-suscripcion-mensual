<?php

namespace App\Domain\Services;

use App\Domain\Repositories\UsuarioRepositoryInterface;

class UsuarioEmailValidatorService 
{
    public function __construct(private UsuarioRepositoryInterface $usuarioRepo) {}

    public function validarEmailUnico(string $email): void
    {
        if ($this->usuarioRepo->emailExists($email)) {
            throw new \Exception("El email ya está registrado.");
        }
    }
}