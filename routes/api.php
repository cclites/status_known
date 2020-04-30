<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['api.access']], function () {

    Route::get('loader', 'ApiAccessController@loader');
    Route::get('gateway', 'ApiAccessController@gateway');
    Route::post('request-record', 'Record\RecordCreateController@create');

});
