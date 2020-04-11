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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

  Route::get('users', 'UserController@index');
  Route::post('users', 'UserController@create');
  Route::post('users/bulk', 'UserController@bulk');
  Route::get('users/{id}', 'UserController@show');
  Route::patch('users/{id}', 'UserController@update');
  Route::delete('users/{id}', 'UserController@delete');

  Route::get('promos', 'PromoController@index');
  Route::post('promos', 'PromoController@create');
  Route::post('promos/bulk', 'PromoController@bulk');
  Route::get('promos/{id}', 'PromoController@show');
  Route::patch('promos/{id}', 'PromoController@update');
  Route::delete('promos/{id}', 'PromoController@delete');

  Route::get('features', 'FeatureController@index');
  Route::post('features', 'FeatureController@create');
  Route::post('features/bulk', 'FeatureController@bulk');
  Route::get('features/{id}', 'FeatureController@show');
  Route::patch('features/{id}', 'FeatureController@update');
  Route::delete('features/{id}', 'FeatureController@delete');