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

Route::view('/', 'home')->name('home');
Route::post('/domains', 'DomainController@store')->name('domains.store');
Route::get('/domains', 'DomainController@index')->name('domains.index');
Route::get('/domains/{id}', 'DomainController@show')->name('domain.show');
Route::post('/domains/{id}/check', 'DomainChecksController@check')->name('domain.check.store');
