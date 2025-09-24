<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AllanpruebaController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\TareaController; // 👈 Asegúrate de importar tu controlador

// Ruta de prueba publica
Route::prefix('usuarios')->group(function() {
    Route::get('/saludar', [AllanpruebaController::class, 'index']);
});

//ruta agregada modificada 23/09/2025-->ruta publicas de autenticacion
Route::post('/login', [AuthController::class, 'login']);

// ruta agregada modificada 23/09/2025--> Rutas protegidas por Sanctum
Route::middleware('auth:sanctum')->group(function () {
// Rutas para Usuarios
Route::prefix('usuarios')->group(function () {
    Route::get('/listUsers', [UsuarioController::class, 'index']);
    Route::post('/addUser', [UsuarioController::class, 'store']);
    Route::get('/getUser/{id}', [UsuarioController::class, 'show']);
    Route::put('/updateUser/{id}', [UsuarioController::class, 'update']);
    Route::delete('/deleteUser/{id}', [UsuarioController::class, 'destroy']);
});
// 🚀 NUEVO: Rutas para Tareas
Route::prefix('tareas')->group(function () {
    Route::get('/', [TareaController::class, 'index']);   // Listar tareas
    Route::post('/', [TareaController::class, 'store']); // Crear tarea
    Route::get('/{id}', [TareaController::class, 'show']); 
    Route::put('/{id}', [TareaController::class, 'update']); 
    Route::delete('/{id}', [TareaController::class, 'destroy']); 
});

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});