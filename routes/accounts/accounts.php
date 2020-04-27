<?php

Route::get('accounts', 'Account\AccountController@index');
Route::get('accounts/{account}', 'Account\AccountShowController@show');
Route::post('accounts', 'Account\AccountAddController@store');
Route::patch('accounts', 'Account\AccountUpdateController@update');
Route::delete('accounts', 'Account\AccountDeleteController@destroy');

Route::group([
    'middleware' => ['auth', 'roles'],
    'roles' => ['business', 'admin'],
], function () {

});
