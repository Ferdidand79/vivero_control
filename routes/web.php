<?php

use Illuminate\Support\Facades\Route;

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
    return redirect()->route('home');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('/dashboard','HomeController@index')->name('home');
    Route::resource('/parametros','ParametroController');
    Route::resource('/plantas','PlantaController');
    Route::resource('/plagas','PlagaController');
    Route::resource('/vincular','VincularParametrosController');
    Route::resource('/muestras','MuestraController');
    Route::get('get-parametros','ParametroController@getParametros');
    Route::get('get-plagas','PlagaController@getPlagas');
    Route::prefix('elemento')->group(function () {
        Route::get('/muestra/{id}','ElementoController@index')->name('elemento.index');
        Route::get('/{id}/muestra','ElementoController@show')->name('elemento.show');
        Route::get('/{id}/image','ElementoController@showImages')->name('elemento.image');
        Route::get('/muestra/{id}/create','ElementoController@create')->name('elemento.create');
        Route::post('/muestra/{id}/store','ElementoController@store')->name('elemento.store');
        Route::get('/muestra/{id}/edit/{elemento_id}','ElementoController@edit')->name('elemento.edit');
        Route::put('/muestra/{id}/update/{elemento_id}','ElementoController@update')->name('elemento.update');
        Route::delete('/muestra/{id}/delete/{elemento_id}','ElementoController@destroy')->name('elemento.destroy');
        // Imagenes
        Route::get('/{id}/show-images','ImageController@index')->name('elemento.show-images');
        Route::get('/{id}/image/create','ImageController@create')->name('elemento.image.create');
        Route::post('/{id}/image/store','ImageController@store')->name('elemento.image.store');
        Route::delete('/image/destroy/{image_id}','ImageController@destroy')->name('elemento.image.destroy');
    });

});
