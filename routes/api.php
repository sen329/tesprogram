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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'AuthController@authenticate');
Route::post('register', 'AuthController@register');


Route::group([
    'middleware' => 'api',
    ], function($router){
    Route::get('guestlist',"GuestlistController@index");

    Route::post('guestlist',"GuestlistController@store");

    Route::put('guestlist/{id}',"GuestlistController@update");

    Route::delete('guestlist/{id}',"GuestlistController@destroy");

    Route::post('edittable',"GuestlistController@addColumn");

    Route::post('logout', 'AuthController@logout');

    Route::get('tablecolumn', 'GuestlistController@getColumns');
});
