<?php

use App\Http\Controllers\carrerasController;
use App\Http\Controllers\estudiantesController;
use App\Http\Controllers\materiasController;
use App\Http\Controllers\seccionesController;
use App\Http\Controllers\semestresController;
use Illuminate\Support\Facades\Route;

Route::Resource('estudiantes', estudianteController::class);
Route::Resource('materias', materiasController::class);
Route::post('/carreras/{carrera}/semestres/unified', [semestresController::class, 'unifiedAction'])->name('semestres.unifiedAction');
Route::delete('/semestres/mass-destroy', [semestresController::class, 'massDestroy'])->name('semestres.massDestroy');
Route::resource('semestres', semestresController::class);
Route::get('/{carrera}/semestres', [semestresController::class, 'create'])->name('semestres.create');
Route::get('/semestres/{semestre}', [semestresController::class, 'show'])->name('semestres.show');
Route::post('/semestres/{semestre}/inscribir', [semestresController::class, 'inscribir'])->name('semestres.inscribir');
Route::delete('/recorridos/{recorrido}', [semestresController::class, 'destroyInscripcion'])->name('recorridos.destroy');
Route::Resource('secciones', seccionesController::class);
Route::Resource('carreras', carrerasController::class);
Route::Resource('estudiantes', estudiantesController::class);
Route::post('/carreras/{carrera}/add-estudiante', [carrerasController::class, 'addEstudiante'])->name('carreras.addEstudiante');
Route::get('/{carrera}/associate-semestres', [semestresController::class, 'associateSemestresForm'])->name('associateSemestresForm');
// Nueva ruta para procesar la asociación (usará el método POST)
Route::post('/{carrera}/associate-semestres', [semestresController::class, 'associateSemestres'])->name('associateSemestres');
