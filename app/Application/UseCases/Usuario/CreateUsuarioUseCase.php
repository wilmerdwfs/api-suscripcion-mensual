<?php

namespace App\Application\UseCases\Usuario;

use App\Application\DTOs\Usuario\CreateUsuarioDTO;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Domain\ValueObjects\Empresa\LimiteUsuarios;
use App\Domain\Services\UsuarioEmailValidatorService;
use App\Domain\Policies\EmpresaPolicy;

class CreateUsuarioUseCase
{
    public function __construct(
        private UsuarioRepositoryInterface $usuarioRepo,
        private EmpresaRepositoryInterface $empresaRepo,
        private UsuarioEmailValidatorService $usuarioValidation
    ) {}

    public function execute(CreateUsuarioDTO $dto, Usuario $usuarioAutenticado): Usuario
    {

        $empresa = $this->empresaRepo->findById($dto->empresaId);

        $policy = new EmpresaPolicy();

        if (! $policy->manage($usuarioAutenticado, $empresa)) {
            throw new \Exception("No autorizado para gestionar esta empresa.");
        }

        // Validar email único
        $this->usuarioValidation->validarEmailUnico($dto->email);

    

        $actual = $this->usuarioRepo->countByEmpresa($empresa->id);
        $limite = $empresa->plan->limite_usuarios;

        $limiteUsuarios = new LimiteUsuarios($limite, $actual);

        if ($limiteUsuarios->excedido()) {
            throw ValidationException::withMessages([
                'empresa' => $limiteUsuarios->mensajeError() . ' Limite de usuarios: ' . $limiteUsuarios->disponibles(),
            ]);
        }

        $usuario = new Usuario([
            'nombre' => $dto->nombre,
            'email' => $dto->email,
            'password' => Hash::make($dto->password),
            'empresa_id' => $empresa->id
        ]);

        return $this->usuarioRepo->save($usuario);
    }
}