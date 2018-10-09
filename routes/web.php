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

Route::group(['domain' => env('ADMIN_DOMAIN'), 'namespace' => 'Admin', 'as' => 'admin.'], function () {
    Route::get('login', 'HomeController@showLoginForm')->name('login');
    Route::post('login', 'HomeController@login');
    Route::get('logout', 'HomeController@logout')->name('logout');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', 'HomeController@index')->name('home');
        Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
        Route::resource('user', 'UserController');
        Route::resource('role', 'RoleController');
        Route::resource('permission', 'PermissionController');

        Route::get('demo/form', 'DemoController@form');
    });
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
