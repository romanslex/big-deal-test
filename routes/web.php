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

Route::get('/data/planets', 'PlanetController@index');
Route::get('/data/planets/{id}', 'PlanetController@getPlanetData');

Route::get('{any}', 'SpaController@index')->where('any', '.*');
