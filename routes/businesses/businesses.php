<?php

Route::get('businesses', 'Business\BusinessController@index');
Route::get('businesses/{business}', 'Business\BusinessShowController@show');
Route::post('businesses', 'Business\BusinessAddController@store');
Route::patch('businesses', 'Business\BusinessUpdateController@update');
Route::delete('businesses', 'Business\BusinessDeleteController@destroy');
