# 🧱 Estructura del Proyecto Suscripcion Mensual (Arquitectura DDD - Laravel 12)

Este proyecto sigue los principios de **Domain Driven Design (DDD)** y está organizado en capas bien definidas:
**Application**, **Domain**, **Infrastructure**, **Http**, y **Tests**.

---
```bash
## 📂 app
app
├── Application
│ ├── DTOS
│ │ ├── Empresa
│ │ │ ├── CambiarPlanDTO.php
│ │ │ ├── CreateEmpresaDTO.php
│ │ │ └── UpdateEmpresaDTO.php
│ │ ├── Plan
│ │ │ ├── CreatePlanDTO.php
│ │ │ └── UpdatePlanDTO.php
│ │ └── Usuario
│ │ ├── CreateUsuarioDTO.php
│ │ └── UpdateUsuarioDTO.php
│ │
│ └── UseCases
│ ├── Empresa
│ │ ├── CambiarPlanUseCase.php
│ │ ├── CreateEmpresaUseCase.php
│ │ ├── DeleteEmpresaUseCase.php
│ │ ├── GetEmpresaUseCase.php
│ │ └── UpdateEmpresaUseCase.php
│ ├── Plan
│ │ ├── CreatePlanUseCase.php
│ │ ├── DeletePlanUseCase.php
│ │ ├── GetPlanCaracteristicasUseCase.php
│ │ ├── GetPlanUseCase.php
│ │ └── UpdatePlanUseCase.php
│ └── Usuario
│ ├── CreateUsuarioUseCase.php
│ ├── DeleteUsuarioUseCase.php
│ ├── GetUsuarioUseCase.php
│ └── UpdateUsuarioUseCase.php
│
├── Domain
│ ├── Models
│ │ ├── Empresa.php
│ │ ├── Plan.php
│ │ ├── PlanSuscripcion.php
│ │ └── Usuario.php
│ ├── Policies
│ │ └── EmpresaPolicy.php
│ ├── Repositories
│ │ ├── EmpresaRepositoryInterface.php
│ │ ├── PlanRepositoryInterface.php
│ │ ├── SuscripcionRepositoryInterface.php
│ │ └── UsuarioRepositoryInterface.php
│ ├── Services
│ │ └── UsuarioEmailValidatorService.php
│ └── ValueObjects
│ ├── Empresa
│ │ └── LimiteUsuarios.php
│ ├── Plan
│ │ └── Caracteristicas.php
│ └── Usuario
│ └── EmailUsuario.php
│
├── Http
│ ├── Controllers
│ │ ├── EmpresaController.php
│ │ ├── PlanController.php
│ │ └── UsuarioController.php
│ ├── Requests
│ │ ├── Empresa
│ │ │ ├── FormCambiarPlanRequest.php
│ │ │ ├── StoreEmpresaRequest.php
│ │ │ └── UpdateEmpresaRequest.php
│ │ ├── Plan
│ │ │ ├── StorePlanRequest.php
│ │ │ └── UpdatePlanRequest.php
│ │ └── Usuario
│ │ └── FormCreateUsuarioRequest.php
│ └── Resources
│ └── PlanResource.php
│
├── Infrastructure
│ └── Eloquent
│ ├── EloquentEmpresaRepository.php
│ ├── EloquentPlanRepository.php
│ ├── EloquentSuscripcionRepository.php
│ └── EloquentUsuarioRepository.php
│
├── Providers
│ └── AppServiceProvider.php
│
└── database
├── factories
│ ├── EmpresaFactory.php
│ ├── PlanesSuscripcionFactory.php
│ ├── PlanFactory.php
│ └── UsuarioFactory.php
└── migrations

---

## 🛣️ routes/api.php
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PlanController,
    EmpresaController,
    UsuarioController
};

/*
|--------------------------------------------------------------------------
| API Routes - DDD Structure
|--------------------------------------------------------------------------
|
| Todas las rutas aquí son prefijadas con '/api' automáticamente
| y llevan el middleware 'api' por defecto.
|
*/

// Grupo de rutas protegidas
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('usuarios', UsuarioController::class);
    
    Route::put('empresas/cambiar-plan', [EmpresaController::class, 'cambiarPlan']);
    Route::get('empresas/suscripciones', [EmpresaController::class, 'suscripciones']);
});

// Rutas públicas
Route::apiResource('planes', PlanController::class);
Route::apiResource('empresas', EmpresaController::class);

🧪 tests

tests
└── Unit
    ├── Application
    │   └── UseCases
    │       ├── Empresa
    │       │   ├── CambiarPlanUseCaseTest.php
    │       │   ├── CreateEmpresaUseCaseTest.php
    │       │   ├── DeleteEmpresaUseCaseTest.php
    │       │   ├── GetEmpresaUseCaseTest.php
    │       │   └── UpdateEmpresaUseCaseTest.php
    │       ├── Plan
    │       │   ├── CreatePlanUseCaseTest.php
    │       │   ├── DeletePlanUseCaseTest.php
    │       │   ├── GetPlanCaracteristicasUseCaseTest.php
    │       │   ├── GetPlanUseCaseTest.php
    │       │   └── UpdatePlanUseCaseTest.php
    │       └── Usuario
    │           ├── CreateUsuarioUseCaseTest.php
    │           ├── DeleteUsuarioUseCaseTest.php
    │           ├── GetUsuarioUseCaseTest.php
    │           └── UpdateUsuarioUseCaseTest.php
    │
    ├── Domain
    │   ├── Policies
    │   │   └── EmpresaPolicyTest.php
    │   ├── Services
    │   │   └── UsuarioEmailValidatorServiceTest.php
    │   └── ValueObjects
    │       ├── Empresa
    │       │   └── LimiteUsuariosTest.php
    │       ├── Plan
    │       │   └── CaracteristicasTest.php
    │       └── Usuario
    │           └── EmailUsuarioTest.php
    │
    └── Infrastructure
        └── Eloquent
            ├── EloquentEmpresaRepositoryTest.php
            ├── EloquentPlanRepositoryTest.php
            └── EloquentSuscripcionRepositoryTest.php

```

⚙️ Convenciones
Cada Use Case representa una acción de negocio independiente.

Los DTOs encapsulan datos de entrada y salida entre capas.

Los Repositories definen interfaces del dominio, implementadas en Infrastructure.

Los Value Objects modelan valores inmutables y con reglas de validación propias.

Los Tests unitarios están organizados por capa y caso de uso.
