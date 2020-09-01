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
    return view('home');
})->name('home');

//Route::view('/', 'home')->name('home');

Route::get('/domains', function () {
    return view('domains');
})->name('domains');

Route::post('/domains', 'DomainController@check')->name('domains.show');
//Route::post('/domains', function () {
//    return dd(Request::all());
//})->name('domains.show');
