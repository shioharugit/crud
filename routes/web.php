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
    return redirect()->route('user.list');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('list', 'UserController@list')->name('list');
    Route::prefix('register')->name('register.')->group(function () {
        Route::get('', 'UserController@register')->name('index');
        Route::post('', 'UserController@register')->name('index');
        Route::get('confirm', function () {
            return redirect()->route('user.list');
        });
        Route::post('confirm', 'UserController@registerConfirm')->name('confirm');
        Route::get('complete', function () {
            return redirect()->route('user.list');
        });
        Route::post('complete', 'UserController@registerComplete')->name('complete');
    });
});

Route::prefix('csv')->name('csv.')->group(function () {
    Route::get('', 'CsvController@index')->name('index');
    Route::prefix('import')->name('import')->group(function () {
        Route::get('', function () {
            return redirect()->route('csv.index');
        });
        Route::post('', 'CsvController@import');
    });
    Route::prefix('download')->name('download')->group(function () {
        Route::get('', function () {
            return redirect()->route('csv.index');
        });
        Route::post('', 'CsvController@download');
    });
});

