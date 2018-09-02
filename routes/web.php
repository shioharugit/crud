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

Route::get('/', function () {
    return redirect()->route('user');
});
Route::get('user', 'UserController@index')->name('user');

Route::prefix('csv')->name('csv.')->group(function () {
    Route::get('', 'CsvController@index')->name('index');
    Route::prefix('import')->name('import')->group(function () {
        Route::get('', function () {
            return redirect()->route('csv.index');
        });
        Route::post('', 'CsvController@import');
    });
});

