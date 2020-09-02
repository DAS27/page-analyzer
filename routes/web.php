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

Route::get('/', 'DomainController@index')->name('domain.index');
Route::get('/domains', 'DomainController@store')->name('domains.store');
Route::get('/domains/{domain}', 'DomainController@show')->name('domain.show');
Route::post('/domains', 'DomainController@check')->name('domain.create');
