# 🧠 Proyecto con Domain-Driven Design (DDD)

Este proyecto implementa una arquitectura basada en **DDD (Domain-Driven Design)** utilizando Laravel como framework principal. El objetivo es mantener un código modular, desacoplado y alineado con las reglas del negocio.

---

## 📦 Estructura del Proyecto (DDD) con archivos

```txt
app/
├── Domain/
│   ├── Models/
│   │   ├── Empresa.php
│   │   ├── Plan.php
│   │   ├── PlanesSuscripcion.php
│   │   └── Usuario.php
│   ├── Policies/
│   │   └── EmpresaPolicy.php
│   ├── Repositories/
│   │   ├── EmpresaRepositoryInterface.php
│   │   ├── PlanRepositoryInterface.php
│   │   ├── SuscripcionRepositoryInterface.php
│   │   └── UsuarioRepositoryInterface.php
│   ├── Services/
│   │   └── UsuarioEmailValidatorService.php
│   └── ValueObjects/
│       ├── Empresa/
│       │   └── LimiteUsuarios.php
│       ├── Plan/
│       │   └── Caracteristicas.php
│       └── Usuario/
│           └── EmailUsuario.php
│
├── Application/
│   ├── UseCases/
│   │   ├── Empresa/
│   │   │   ├── CambiarPlanUseCase.php
│   │   │   ├── CreateEmpresaUseCase.php
│   │   │   ├── DeleteEmpresaUseCase.php
│   │   │   ├── GetEmpresaUseCase.php
│   │   │   ├── GetSuscripcionesUseCase.php
│   │   │   └── UpdateEmpresaUseCase.php
│   │   ├── Plan/
│   │   │   ├── CreatePlanUseCase.php
│   │   │   ├── DeletePlanUseCase.php
│   │   │   ├── GetPlanCaracteristicasUseCase.php
│   │   │   ├── GetPlanUseCase.php
│   │   │   └── UpdatePlanUseCase.php
│   │   └── Usuario/
│   │       ├── CreateUsuarioUseCase.php
│   │       ├── DeleteUsuarioUseCase.php
│   │       ├── GetUsuarioUseCase.php
│   │       └── UpdateUsuarioUseCase.php
│   └── DTOs/
│       ├── Empresa/
│       │   ├── CambiarPlanDTO.php
│       │   ├── CreateEmpresaDTO.php
│       │   └── UpdateEmpresaDTO.php
│       ├── Plan/
│       │   ├── CreatePlanDTO.php
│       │   └── UpdatePlanDTO.php
│       └── Usuario/
│           ├── CreateUsuarioDTO.php
│           └── UpdateUsuarioDTO.php
│
├── Infrastructure/
│   ├── Eloquent/
│   │   ├── EloquentEmpresaRepository.php
│   │   ├── EloquentPlanRepository.php
│   │   ├── EloquentSuscripcionRepository.php
│   │   └── EloquentUsuarioRepository.php
│   └── Services/
│       └── EmailService.php
│
├── Http/
│   ├── Controllers/
│   │   ├── EmpresaController.php
│   │   ├── PlanController.php
│   │   └── UsuarioController.php
│   ├── Requests/
│   │   ├── Empresa/
│   │   │   ├── FormCambiarPlanRequest.php
│   │   │   ├── StoreEmpresaRequest.php
│   │   │   └── UpdateEmpresaRequest.php
│   │   ├── Plan/
│   │   │   ├── StorePlanRequest.php
│   │   │   └── UpdatePlanRequest.php
│   │   └── Usuario/
│   │       └── FormCreateUsuarioRequest.php
│   └── Routes/
│       └── api.php      # Define rutas:
│                        # - Route::apiResource('usuarios', UsuarioController::class);
│                        # - Route::put('empresas/cambiar-plan', [EmpresaController::class, 'cambiarPlan']);
│                        # - Route::apiResource('planes', PlanController::class);
│                        # Todas protegidas con middleware 'auth:sanctum' según el grupo
│
tests/
├── Unit/
│   ├── Domain/
│   │   ├── Models/
│   │   │   ├── EmpresaTest.php
│   │   │   ├── PlanTest.php
│   │   │   └── UsuarioTest.php
│   │   ├── Policies/
│   │   │   └── EmpresaPolicyTest.php
│   │   ├── Services/
│   │   │   └── UsuarioEmailValidatorServiceTest.php
│   │   └── ValueObjects/
│   │       ├── Empresa/
│   │       │   └── LimiteUsuariosTest.php
│   │       ├── Plan/
│   │       │   └── CaracteristicasTest.php
│   │       └── Usuario/
│   │           └── EmailUsuarioTest.php
│   ├── Application/
│   │   └── UseCases/
│   │       ├── Empresa/
│   │       │   ├── CambiarPlanUseCaseTest.php
│   │       │   ├── CreateEmpresaUseCaseTest.php
│   │       │   ├── DeleteEmpresaUseCaseTest.php
│   │       │   ├── GetEmpresaUseCaseTest.php
│   │       │   ├── GetSuscripcionesUseCaseTest.php
│   │       │   └── UpdateEmpresaUseCaseTest.php
│   │       ├── Plan/
│   │       │   ├── CreatePlanUseCaseTest.php
│   │       │   ├── DeletePlanUseCaseTest.php
│   │       │   ├── GetPlanCaracteristicasUseCaseTest.php
│   │       │   ├── GetPlanUseCaseTest.php
│   │       │   └── UpdatePlanUseCaseTest.php
│   │       └── Usuario/
│   │           ├── CreateUsuarioUseCaseTest.php
│   │           ├── DeleteUsuarioUseCaseTest.php
│   │           ├── GetUsuarioUseCaseTest.php
│   │           └── UpdateUsuarioUseCaseTest.php
│   └── Infrastructure/
│       └── Eloquent/
│           ├── EloquentEmpresaRepositoryTest.php
│           ├── EloquentPlanRepositoryTest.php
│           ├── EloquentSuscripcionRepositoryTest.php
│           └── EloquentUsuarioRepositoryTest.php
---

## 🚀 Tecnologías

- PHP 8.4
- Laravel 12.x
- MySQL 8.0
- PHPUnit
- Composer

---
⚙️ Instalación

git clone https://github.com/wilmerdwfs/api-suscripcion-mensual.git
cd api-suscripcion-mensual
composer install, esto es para instalar dependencias si se da el caso
Mover el proyecto a un servidor de aplicaciones como xampp o simplemente ponerlo a funcionar con el comando php artisan serve como un servidor virtual
cp .env.example .env

.env :
// #parametros importantes
   DB_DATABASE=suscripcion_mensual #la que se tenga
   DB_USERNAME=root #la que se tenga
   DB_PASSWORD= #la que se tenga
//
, cambiar el nombre de ese archivo: conexion a la base de datos

php artisan migrate
```

## 🚀 Primer Uso de la API
Una vez el servidor esté en ejecución (php artisan serve) o simpremente alojado en un servidor de aplicaciones como xampp, puedes comenzar probando los endpoints con tu cliente REST preferido (Postman, Insomnia, Thunder Client, etc.).

```txt
Endpoint: POST /api/planes
Este endpoint crea un nuevo plan de suscripción.

JSON Content
//
{
    "nombre": "Plan basico",
    "limiteUsuarios": 43,
    "precioMensual": 43,
    "caracteristicas": 4
}

Response
{
  "mensaje": "Plan creado correctamente",
  "plan": {
    "nombre": "Plan basico",
    "precio_mensual": 40.000,
    "limite_usuarios": 4,
    "caracteristicas": 4,
    "id": 1
  }
}
//

Endpoint: GET /api/planes
//
Response
{
  "mensaje": "Plan creado correctamente",
  "plan": {
    "id": 1
    "nombre": "Plan basico",
    "precio_mensual": 40.000,
    "limite_usuarios": 4,
    "caracteristicas": {
      "DOMINIO_PERSONALIZADO": false,
      "ACCESO_API": false,
      "PANEL_ANALITICAS": true
    }
  }
}
//

Endpoint: PUT /api/planes/1
//
{
    "nombre": "Plan basico moderado",
    "limiteUsuarios": 6,
    "precioMensual": 50.000,
    "caracteristicas": 4
}

Response
{
  "mensaje": "Plan actualizado correctamente",
  "plan": {
    "id": 16,
    "nombre": "Plan basico moderado",
    "precio_mensual": 50.000,
    "limite_usuarios": 6,
    "caracteristicas": "4"
  }
}
//

Endpoint: DELETE /api/planes/1
Response
//
{
  "message": "Plan eliminado correctamente"
}
//
```




