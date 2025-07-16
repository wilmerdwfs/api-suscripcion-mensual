<?php
namespace App\Application\UseCases\Empresa;

use App\Application\DTOs\Empresa\CreateEmpresaDTO;
use App\Domain\Models\Empresa;
use App\Domain\Models\Usuario;
use App\Domain\Repositories\EmpresaRepositoryInterface;
use App\Domain\Repositories\UsuarioRepositoryInterface;
use App\Domain\Repositories\SuscripcionRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CreateEmpresaUseCase
{
    public function __construct(
        private EmpresaRepositoryInterface $empresaRepo,
        private UsuarioRepositoryInterface $usuarioRepo,
        private SuscripcionRepositoryInterface $suscripcionRepo
    ) {}

    public function execute(CreateEmpresaDTO $dto)
    {
        return DB::transaction(function () use ($dto) {
            // Crear empresa
            $empresa = new Empresa([
                'nombre' => $dto->nombreEmpresa,
                'plan_id' => $dto->planId,
            ]);
            $this->empresaRepo->save($empresa);

            // Crear usuario admin
            $usuario = new Usuario([
                'nombre' => $dto->nombreUsuario,
                'email' => $dto->emailUsuario,
                'password' => Hash::make($dto->passwordUsuario),
                'empresa_id' => $empresa->id,
                'es_admin' => 1,
            ]);
            $usuario = $this->usuarioRepo->save($usuario);

            $this->suscripcionRepo->registrarHistorialCambio(
                empresaId: $empresa->id,
                planAnteriorId: $dto->planId, // el mismo plan
                planNuevoId: $dto->planId,
            );

            // Generar token sin usar Auth::login
            $token = $usuario->createToken('api-token')->plainTextToken;

            return response()->json([
                'usuario' => $usuario,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'autorizacion' => 'Bearer '.$token,
            ]);
        });
    }
}