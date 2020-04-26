<?php

Route::get('account', 'Account\AccountController@index');
Route::get('account/{account}', 'Account\AccountShowController@show');
Route::post('account', 'Account\AccountAddController@store');
Route::patch('account', 'Account\AccountUpdateController@update');
Route::delete('account', 'Account\AccountDeleteController@destroy');
