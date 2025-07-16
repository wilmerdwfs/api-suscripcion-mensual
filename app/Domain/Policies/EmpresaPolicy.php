<?php
// App/Domain/Policies/EmpresaPolicy.php
namespace App\Domain\Policies;

use App\Domain\Models\Usuario;
use App\Domain\Models\Empresa;

class EmpresaPolicy
{
    public function manage(Usuario $user, Empresa $empresa): bool
    {
        return $user->es_admin === 1 && $user->empresa_id === $empresa->id;
    }
}