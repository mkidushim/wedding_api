<?php

use Illuminate\Http\Request;
Use App\Song;
Route::apiResource('users', 'UserController');
Route::group(['middleware' => 'auth:api'], function() {
    Route::get('songs', 'SongController@index');
    Route::get('songs/{song}', 'SongController@show');
    Route::post('songs', 'SongController@store');
    Route::put('songs/{song}', 'SongController@update');
    Route::delete('songs/{song}', 'SongController@delete');


    Route::get('users', 'UserController@index');
    Route::get('users/{user}', 'UserController@show');
    Route::post('users', 'UserController@store');
    Route::put('users/{user}', 'UserController@update');
    Route::delete('users/{user}', 'UserController@delete');

});
Route::post('logout', 'Auth\LoginController@logout');
Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
