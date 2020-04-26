<?php

Route::get('business', 'Business\BusinessController@index');
Route::get('business/{business}', 'Business\BusinessShowController@show');
Route::post('business', 'Business\BusinessAddController@store');
Route::patch('business', 'Business\BusinessUpdateController@update');
Route::delete('business', 'Business\BusinessDeleteController@destroy');
