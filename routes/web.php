<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Auth;

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

//raiz
Route::get('/','ParqueaderoController@index')->name('home');

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

//usuarios
Route::get('/usuarios', 'UserController@index')->name('user.index');
Route::get('/usuarios/crear', 'UserController@create')->name('user.create');
Route::post('/usuarios', 'UserController@store')->name('user.store');
Route::get('/usuarios/{id}/edit', 'UserController@edit')->name('user.edit');
Route::put('/usuarios/{id}', 'UserController@update')->name('user.update');
Route::delete('/usuarios/{id}', 'UserController@destroy')->name('user.destroy');

//cuenta
Route::get('/cuenta', 'CuentaController@index')->name('cuenta.index');
Route::put('/cuenta', 'CuentaController@update')->name('cuenta.update');


Route::get('/cuenta/crear', 'UserController@create')->name('user.create');
Route::get('/cuenta/{id}/edit', 'UserController@edit')->name('user.edit');
Route::post('/cuenta', 'CuentaController@store')->name('cuenta.store');
Route::delete('/cuenta/{id}', 'UserController@destroy')->name('user.destroy');


//autenticacion
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'ParqueaderoController@index')->name('home'); 

