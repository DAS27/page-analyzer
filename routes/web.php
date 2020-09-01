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

Route::view('/', 'home')->name('domain.index');

Route::get('/domains', function () {
    return view('domains');
})->name('domains.store');

Route::get('/domains/{id}', function ($id) {
    return view('domains');
})->name('domain.show');

Route::post('/domains', 'DomainController@check')->name('domain.create');
