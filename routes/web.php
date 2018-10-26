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

Route::get('/', ['as' => 'links.index', 'uses' => 'LinkController@create']);
Route::post('/store', ['as' => 'links.store', 'uses' => 'LinkController@store']);
Route::get('/show/{link}', ['as' => 'links.show', 'uses' => 'LinkController@show']);
Route::get('/{link}', ['as' => 'links.redirect', 'uses' => 'LinkController@redirect']);


