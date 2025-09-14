<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AllanpruebaController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\TareaController; // 👈 Asegúrate de importar tu controlador

// Ruta de prueba
Route::prefix('usuarios')->group(function() {
    Route::get('/saludar', [AllanpruebaController::class, 'index']);
});

// Rutas para Usuarios
Route::prefix('usuarios')->group(function () {
    Route::get('/listUsers', [UsuarioController::class, 'index']);
    Route::post('/addUser', [UsuarioController::class, 'store']);
    Route::get('/getUser/{id}', [UsuarioController::class, 'show']);
    Route::put('/updateUser/{id}', [UsuarioController::class, 'update']);
    Route::delete('/deleteUser/{id}', [UsuarioController::class, 'destroy']);
});

// Rutas para autenticación
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// 🚀 NUEVO: Rutas para Tareas
Route::prefix('tareas')->group(function () {
    Route::get('/', [TareaController::class, 'index']);   // Listar tareas
    Route::post('/', [TareaController::class, 'store']); // Crear tarea
    Route::get('/{id}', [TareaController::class, 'show']); 
    Route::put('/{id}', [TareaController::class, 'update']); 
    Route::delete('/{id}', [TareaController::class, 'destroy']); 
});
