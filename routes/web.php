<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ExpedienteClinicoController;
use App\Http\Controllers\EvaluacionNutricionalController;
use App\Http\Controllers\DocumentoClinicoController;
use App\Http\Controllers\PlanAlimenticioController;
use App\Http\Controllers\DiaNoLaborableController;
/*
|--------------------------------------------------------------------------
| Página pública
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('inicio');

/*
|--------------------------------------------------------------------------
| Autenticación
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'mostrarLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('login.procesar');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| Panel del nutriólogo
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'rol:nutriologo'])
    ->prefix('nutriologo')
    ->name('nutriologo.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'nutriologo'])
            ->name('dashboard');

        
        Route::get('/dias-no-laborables', [
            DiaNoLaborableController::class,
            'index'
        ])->name('dias-no-laborables.index');

        Route::post('/dias-no-laborables', [
            DiaNoLaborableController::class,
            'store'
        ])->name('dias-no-laborables.store');

        Route::delete('/dias-no-laborables/{diaNoLaborable}', [
            DiaNoLaborableController::class,
            'destroy'
        ])->name('dias-no-laborables.destroy');

        // Pacientes
        Route::get('/pacientes', [PacienteController::class, 'index'])
            ->name('pacientes.index');

        Route::get('/pacientes/crear', [PacienteController::class, 'create'])
            ->name('pacientes.create');

        Route::post('/pacientes', [PacienteController::class, 'store'])
            ->name('pacientes.store');

        Route::get('/pacientes/{paciente}', [PacienteController::class, 'show'])
            ->whereNumber('paciente')
            ->name('pacientes.show');

        Route::get('/pacientes/{paciente}/editar', [PacienteController::class, 'edit'])
            ->whereNumber('paciente')
            ->name('pacientes.edit');

        Route::put('/pacientes/{paciente}', [PacienteController::class, 'update'])
            ->whereNumber('paciente')
            ->name('pacientes.update');

        Route::patch('/pacientes/{paciente}/estado', [
            PacienteController::class,
            'cambiarEstado',
        ])->whereNumber('paciente')->name('pacientes.estado');

        // Citas
        Route::get('/citas', [CitaController::class, 'todas'])
            ->name('citas.index');

        Route::patch('/citas/{cita}/estado', [
            CitaController::class,
            'cambiarEstado',
        ])->whereNumber('cita')->name('citas.estado');

        Route::patch('/citas/{cita}/cancelar', [
            CitaController::class,
            'cancelarNutriologo',
        ])->whereNumber('cita')->name('citas.cancelar');

        Route::patch('/citas/{cita}/reprogramacion', [
            CitaController::class,
            'responderReprogramacion',
        ])->whereNumber('cita')->name('citas.reprogramacion');

        // Evaluaciones
        Route::get('/citas/{cita}/evaluacion', [
            EvaluacionNutricionalController::class,
            'crear',
        ])->whereNumber('cita')->name('evaluaciones.create');

        Route::post('/citas/{cita}/evaluacion', [
            EvaluacionNutricionalController::class,
            'guardar',
        ])->whereNumber('cita')->name('evaluaciones.store');

        Route::get('/evaluaciones/{evaluacion}', [
            EvaluacionNutricionalController::class,
            'mostrar',
        ])->whereNumber('evaluacion')->name('evaluaciones.show');

        // Planes alimenticios
        Route::get('/planes', [PlanAlimenticioController::class, 'index'])
            ->name('planes.index');

        Route::get('/planes/crear', [PlanAlimenticioController::class, 'crear'])
            ->name('planes.create');

        Route::post('/planes', [PlanAlimenticioController::class, 'guardar'])
            ->name('planes.store');

        Route::get('/planes/{plan}/editar', [
            PlanAlimenticioController::class,
            'editar',
        ])->whereNumber('plan')->name('planes.edit');

        Route::put('/planes/{plan}', [
            PlanAlimenticioController::class,
            'actualizar',
        ])->whereNumber('plan')->name('planes.update');

        // Documentos clínicos
        Route::delete('/documentos/{documento}', [
            DocumentoClinicoController::class,
            'eliminar',
        ])->whereNumber('documento')->name('documentos.destroy');
    });

/*
|--------------------------------------------------------------------------
| Panel del paciente
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'rol:paciente'])
    ->prefix('paciente')
    ->name('paciente.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'paciente'])
            ->name('dashboard');

        // Citas
        Route::get('/citas', [CitaController::class, 'misCitas'])
            ->name('citas.index');

        Route::get('/citas/crear', [CitaController::class, 'crear'])
            ->name('citas.create');

        Route::post('/citas', [CitaController::class, 'guardar'])
            ->name('citas.store');

        Route::patch('/citas/{cita}/cancelar', [
            CitaController::class,
            'cancelarPaciente',
        ])->whereNumber('cita')->name('citas.cancelar');

        Route::patch('/citas/{cita}/reprogramar', [
            CitaController::class,
            'solicitarReprogramacion',
        ])->whereNumber('cita')->name('citas.reprogramar');

        // Expediente clínico
        Route::get('/expediente', [
            ExpedienteClinicoController::class,
            'mostrar',
        ])->name('expediente.show');

        Route::put('/expediente', [
            ExpedienteClinicoController::class,
            'guardar',
        ])->name('expediente.update');

        // Planes alimenticios
        Route::get('/planes', [
            PlanAlimenticioController::class,
            'misPlanes',
        ])->name('planes.index');

        Route::get('/planes/{plan}', [
            PlanAlimenticioController::class,
            'verMiPlan',
        ])->whereNumber('plan')->name('planes.show');
    });

/*
|--------------------------------------------------------------------------
| Documentos clínicos
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'rol:nutriologo,paciente'])
    ->group(function () {
        Route::post('/citas/{cita}/documentos', [
            DocumentoClinicoController::class,
            'guardar',
        ])->whereNumber('cita')->name('documentos.store');

        Route::get('/documentos/{documento}/descargar', [
            DocumentoClinicoController::class,
            'descargar',
        ])->whereNumber('documento')->name('documentos.descargar');
    });
