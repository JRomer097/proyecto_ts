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
Route::get('administrar_pacientes', [PacientesController::class, 'index'])->name('pacientes.index');

//Editar Pacientes
Route::get('pacientes/editar/{pacientes}',[PacientesController::class, 'editar'])->name('pacientes.editar');

//Actualiza la informacion del paciente
Route::get('pacientes/editar/informacion/{pacientes}', [PacientesController::class, 'update'])->name('pacientes.update');

//Ventana de gráficas
Route::get('pacientes/graficar/{pacientes}',[PacientesController::class, 'graficar'])->name('grafica.graficar');
Route::get('pacientes/graficar/fecha/{pacientes}',[PacientesController::class, 'graficar_fecha'])->name('grafica.graficar_fecha');

//Guardar un nuevo paciente
Route::post('pacientes', [PacientesController::class, 'store'])->name('pacientes.store');

//Borrar un paciente
Route::delete('pacientes/{pacientes}', [PacientesController::class, 'delete'])->name('pacientes.delete');

//Resource
//Route::resource('/', PacientesController::class);
//prubeas
Route::get('vista', [RegistroPulserasController::class, 'vista']);
//Route::view('pruebas', 'prueba');
Route::get('/', [PacientesController::class, 'paciente'])->name('pruebas.paciente');

/*
Route::get('eloquen', function(){
    $posts = Post::where('id','>=','20')
    ->orderBy('id','desc')
    ->take(3)
    ->get();
    foreach($posts as $post){
        echo "$post->id $post->title <br>";
    }
});*/