<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|----------------------------------------------------------------------
| API Routes
|----------------------------------------------------------------------
|
| Aquí puedes registrar las rutas API para tu aplicación.
| Estas rutas son cargadas por el RouteServiceProvider dentro del grupo
| que está asignado al middleware "api". ¡Disfruta creando tu API!
|
*/

// Rutas públicas
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// Ruta protegida (requiere autenticación con Sanctum)
Route::middleware('auth:sanctum')->get('user', [AuthController::class, 'user']);
