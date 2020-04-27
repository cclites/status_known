<?php

Route::get('invoices', 'Invoice\InvoiceController@index');
Route::get('invoices/{invoice}', 'Invoice\InvoiceShowController@show');
Route::post('invoices', 'Invoice\InvoiceAddController@store');
Route::patch('invoices', 'Invoice\InvoiceUpdateController@update');
Route::delete('invoices', 'Invoice\InvoiceDeleteController@destroy');
