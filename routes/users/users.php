<?php

Route::get('user', 'User\UserController@index');
Route::get('user/{user}', 'User\UserShowController@show');
Route::post('user', 'User\UserAddController@store');
Route::patch('user', 'User\UserUpdateController@update');
Route::delete('user', 'User\UserDeleteController@destroy');
