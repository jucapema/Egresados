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
})->name('inicio')->middleware('guest');

Auth::routes();
Route::post('/Suscribirse','SuscribirseController@store')->name('suscribirse');

Route::middleware(['auth'])->group(function(){
  Route::get('/home', 'HomeController@index')->name('home');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
  Route::resource('Acceso','AccesoController',['only'=> 'index']);
  Route::resource('Administrador','AdminController',['only'=> ['index','create','store']]);
  Route::get('/Egresado/Solicitud/Elimininado','AdminController@borrarcuenta')->name('borrar');
  Route::resource('Egresado','EgresadoController',['only'=> ['index','store','destroy']]);
  Route::get('/suscritos','EgresadoController@indexsuscrita')->name('indexsuscrita');
  Route::get('/EgresadosDarsebaja','EgresadoController@cancelar')->name('cancelar');
  Route::get('/DarseBaja','EgresadoController@darsedebaja')->name('baja');
  Route::get('/Contactos','EgresadoController@contactos')->name('listcontactos');
  Route::get('/change/state','EgresadoController@cambiarvalor')->name('bannear');
  Route::resource('Favorito','FavoritoController',['only'=> 'index']);
  route::get('/del/contacto','FavoritoController@eliminaramigo')->name('eliminaramigo');
  Route::resource('Mensaje','MensajeController',['only'=> ['index','create','store','destroy']]);
  Route::resource('Notificacion','NotificacionController',['only'=> ['index','destroy']]);
  Route::resource('Publicacion','PostController',['only'=> ['index','store','update','destroy']]);
  Route::get('/posts','PostController@listposts')->name('posts');
  Route::post('formulario', 'StorageController@save')->name('subir');
  Route::get('formulario', 'StorageController@load')->name('load');
  Route::resource('Usuario','UserController',['only'=> ['update','destroy']]);
  Route::get('/Usuarios/Inactivos','UserController@indextrash')->name('listrestore');
  Route::get('/UsuarioRestore/{id}','UserController@restore')->name('restore');
  Route::post('/ChangePassword/bcry', 'UserController@change_password')->name('change_password');
  Route::get('/ChangePassword', 'UserController@ChangePassword')->name('ChangePassword');
  Route::get('/add/contacto','UserController@agregar')->name('agregar');
  Route::get('/Enviar', 'UserController@correo')->name('correo');
});
