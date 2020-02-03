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

 
Route::prefix('auth')->group(function(){
    Route::post('login', 'Api\AuthController@login');
});

 Route::middleware('auth:api')->group( function () {
    Route::get('logout', 'Api\AuthController@logout');

    Route::prefix('user')->group(function(){
        Route::get('index', 'Users\UserController@index');
        Route::get('show', 'Users\UserController@show');
        Route::post('update', 'Users\UserController@update');
        Route::post('store', 'Users\UserController@store');
    });

    Route::prefix('branch')->group(function(){
        Route::get('index', 'Branches\BranchController@index');
        Route::get('show', 'Branches\BranchController@show');
        Route::post('update', 'Branches\BranchController@update');
        Route::post('store', 'Branches\BranchController@store');
    });

    Route::prefix('role')->group(function(){
        Route::get('index', 'Roles\RoleController@index');
        Route::get('show', 'Roles\RoleController@show');
        Route::post('update', 'Roles\RoleController@update');
        Route::post('store', 'Roles\RoleController@store');
    });
}); 
