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
    return view('welcome');
});

Auth::routes();


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    // Change Auth to admin
    config('auth.defaults', 'admin');

    // ======================================
    // Login Links
    // ======================================
    Route::get('/login', 'AdminAuth@loginPage');
    Route::post('login', 'AdminAuth@login')->name('admin.login');

    // ======================================
    // Forgot Password Links
    // ======================================
    Route::get('forgot/password', 'AdminAuth@forgot_password');
    Route::post('forgot/password', 'AdminAuth@forgot_password_post');
    Route::get('reset/password/{token}', 'AdminAuth@reset_password');
    Route::post('reset/password/{token}', 'AdminAuth@reset_password_final');


    Route::group(['middleware' => 'auth:admin'], function () {

        // ======================================
        // Admins table Links
        // ======================================

        Route::resource('admins', 'AdminController');
        Route::post('admins/destroy/all', 'AdminController@multi_destroy');

        // ======================================
        // Categories Links
        // ======================================

        Route::resource('categories', 'CategoryController');
        Route::post('categories/destroy/all', 'CategoryController@multi_destroy');

        // ======================================
        // News Links
        // ======================================

        Route::resource('news', 'NewsController');
        Route::post('news/destroy/all', 'NewsController@multi_destroy');

        // ======================================
        // Settings Links
        // ======================================

        Route::get('settings', 'SettingsController@view');
        Route::put('settings', 'SettingsController@saveSetting');

        // ======================================
        // Search Link
        // ======================================

        Route::get('search-results', 'SearchController@search_results')->name('search.results');

        Route::get('/', function () {

            return view('home');
        });

    });
});
