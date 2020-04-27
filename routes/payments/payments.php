<?php

Route::get('payments', 'Payment\PaymentController@index');
Route::get('payments/{payment}', 'Payment\PaymentShowController@show');
Route::post('payments', 'Payment\PaymentAddController@store');
Route::patch('payments', 'Payment\PaymentUpdateController@update');
Route::delete('payments', 'Payment\PaymentDeleteController@destroy');
