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
CRUD PLANES

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

JSON Content
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

GET /api/planes

JSON Content
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

PUT /api/planes/1

JSON Content
//
{
    "nombre": "Plan basico moderado",
    "limiteUsuarios": 6,
    "precioMensual": 50.000,
    "caracteristicas": 4
}

JSON Content
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

DELETE /api/planes/1

JSON Content
Response
//
{
  "message": "Plan eliminado correctamente"
}
//

CRUD EMPRESA

Endpoints:
GET /api/empresas
POST /api/empresas
PUT /api/empresas/parametro
DELETE /api/empresas/parametro

PUT /api/empresas/cambiar-plan
GET /api/empresas/suscripciones

POST /api/empresas

JSON Content
//
{
   "planId": 1, //el id plan
    "nombreEmpresa": "Tecno",
    "nombreUsuario": "Tecno",//esto es para crear un registro en la tabla usuarios
    "emailUsuario": "tecno@gmail.com",
    "passwordUsuario": "123456",
    "confirmarPassword": "123456"
}

JSON Content
Response
{
  "usuario": {
    "nombre": "Tecno",
    "email": "tecno@gmail.com",
    "password": "$2y$12$ASty7uAddGprxFjScoko6O8Y6IyNySInvrBmZmCACO.PJs4a3KwuG",
    "empresa_id": 1,
    "es_admin": 1,//importante para policies
    "id": 1
  },
  "access_token": "1|mUiWuU5K2lLDPBffscyYvZDZH4BsWDXL0xtdgA0Kff8adaef",/importante para logearse y hacer peticiones a las rutas restringidas
  "token_type": "Bearer",
  "autorizacion": "Bearer 1|mUiWuU5K2lLDPBffscyYvZDZH4BsWDXL0xtdgA0Kff8adaef"
}
//

PUT /api/empresas/cambiar-plan

JSON Content
//
{
    "planId":2
}

JSON Content
Response
{
  "mensaje": "Plan cambiado correctamente."
}
//

GET /api/empresas/suscripciones

JSON Content
Response
{
    "id": 2,
    "empresa_id": 8,
    "plan_anterior_id": 1,
    "plan_nuevo_id": 2,
    "estado": "0",
    "fecha": "2025-07-16"
}
//

CRUD USUARIOS

Endpoints:
GET /api/usuarios
POST /api/usuarios
PUT /api/usuarios/parametro
DELETE /api/usuarios/parametro

POST /api/usuarios
JSON Content
//
{
    "nombre": "Vendedor 1",
    "email": "vendedor1@gmail.com",
    "password": "123456",
    "confirmarPassword": "123456"
}

JSON Content
Response
{
  "usuario": {
    "nombre": "Vendedor 1",
    "email": "vendedor1@gmail.com",
    "password": "$2y$12$aWArICHw4/s8mEdqLogpQe5pXjY6BJjO2QAiMgHb0nL7Tp5WaZbnW",//placebo
    "empresa_id": 1,
    "id": 1
  },
  "access_token": "3|k9Yg4Xe9frUu05ad4jk45yrmowZ95D4dvZpGumop2eedf2f7",//importante para el logeo de ese usuario
  "autorizacion": "Bearer 3|k9Yg4Xe9frUu05ad4jk45yrmowZ95D4dvZpGumop2eedf2f7"
}
//

Si alcanza el limite de usuarios del plan
POST /api/usuarios

JSON Content
Response
//
{
  "error": "Se alcanzó el límite de usuarios según el plan actual. Limite de usuarios: 0"
}
//

POST /api/usuarios
Si el usuario entra hacer alguna peticion que le corresponde a la empresa

JSON Content
Response
//
{
  "error": "No autorizado para gestionar esta empresa."
}
//
```




