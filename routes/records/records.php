<?php

Route::get('record', 'Record\RecordController@index');
Route::get('record/{record}', 'Record\RecordShowController@show');
Route::post('record', 'Record\RecordAddController@store');
Route::patch('record', 'Record\RecordUpdateController@update');
Route::delete('record', 'Record\RecordDeleteController@destroy');
