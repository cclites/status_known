<?php

Route::get('records', 'Record\RecordController@index');
Route::get('records/{record}', 'Record\RecordShowController@show');
Route::post('records', 'Record\RecordAddController@store');
Route::patch('records', 'Record\RecordUpdateController@update');
Route::delete('records', 'Record\RecordDeleteController@destroy');
