<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormularioController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//usuarios
Route::get('admin/usuarios', [HomeController::class,'usuariosView'])->name('listadoUsuarios');
Route::get('admin/settings', [HomeController::class,'userSetting'])->name('userSetting');

Route::post('user/{id}', [UserController::class, 'updateData'])->name('userUpdate');

Route::post('admin/user/store', [UserController::class, 'store'])->name('admin.usuarios.store');

Route::post('admin/user/update/{id}', [UserController::class, 'update'])->name('admin.usuarios.update');

Route::get('admin/user/{id}', [UserController::class, 'get'])->name('admin.usuarios.get');


Route::get('admin/regiones', [HomeController::class, 'getRegiones'])->name('admin.regiones.get');





Route::get('/get-users-data', [UserController::class, 'listUsers']);

Route::delete('/user-delete/{id}', [UserController::class, 'eliminarUser']);

//formularios
Route::resource('admin/formularios', FormularioController::class);

