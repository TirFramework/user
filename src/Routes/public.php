<?php

// Add web middleware for use Laravel feature
Route::group(['middleware' => 'web'], function () {


    Route::get('login', 'Tir\User\Controllers\AuthController@getLogin')->name('login');
    Route::post('login', 'Tir\User\Controllers\AuthController@postLogin')->name('login.post');

    Route::get('login/{provider}', 'Tir\User\Controllers\AuthController@redirectToProvider')->name('login.redirect');
    Route::get('login/{provider}/callback', 'Tir\User\Controllers\AuthController@handleProviderCallback')->name('login.callback');

    Route::get('logout', 'Tir\User\Controllers\AuthController@getLogout')->name('logout');

    Route::get('register', 'Tir\User\Controllers\AuthController@getRegister')->name('register');
    Route::post('register', 'Tir\User\Controllers\AuthController@postRegister')->name('register.post');

    Route::get('password/reset', 'Tir\User\Controllers\AuthController@getReset')->name('reset');
    Route::post('password/reset', 'Tir\User\Controllers\AuthController@postReset')->name('reset.post');
    Route::get('password/reset/{email}/{code}', 'Tir\User\Controllers\AuthController@getResetComplete')->name('reset.complete');
    Route::post('password/reset/{email}/{code}', 'Tir\User\Controllers\AuthController@postResetComplete')->name('reset.complete.post');

});