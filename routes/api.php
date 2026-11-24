<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EstudentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\ModuleTeacherController;
use App\Http\Controllers\DelegadoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/


Route::get('teachers', [TeacherController::class, 'index'])->name('api.v1.teachers.index');

Route::post('teachers', [TeacherController::class, 'store'])->name('api.v1.teachers.store');

Route::get('teachers/{teacher}', [TeacherController::class, 'show'])->name('api.v1.teachers.show');

Route::put('teachers/{teacher}', [TeacherController::class, 'update'])->name('api.v1.teacher.update');

Route::delete('teachers/{teacher}', [TeacherController::class, 'destroy'])->name('api.v1.teacher.destroy');




Route::get('estudents', [EstudentController::class, 'index'])->name('api.v1.estudents.index');

Route::post('estudents', [EstudentController::class, 'store'])->name('api.v1.estudents.store');

Route::get('estudents/{estudent}', [EstudentController::class, 'show'])->name('api.v1.estudents.show');

Route::put('estudents/{estudent}', [EstudentController::class, 'update'])->name('api.v1.estudent.update');

Route::delete('estudents/{estudent}', [EstudentController::class, 'destroy'])->name('api.v1.estudent.destroy');




Route::get('modules', [ModuleController::class, 'index'])->name('api.v1.modules.index');

Route::post('modules', [ModuleController::class, 'store'])->name('api.v1.modules.store');

Route::get('modules/{module}', [ModuleController::class, 'show'])->name('api.v1.modules.show');

Route::put('modules/{module}', [ModuleController::class, 'update'])->name('api.v1.module.update');

Route::delete('modules/{module}', [ModuleController::class, 'destroy'])->name('api.v1.module.destroy');


Route::post('/matriculas', [MatriculaController::class, 'matricular'])->name('api.v1.matriculas.store');

Route::get('/estudents/{id}/modules', [MatriculaController::class, 'modulosEstudiante'])->name('api.v1.estudents.modules');

Route::get('/modules/{id}/estudents', [MatriculaController::class, 'estudiantesModulo'])->name('api.v1.modules.estudents');

Route::delete('/matriculas', [MatriculaController::class, 'retirar'])->name('api.v1.matriculas.destroy');

Route::post('/asignaciones', [ModuleTeacherController::class, 'asignar'])->name('api.v1.asignaciones.store');

Route::get('/teachers/{id}/modules', [ModuleTeacherController::class, 'modulosProfesor'])->name('api.v1.teachers.modules');

Route::get('/modules/{id}/teachers', [ModuleTeacherController::class, 'profesoresModulo'])->name('api.v1.modules.teachers');

Route::delete('/asignaciones', [ModuleTeacherController::class, 'retirar'])->name('api.v1.asignaciones.destroy');

Route::post('/delegados', [DelegadoController::class, 'asignar'])->name('delegados.store');

Route::get('/estudents/{id}/delegado', [DelegadoController::class, 'consultar'])->name('estudents.delegado');

Route::get('/delegados/{id}/representados', [DelegadoController::class, 'representados'])->name('delegados.representados');

Route::delete('/estudents/{id}/delegado', [DelegadoController::class, 'retirar'])->name('delegados.destroy');