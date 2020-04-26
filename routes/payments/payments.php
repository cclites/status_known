<?php

Route::get('payment', 'Payment\PaymentController@index');
Route::get('payment/{payment}', 'Payment\PaymentShowController@show');
Route::post('payment', 'Payment\PaymentAddController@store');
Route::patch('payment', 'Payment\PaymentUpdateController@update');
Route::delete('payment', 'Payment\PaymentDeleteController@destroy');
