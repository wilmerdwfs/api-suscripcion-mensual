# 🧱 Estructura del Proyecto Suscripcion Mensual (Arquitectura DDD - Laravel 12)

🎯 Objetivo general

Una API RESTful con Laravel 12, PHP 8.4 y MySQL 8.0, aplicando Domain Driven Design (DDD) y arquitectura limpia para lograr un código mantenible, testeable y escalable.

🧩 Escenario

El backend es una plataforma SaaS donde varias empresas pueden registrarse, elegir un plan de suscripción mensual y gestionar sus usuarios internos según las restricciones de su plan activo.

⚙️ Requisitos funcionales

Planes: CRUD completo con nombre, precio, límite de usuarios y características.

Empresas: CRUD completo; cada empresa tiene un solo plan activo y mantiene historial de suscripciones.

Usuarios: CRUD de usuarios internos por empresa, validando el límite de usuarios definido en el plan vigente.

Estructura:

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

```
🧪 tests

```bash
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


🧭 Instrucciones de uso del módulo API (estructura DDD)
📁 Archivo principal

routes/api.php

Este archivo define todas las rutas disponibles en la API del proyecto, organizadas según el patrón DDD (Domain Driven Design) y protegidas por Sanctum cuando es necesario.

🚀 Endpoints disponibles
🔐 Rutas protegidas (requieren autenticación con token Sanctum)

```bash
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('usuarios', UsuarioController::class);
    
    Route::put('empresas/cambiar-plan', [EmpresaController::class, 'cambiarPlan']);
    Route::get('empresas/suscripciones', [EmpresaController::class, 'suscripciones']);
});

```
Uso

Autenticación: debes enviar un token Bearer válido en el header
Authorization: Bearer {token}

```
Rutas disponibles:

GET /api/usuarios → Lista de usuarios

POST /api/usuarios → Crear usuario

PUT /api/usuarios/{id} → Actualizar usuario

DELETE /api/usuarios/{id} → Eliminar usuario

PUT /api/empresas/cambiar-plan → Cambiar plan de la empresa

GET /api/empresas/suscripciones → Consultar suscripciones activas

🌐 Rutas públicas
Route::apiResource('planes', PlanController::class);
Route::apiResource('empresas', EmpresaController::class);

```
Uso

No requieren autenticación.

Rutas generadas automáticamente:

```
GET /api/planes → Lista de planes

GET /api/planes/{id} → Detalle de plan

POST /api/planes → Crear plan

PUT /api/planes/{id} → Actualizar plan

DELETE /api/planes/{id} → Eliminar plan
(lo mismo aplica para /api/empresas)
```

