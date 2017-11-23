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
});

Route::get('list/admins', function () {
    return DataTables::eloquent(App\User::query())->make(true);
});


Auth::routes();
Route::post('/Suscribirse','SuscribirseController@store')->name('suscribirse');
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware(['auth'])->group(function(){
    Route::get('/Enviar', 'UserController@correo')->name('correo');
    Route::resource('Usuario','UserController');
    Route::resource('Administrador','AdminController');
    Route::resource('Egresado','EgresadoController');
    Route::resource('Mensaje','MensajeController');
    Route::get('/Mensajes/{}','MensajeController@indexmensajes')->name('indexmensajes');
    Route::resource('Publicacion','PublicacionController');
    Route::resource('Notificacion','NotificacionController');
});
