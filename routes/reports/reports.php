<?php

Route::get('reports', 'Report\ReportController@index');
Route::get('reports/{report}', 'Report\ReportShowController@show');
Route::post('reports', 'Report\ReportAddController@store');
Route::patch('reports', 'Report\ReportUpdateController@update');
Route::delete('reports', 'Report\ReportDeleteController@destroy');
