<?php


use Illuminate\Support\Facades\Route;
use Tir\User\Controllers\AdminUserController;

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'auth:api', 'prefix' => 'api/v1'], function () {

    //Add admin prefix and middleware for admin area to user module
    Route::group(['prefix' => 'admin', 'middleware' => 'IsAdmin'], function () {
        Route::resource('/user', AdminUserController::class, ['names' => 'admin.user']);
    });

});

Route::Post('api/v1/admin/login', 'Tir\User\Controllers\Auth\AdminLoginController@authenticate')->name('admin.login');

