<?php

use Illuminate\Http\Request;


//Route::group(['middleware' => ['api.access']], function () {

    Route::get('loader', 'ApiAccessController@loader');
    Route::get('gateway', 'ApiAccessController@gateway');

    Route::post('records', 'Record\RecordCreateController@create');
    Route::get('records', 'Record\RecordShowController@show');

//});

/*
Route::get('records', 'Record\RecordController@index');
Route::get('records/{record}', 'Record\RecordShowController@show');
Route::patch('records', 'Record\RecordUpdateController@update');
Route::delete('records', 'Record\RecordDeleteController@destroy');
*/
