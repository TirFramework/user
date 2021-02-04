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

    // Route::group(['prefix' => 'user', 'middleware'=>'auth'], function () {

    //     //show view for user can select mobile or email for verification
    //     Route::get('select-mobile-or-email', function () {
    //         return view('user::auth.mobileOrEmail');
    //     })->name('select-mobile-or-email');

    //     //Verification condition for verify with mobile or email
    //     Route::Post('verification-by-mobile-or-email', 'Tir\User\Controllers\Auth\VerificationController@verificationByMobileOrEmail')->name('verificationByMobileOrEmail');

    //     //show view for enter smscode
    //     Route::get('entercode', function () {
    //         return view('user::auth.entercode');
    //     })->name('entercode');

    //     //Verification sms code
    //     Route::Post('verification-mobile', 'Tir\User\Controllers\Auth\VerificationController@verificationCode')->name('verificationCode');

    // });

});

