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


    Route::group(['prefix' => 'user','namespace'=>'Tir\User\Controllers\Auth', 'middleware' => 'web'], function () {
            // Authentication Routes...
            Route::get('login', 'LoginController@showLoginForm')->name('login');
            Route::post('login', 'LoginController@authenticate')->name('authentication');
            Route::post('logout', 'LoginController@logout')->name('logout');
    
            // Registration Routes...
            Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
            Route::post('register', 'RegisterController@register');
    
            // Password Reset Routes...
            Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
            Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
            Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
            Route::post('password/reset', 'ResetPasswordController@reset');

    });

});

