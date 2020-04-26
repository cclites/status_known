<?php

Route::get('report', 'Report\ReportController@index');
Route::get('report/{report}', 'Report\ReportShowController@show');
Route::post('report', 'Report\ReportAddController@store');
Route::patch('report', 'Report\ReportUpdateController@update');
Route::delete('report', 'Report\ReportDeleteController@destroy');
