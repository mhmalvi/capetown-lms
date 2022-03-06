<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Backend\Admin'], function () {

    Route::get('/admin', 'HomeController@index');

    // this was added because without route['login'], application used to throw error
    Route::get('/admin/login', 'HomeController@index')->name('login');

    Route::get('/admin/{path}', 'HomeController@index')->where('path', '([A-z\d\-\/_.]+)?');
});
