<?php

Route::get('users', 'User\UserController@index')->name('users');
Route::get('users/{user}', 'User\UserShowController@show')->name('users_show');
Route::post('users', 'User\UserAddController@store')->name('users_store');
Route::patch('users', 'User\UserUpdateController@update')->name('users_update');
Route::delete('users/{user}', 'User\UserDeleteController@destroy')->name('users_destroy');
