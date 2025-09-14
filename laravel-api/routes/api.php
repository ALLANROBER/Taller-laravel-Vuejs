<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AllanpruebaController;
use App\Http\Controllers\Api\UsuarioController;
use App\Http\Controllers\Api\AuthController;


Route::prefix('usuarios')->group(function() {
    Route::get('/saludar', [AllanpruebaController::class, 'index']);
});

// Rutas para el controlador de usuarios, asignando nombres personalizados
Route::prefix('usuarios')->group(function () {
    Route::get('/listUsers', [UsuarioController::class, 'index']);
    Route::post('/addUser', [UsuarioController::class, 'store']);
    Route::get('/getUser/{id}', [UsuarioController::class, 'show']);
    Route::put('/updateUser/{id}', [UsuarioController::class, 'update']);
    Route::delete('/deleteUser/{id}', [UsuarioController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);