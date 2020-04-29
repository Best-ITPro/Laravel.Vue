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
    return view('welcome');
});

Route::get('/start', 'StartController@index')->name('start');

Route::get('/start/get-json', 'StartController@getJson')->name('start_json');

Route::get('/start/data-chart', 'StartController@chartData')->name('start_chart');

Route::get('/start/random-chart', 'StartController@chartRandom')->name('start_chart');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
