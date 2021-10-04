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
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/apikey', 'ApiKeyController@index');
    Route::get('/apikey/create', 'ApiKeyController@create');
    Route::post('/apikey/store', 'ApiKeyController@store')->name('apikey/store');

    Route::get('/3commas/loadDeal', 'ThreeCommasController@loadDealFrom3Commas')->name('3commas/loadDeal');
    Route::get('/3commas/loadBots', 'ThreeCommasController@loadBotsFrom3Commas')->name('3commas/loadBots');

    Route::get('/profit/pair', 'ProfitController@getByPair');
    Route::get('/profit/bot', 'ProfitController@getByBot');

    Route::get('/calculator/longBot/spreadsheet', 'CalculatorController@spreadsheetByLongBot');
    Route::get('/calculator/shortBot/spreadsheet', 'CalculatorController@spreadsheetByShortBot');
});