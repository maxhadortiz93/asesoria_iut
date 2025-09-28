<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BienController;
use App\Http\Controllers\DependenciaController;
use App\Http\Controllers\HistorialMovimientoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\OrganismoController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UnidadAdministradoraController;

Route::resource('unidades', UnidadAdministradoraController::class);
Route::resource('bienes', BienController::class);
Route::resource('dependencias', DependenciaController::class);
Route::resource('historial-movimientos', HistorialMovimientoController::class);
Route::resource('movimientos', MovimientoController::class);
Route::resource('organismos', OrganismoController::class);
Route::resource('reportes', ReporteController::class);
Route::resource('responsables', ResponsableController::class);
Route::resource('usuarios', UsuarioController::class);

Route::get('/', function () {
    return view('welcome');
});


