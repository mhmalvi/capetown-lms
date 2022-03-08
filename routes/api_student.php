<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'API\Backend\Auth', 'middleware' => 'api'], function () {

    // Route::post('signup', 'AuthController@signUp');
    Route::post('signin', 'AuthController@signIn');
    Route::post('signout', 'AuthController@signOut');
});

Route::group(['prefix' => 'student', 'namespace' => 'API\Backend\Student', 'middleware' => 'auth:sanctum'], function () {

    Route::get('course/{course}/units', 'CourseController@units');
    Route::get('course/{course}/units/completed', 'CourseController@completed_units');

    Route::get('unit/{unit}', 'UnitController@topics');
    Route::get('unit/{unit}/topics/completed', 'UnitController@completedTopics');
    Route::post('unit/{unit}/topics/{topic}/submit', 'UnitController@submitTopic');
});
