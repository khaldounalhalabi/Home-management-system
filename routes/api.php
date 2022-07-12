<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsumptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use GuzzleHttp\Middleware;


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

/** Electricity API */

Route::namespace('App\Http\Controllers')->group(function () {

    Route::get('/consumption/index', 'ConsumptionController@index')->middleware('auth:api');


    // Auth API
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/user_details', 'AuthController@user_details');


    //Sensor API
    Route::post('/sensor/allowed_consumption', 'SensorController@set_allowed_consumption')->middleware('auth:api');
    Route::post('/sensor/allowed_consumption_coast', 'SensorController@set_allowed_consumption_coast')->middleware('auth:api');
    Route::post('/sensor/sensor_status', 'SensorController@sensor_status')->middleware('auth:api');
    Route::post('/sensor/set_cut_time', 'SensorController@set_cut_time')->middleware('auth:api');
    Route::post('/sensor/set_peak_time', 'SensorController@set_peak_time')->middleware('auth:api');


    //Interrupter API
    Route::get('/interrupter/index', 'InterrupterController@index')->middleware('auth:api');
    Route::post('/interrupter/store', 'InterrupterController@store')->middleware('auth:api');
    Route::post('/interrupter/update/{id}', 'InterrupterController@update')->middleware('auth:api');
    Route::get('/interrupter/show/{id}', 'InterrupterController@show')->middleware('auth:api');
    Route::delete('/interrupter/delete/{id}', 'InterrupterController@destroy')->middleware('auth:api');
    Route::post('/interrupter/on_off/{id}', 'InterrupterController@on_of')->middleware('auth:api');
});



/** Water API */

Route::get('water/consumption/index' , 'App\Http\Controllers\water\WaterConsumptionController@index') ->middleware('auth:api');


