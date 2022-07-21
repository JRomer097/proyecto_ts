<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\RegistroPulserasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Principal
//Route::get('/', [PacientesController::class, 'index'])->name('pruebas.index');

//Administrar los pacientes
//.Route::get('administrar_pacientes', [PacientesController::class, 'list_paciente'])->name('pacientes.list_paciente');

//Agregar en nuevo paciente
//.Route::view('agregar_paciente','add_pacientes')->name('pacientes.add_paciente');

//Editar Pacientes
//Route::get('pacientes/editar/{pacientes}',[PacientesController::class, 'editar'])->name('pacientes.editar');

//Actualiza la informacion del paciente
//Route::get('pacientes/editar/informacion/{pacientes}', [PacientesController::class, 'update'])->name('pacientes.update');

//Ventana de gráficas
//.Route::get('pacientes/graficar/{paciente}',[PacientesController::class, 'graficar'])->name('pacientes.graficar');
//.Route::get('pacientes/graficar/fecha/{paciente}',[PacientesController::class, 'graficar_fecha'])->name('pacientes.graficar_fecha');
//Registart  un nuevo paciente
//Route::post('pacientes', [PacientesController::class, 'store'])->name('pacientes.store');

//Borrar un paciente
//Route::delete('pacientes/{pacientes}', [PacientesController::class, 'delete'])->name('pacientes.delete');

//Resource
//Route::resource('/', PacientesController::class);

/*Route::get('/', function () {
    return redirect()->route('pacientes.index');
});*/

//Route::resource('pacientes', 'App\Http\Controllers\PacientesController') -> except('show');

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('pacientes', 'App\Http\Controllers\PacientesController') -> middleware('auth') -> except('show');

/*Route::prefix('/pacientes')->name('pacientes.')->group(function() {
    Route::get('/administrar_pacientes', [PacientesController::class, 'list_paciente'])->name('list_paciente')->middleware('auth');
    Route::view('/agregar_paciente','add_pacientes')->name('add_paciente')->middleware('auth');
    Route::get('/graficar/{paciente}',[PacientesController::class, 'graficar'])->name('graficar')->middleware('auth');
    Route::get('/graficar/fecha/{paciente}',[PacientesController::class, 'graficar_fecha'])->name('graficar_fecha')->middleware('auth');
});*/
Route::middleware(['auth'])->group(function(){
    Route::prefix('/pacientes')->name('pacientes.')->group(function() {
        Route::get('/administrar_pacientes', [PacientesController::class, 'list_paciente'])->name('list_paciente');
        Route::view('/agregar_paciente','add_pacientes')->name('add_paciente');
        Route::get('/graficar/{paciente}',[PacientesController::class, 'graficar'])->name('graficar');
        Route::get('/graficar/fecha/{paciente}',[PacientesController::class, 'graficar_fecha'])->name('graficar_fecha');
    });
});
