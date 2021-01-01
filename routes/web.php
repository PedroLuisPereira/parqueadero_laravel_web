<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;

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

//login
Route::get('/', function () {
    return view('login');
});



//clientes
Route::get('/clientes', [ClienteController::class, 'index'])->name('cliente.index');
Route::get('/clientes/crear', [ClienteController::class, 'create'])->name('cliente.create');
Route::get('/clientes/buscar/{valor}', [ClienteController::class, 'buscar'])->name('cliente.buscar');
Route::post('/clientes', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])->name('cliente.show');
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

//vehiculos
//Route::resource('/vehiculos', 'VehiculoController');
Route::get('/vehiculos', 'VehiculoController@index')->name('vehiculo.index');
Route::get('/vehiculos/crear/{id}', 'VehiculoController@create')->name('vehiculo.create');
Route::get('/vehiculos/listar/{id}', 'VehiculoController@listar_cliente_id')->name('vehiculo.listar');
Route::post('/vehiculos', 'VehiculoController@store')->name('vehiculo.store');
Route::get('/vehiculos/{vehiculo}', 'VehiculoController@show')->name('vehiculo.show');
Route::get('/vehiculos/{id}/edit', 'VehiculoController@edit')->name('vehiculo.edit');
Route::put('/vehiculos/{id}', 'VehiculoController@update')->name('vehiculo.update');
Route::delete('/vehiculos/{id}', 'VehiculoController@destroy')->name('vehiculo.destroy');

//servicios
Route::get('/servicios', 'ServicioController@index')->name('servicio.index');

//tarifas
Route::get('/tarifas', 'TarifasController@index')->name('tarifa.index');
Route::post('/tarifas', 'TarifasController@store')->name('tarifa.store');

//parqueaderos
Route::get('/parqueaderos', 'ParqueaderoController@index')->name('parqueadero.index');
Route::post('/parqueaderos', 'ParqueaderoController@store')->name('parqueadero.store');
Route::put('/parqueaderos', 'ParqueaderoController@update')->name('parqueadero.update');
Route::get('/parqueaderos/{placa}', 'ParqueaderoController@consultar')->name('parqueadero.consultar');
Route::get('/parqueadero/{id}', 'ParqueaderoController@mover')->name('parqueadero.mover');
Route::delete('/parqueaderos/{id}', 'ParqueaderoController@destroy')->name('parqueadero.destroy');
