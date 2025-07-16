<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Importa tus modelos y políticas aquí
use App\Domain\Models\Empresa;
use App\Domain\Policies\EmpresaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    // Mapear modelos con políticas
    protected $policies = [
        Empresa::class => EmpresaPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Puedes definir gates o más configuraciones si quieres
    }
}