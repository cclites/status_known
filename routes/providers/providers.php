<?php

Route::get('providers', 'Provider\ProviderController@index');
Route::get('providers/{provider}', 'Provider\ProviderShowController@show');
Route::post('providers', 'Provider\ProviderAddController@store');
Route::patch('providers', 'Provider\ProviderUpdateController@update');
Route::delete('providers', 'Provider\ProviderDeleteController@destroy');
