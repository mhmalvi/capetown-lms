<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'API\Backend\Auth', 'middleware' => 'api'], function () {

    // Route::post('signup', 'AuthController@signUp');
    Route::post('login', 'AuthController@signIn');
    Route::post('signout', 'AuthController@signOut');
});
