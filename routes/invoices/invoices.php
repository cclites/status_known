<?php

Route::get('invoice', 'Invoice\InvoiceController@index');
Route::get('invoice/{invoice}', 'Invoice\InvoiceShowController@show');
Route::post('invoice', 'Invoice\InvoiceAddController@store');
Route::patch('invoice', 'Invoice\InvoiceUpdateController@update');
Route::delete('invoice', 'Invoice\InvoiceDeleteController@destroy');
