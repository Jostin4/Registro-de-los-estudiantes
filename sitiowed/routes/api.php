<?php

use App\Http\Controllers\carrerasController;
use App\Http\Controllers\estudiantesController;
use App\Http\Controllers\materiasController;
use App\Http\Controllers\seccionesController;
use App\Http\Controllers\semestresController;
use Illuminate\Support\Facades\Route;

Route::Resource('estudiantes', estudianteController::class);
Route::Resource('materias', materiasController::class);
Route::Resource('semestres', semestresController::class);
Route::Resource('secciones', seccionesController::class);
Route::Resource('carreras', carrerasController::class);
Route::Resource('estudiantes', estudiantesController::class);
Route::get('/{carrera}/associate-semestres', [semestresController::class, 'associateSemestresForm'])->name('associateSemestresForm');
// Nueva ruta para procesar la asociación (usará el método POST)
Route::post('/{carrera}/associate-semestres', [semestresController::class, 'associateSemestres'])->name('associateSemestres');
