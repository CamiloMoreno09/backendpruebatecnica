<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;


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
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});
Route::middleware('auth:sanctum')->post('/posts', [PostController::class, 'createPost']);
Route::get('posts/search', [PostController::class, 'searchPosts']); 
Route::get('posts', [PostController::class, 'getAllPosts']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);



