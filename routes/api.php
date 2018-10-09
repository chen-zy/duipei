<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['domain' => env('ADMIN_DOMAIN'), 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::apiResource('user', 'UserController');
        Route::apiResource('role', 'RoleController');
        Route::apiResource('permission', 'PermissionController');

        Route::post('upload', 'HomeController@upload');
    });
});

Route::get('verify-code', 'HomeController@verifyCode');