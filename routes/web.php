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

// ROOT
Route::get('/', function () {
    return redirect()->route('login');
});

// ログイン機能
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

/*
// パスワードリセット機能
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
*/

// ログインが必要な機能
Route::middleware('auth')->group(function() {
    // ログアウト機能
    Route::get('logout', 'Auth\LogoutController@logout')->name('logout');
    Route::post('logout', 'Auth\LoginController@logout');

    // User機能
    Route::prefix('user')->name('user.')->group(function () {
        // 一覧
        Route::get('list', 'UserController@list')->name('list');
        // 登録機能
        Route::prefix('register')->name('register.')->middleware('can:admin-higher')->group(function () {
            // 登録
            Route::get('', 'UserController@register')->name('index');
            // 確認
            Route::get('confirm', function () {
                return redirect()->route('user.list');
            });
            Route::post('confirm', 'UserController@registerConfirm')->name('confirm');
            // 完了
            Route::get('complete', function () {
                return redirect()->route('user.list');
            });
            Route::post('complete', 'UserController@registerComplete')->name('complete');
        });
        // 詳細
        Route::get('detail/{id}', 'UserController@detail')->name('detail');
        // 編集機能
        Route::prefix('edit')->name('edit.')->middleware('can:admin-higher')->group(function () {
            // 編集
            Route::get('{id}', 'UserController@edit')->name('index');
            // 確認
            Route::get('confirm', function () {
                return redirect()->route('user.list');
            });
            Route::post('confirm', 'UserController@editConfirm')->name('confirm');
            // 完了
            Route::get('complete', function () {
                return redirect()->route('user.list');
            });
            Route::post('complete', 'UserController@editComplete')->name('complete');
        });
    });

    // CSV機能
    Route::prefix('csv')->name('csv.')->middleware('can:systemadmin-only')->group(function () {
        // CSV機能画面
        Route::get('', 'CsvController@index')->name('index');
        // import
        Route::prefix('import')->name('import')->group(function () {
            Route::get('', function () {
                return redirect()->route('csv.index');
            });
            Route::post('', 'CsvController@import');
        });
        // download
        Route::prefix('download')->name('download')->group(function () {
            Route::get('', function () {
                return redirect()->route('csv.index');
            });
            Route::post('', 'CsvController@download');
        });
    });
});
