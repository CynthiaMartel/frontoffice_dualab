<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FamiliaController;
use App\Http\Controllers\Api\RetoController;
use App\Http\Controllers\Api\InscripcionController;
use App\Http\Controllers\Api\ContactoController;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->middleware('throttle:5,1');
    Route::post('login',    [AuthController::class, 'login'])->middleware('throttle:login');
    Route::post('logout',   [AuthController::class, 'logout'])->middleware('auth:sanctum');
    Route::get('me',        [AuthController::class, 'me'])->middleware('auth:sanctum');
});

Route::get('familias',           [FamiliaController::class, 'index']);
Route::get('familias/{familia}', [FamiliaController::class, 'show']);
Route::get('retos',              [RetoController::class, 'index'])->middleware('throttle:30,1');
Route::get('retos/{reto}',       [RetoController::class, 'show']);

Route::post('contacto', [ContactoController::class, 'store'])->middleware('throttle:10,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('mis-inscripciones',              [InscripcionController::class, 'index']);
    Route::post('retos/{reto}/inscribirse',      [InscripcionController::class, 'store']);
    Route::delete('inscripciones/{inscripcion}', [InscripcionController::class, 'destroy']);

    Route::middleware('can:manage-retos')->group(function () {
        Route::post('retos',          [RetoController::class, 'store']);
        Route::put('retos/{reto}',    [RetoController::class, 'update']);
        Route::delete('retos/{reto}', [RetoController::class, 'destroy']);
    });
});
