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

/*Route::get('/', function () {
    return view('welcome');
});*/



Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//----------------LOGIN
Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('loginshow');


//----------------INDEX
Route::get('/index', 'IndexController@index')->name('index');
Route::post('/event-add', 'IndexController@store')->name('event-add');
Route::get('/get-events', 'IndexController@getEvents')->name('get-events');
Route::get('/event/{id}/edit', 'IndexController@edit')->name('event.edit');
Route::match(['PUT', 'DELETE'], '/event/{id}', 'IndexController@updateOrDelete')->name('event.updateOrDelete');
//Route::put('/event/{id}/update', 'IndexController@update')->name('event.update');
//Route::delete('/event/{id}', 'IndexController@destroy')->name('event.delete');

//--------------USERS
Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::post('/users', 'UserController@store')->name('users.store');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('/users/{user}', 'UserController@update')->name('users.update');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');


//----------------EVENTS
Route::get('/event-types', 'EventTypeController@index')->name('event-types');
Route::get('/event-types/create', 'EventTypeController@create')->name('event-types.create');
Route::post('/event-types', 'EventTypeController@store')->name('event-types.store');
Route::get('/event-types/{event_type}/edit', 'EventTypeController@edit')->name('event-types.edit');
Route::put('/event-types/{event_type}', 'EventTypeController@update')->name('event-types.update');
Route::delete('/event-types/{event_type}', 'EventTypeController@destroy')->name('event-types.destroy');


