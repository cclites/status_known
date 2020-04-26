<?php

Route::get('provider', 'Provider\ProviderController@index');
Route::get('provider/{provider}', 'Provider\ProviderShowController@show');
Route::post('provider', 'Provider\ProviderAddController@store');
Route::patch('provider', 'Provider\ProviderUpdateController@update');
Route::delete('provider', 'Provider\ProviderDeleteController@destroy');
