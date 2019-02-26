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

Route::get('login', [ 'as' => 'login', 'uses' => 'PageController@login']);

Route::resource('/', 'TodoController');
Route::resource('/todo', 'TodoController');

Route::post('/todo/fetchTodo', 'TodoController@fetchTodo');
Route::post('/todo/{id}/completed', 'TodoController@taskComplted');
Route::post('/register', 'AuthController@register');
Route::post('/authenticate', 'AuthController@authenticate');
Route::get('/logout', 'AuthController@logout');