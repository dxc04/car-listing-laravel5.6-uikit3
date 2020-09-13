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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cars', 'CarController@index');
Route::get('carOptions', 'CarController@getCarOptions');
Route::group(['prefix' => 'cars'], function () {
    Route::post('add', 'CarController@add');
    Route::get('{car}/edit', 'CarController@edit');
    Route::post('{car}/update', 'CarController@update');
    Route::delete('{car}/delete', 'CarController@delete');
});
