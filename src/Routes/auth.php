<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {

    //admin login form
    Route::get('/admin/login', 'Tir\User\Controllers\AdminAuth\AdminLoginController@showAdminLoginForm')->name('adminLogin');

    Route::post('/admin/login', 'Tir\User\Controllers\AdminAuth\AdminLoginController@authentication')->name('authentication');

    //TODO::change to post method
    Route::get('/user/logout', 'Tir\User\Controllers\AdminAuth\AdminLogoutController@logout')->name('logout');

});

