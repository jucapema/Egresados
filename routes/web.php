<?php

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
})->middleware('guest');

Auth::routes();
Route::post('/Suscribirse','SuscribirseController@store')->name('suscribirse');

Route::get('list/admins', function () {
  return DataTables::eloquent(App\User::query()->where('tipo_rol','admin'))->make(true);
});

Route::get('list/egresados', function () {
  return DataTables::of(App\User::query()->where('tipo_rol','egresado'))->make(true);
});

Route::get('list/suscritos', function () {
  return DataTables::of(App\User::query()->where('estado_cuenta','suscrita'))->make(true);
});

Route::middleware(['auth'])->group(function(){
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
  Route::get('/suscritos','EgresadoController@indexsuscrita')->name('indexsuscrita');
  Route::get('/EgresadosDarsebaja','EgresadoController@cancelar')->name('cancelar');
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('/Enviar', 'UserController@correo')->name('correo');
  Route::post('/ChangePassword/bcry', 'UserController@change_password')->name('change_password');
  Route::get('/ChangePassword', 'UserController@ChangePassword')->name('ChangePassword');
  Route::resource('Usuario','UserController');
  Route::resource('Administrador','AdminController');
  Route::resource('Egresado','EgresadoController');
  Route::resource('Mensaje','MensajeController');
  Route::get('/Mensajes/{}','MensajeController@indexmensajes')->name('indexmensajes');
    Route::get('/Contactos','EgresadoController@contactos')->name('listcontactos');
    Route::resource('Notificacion','NotificacionController');
    Route::post('/DarseBaja','EgresadoController@darsedebaja')->name('baja');
    Route::post('/Usuario/{}/state','UserController@state')->name('state');
    Route::get('/Usuarios/Inactivos','UserController@indextrash')->name('restore');
});
Route::resource('Publicacion','PostController');
Route::get('formulario', 'StorageController@index');
Route::post('formulario', 'StorageController@save')->name('subir');
Route::get('formulario', 'StorageController@load')->name('load');
