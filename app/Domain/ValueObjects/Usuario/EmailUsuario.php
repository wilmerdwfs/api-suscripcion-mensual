<?php

namespace App\Domain\ValueObjects\Usuario;

use App\Domain\Repositories\UsuarioRepositoryInterface;
use Illuminate\Validation\ValidationException;

class EmailUsuario
{
    private string $email;

    public function __construct(string $email, UsuarioRepositoryInterface $usuarioRepo)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('El formato del correo electrónico no es válido.');
        }

        if ($usuarioRepo->existsEmail($email)) {
            throw new \InvalidArgumentException('Este correo electrónico ya está registrado.');
        }

        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}