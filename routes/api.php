<?php

use Illuminate\Http\Request;
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

Route::apiResource('planes', PlanController::class);

Route::apiResource('empresas', EmpresaController::class);









