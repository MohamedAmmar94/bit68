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
Route::post('login', 'API\UserController@login');
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::get('{any}', 'API\UserController@nologin')->where('any', '.*');
Route::get('/', 'API\UserController@nologin');


/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::middleware('apiToken')->group(function () {
	Route::post('getweather', 'API\UserController@getweather');
});