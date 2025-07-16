# 🧠 Proyecto con Domain-Driven Design (DDD)

Este proyecto implementa una arquitectura basada en **DDD (Domain-Driven Design)** utilizando Laravel como framework principal. El objetivo es mantener un código modular, desacoplado y alineado con las reglas del negocio.

---

## 📦 Estructura del Proyecto

## 📦 Estructura del Proyecto (DDD) con archivos

```txt
app/
├── Domain/
│   ├── Empresa/
│   │   ├── Entities/
│   │   │   └── Empresa.php
│   │   ├── ValueObjects/
│   │   │   └── Ruc.php
│   │   ├── Repositories/
│   │   │   └── EmpresaRepositoryInterface.php
│   │   └── Services/
│   │       └── EmpresaValidator.php
│   ├── Usuario/
│   │   ├── Entities/
│   │   │   └── Usuario.php
│   │   └── ValueObjects/
│   │       └── Email.php
│
├── Application/
│   ├── UseCases/
│   │   └── CreateEmpresaUseCase.php
│   ├── DTOs/
│   │   ├── Empresa/
│   │   │   ├── CambiarPlanDTO.php
│   │   │   ├── CreateEmpresaDTO.php
│   │   │   └── UpdateEmpresaDTO.php
│   │   ├── Plan/
    │   │   ├── CreatePlanDTO.php
    │   │   └── UpdatePlanDTO.php
    │   └── Ususario/
    │        ├── CreateUsuarioDTO.php
    │        └── UpdateUsuarioDTO.php
    └── UseCases/

└── UpdatePlanDTO.php
├── Infrastructure/
│   ├── Persistence/
│   │   ├── EloquentEmpresaRepository.php
│   │   └── migrations/
│   │       └── 2025_07_16_create_empresas_table.php
│   └── Services/
│       └── EmailService.php
│
├── Http/
│   ├── Controllers/
│   │   └── EmpresaController.php
│   ├── Requests/
│   │   └── EmpresaRequest.php
│   └── Routes/
│       └── api.php
│
tests/
├── Unit/
│   └── Domain/
│       └── EmpresaTest.php
├── Feature/
│   └── Api/
│       └── EmpresaApiTest.php


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
