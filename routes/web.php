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

Route::get('test', ['uses' => 'TestController@index']);
Route::post('test/update/{id}', ['as' => 'test/update', 'uses' => 'TestController@update']);
Route::post('test/bulk_update', ['as' => 'test/bulk_update', 'uses' => 'TestController@bulk_update']);