# 🧠 Proyecto con Domain-Driven Design (DDD)

Este proyecto implementa una arquitectura basada en **DDD (Domain-Driven Design)** utilizando Laravel como framework principal. El objetivo es mantener un código modular, desacoplado y alineado con las reglas del negocio.

---

## 📦 Estructura del Proyecto

## 📦 Estructura del Proyecto (DDD) con archivos

```txt
app/
├── Domain/
│   ├── Models/
│   │   ├── Empresa.php
│   │   ├── Plan.php
│   │   ├── PlanesSuscripcion.php
│   │   └── Usuario.php
│   │
│   ├── Policies/
│   │   └── EmpresaPolicy.php
│   │
│   ├── Repositories/
│   │   ├── EmpresaRepositoryInterface.php
│   │   ├── PlanRepositoryInterface.php
│   │   ├── SuscripcionRepositoryInterface.php
│   │   └── UsuarioRepositoryInterface.php
│   │
│   ├── Services/
│   │   └── UsuarioEmailValidatorService.php
│   │
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
│   │
│   └── Services/
│       └── EmailService.php
│
├── Http/
│   ├── Controllers/
│   │   ├── EmpresaController.php
│   │   ├── PlanController.php
│   │   └── UsuarioController.php
│   │
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
│   │
│   └── Routes/
│       └── api.php
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
│   │
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
│   │
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

## ⚙️ Instalación

```bash
git clone https://github.com/tu-usuario/tu-repo.git
cd tu-repo
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
🧪 Ejecutar Tests
bash
Copiar
Editar
php artisan test
# o directamente con PHPUnit
./vendor/bin/phpunit
