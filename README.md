# 🧠 Proyecto con Domain-Driven Design (DDD)

Este proyecto implementa una arquitectura basada en **DDD (Domain-Driven Design)** utilizando Laravel como framework principal. El objetivo es mantener un código modular, desacoplado y alineado con las reglas del negocio.

---

## 📦 Estructura del Proyecto

```txt
app/
├── Domain/                # Núcleo del negocio
│   ├── Empresa/
│   │   ├── Entities/
│   │   ├── ValueObjects/
│   │   ├── Repositories/
│   │   └── Services/
├── Application/
│   ├── UseCases/
│   └── DTOs/
├── Infrastructure/
│   ├── Persistence/
│   └── Services/
├── Http/
│   ├── Controllers/
│   ├── Requests/
│   └── Routes/
tests/


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
