<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;

Route::get('loader', 'Api\ApiAccessController@loader');
Route::get('gateway', 'Api\ApiAccessController@gateway');

Route::post('records', 'Api\Record\RecordCreateController@create');
Route::get('records', 'Api\Record\RecordShowController@show');
Route::get('record-print', 'Api\Record\RecordPrintController@download');

