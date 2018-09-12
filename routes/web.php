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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/3commas/loadDeal', 'ThreeCommasController@loadDealFrom3Commas');

    Route::get('/profit/pair', 'ProfitController@getByPair')->name('profit');
    Route::get('/profit/bot', 'ProfitController@getByBot')->name('profit');

    Route::get('/calculator/longBot', 'CalculatorController@byLongBot')->name('calculator');
    Route::get('/calculator/shortBot', 'CalculatorController@byShortBot')->name('calculator');
});