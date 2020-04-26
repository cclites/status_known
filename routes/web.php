<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*
$path = base_path('routes/*');

$directories = glob( $path , GLOB_ONLYDIR);

foreach ($directories as $directory)
{
    $baseName = basename($directory);

    require_once $directory . "/" . $baseName . ".php";
}*/

Route::get('/', function () {
    return view('welcome');
});


/*
Route::get('account', 'Account/AccountController@index');
Route::get('account/{account}', 'Account/AccountShowController@show');
Route::post('account', 'Account/AccountAddController@store');
Route::patch('account', 'Account/AccountUpdateController@update');
Route::delete('account', 'Account/AccountDeleteController@destroy');
*/

/*
Route::get('business', 'Business/BusinessController@index');
Route::get('business/{business}', 'Business/BusinessShowController@show');
Route::post('business', 'Business/BusinessAddController@store');
Route::patch('business', 'Business/BusinessUpdateController@update');
Route::delete('business', 'Business/BusinessDeleteController@destroy');
*/

/*
Route::get('invoice', 'Invoice/InvoiceController@index');
Route::get('invoice/{invoice}', 'Invoice/InvoiceShowController@show');
Route::post('invoice', 'Invoice/InvoiceAddController@store');
Route::patch('invoice', 'Invoice/InvoiceUpdateController@update');
Route::delete('invoice', 'Invoice/InvoiceDeleteController@destroy');
*/

/*
Route::get('payment', 'Payment/PaymentController@index');
Route::get('payment/{payment}', 'Payment/PaymentShowController@show');
Route::post('payment', 'Payment/PaymentAddController@store');
Route::patch('payment', 'Payment/PaymentUpdateController@update');
Route::delete('payment', 'Payment/PaymentDeleteController@destroy');
*/

/*
Route::get('provider', 'Provider/ProviderController@index');
Route::get('provider/{provider}', 'Provider/ProviderShowController@show');
Route::post('provider', 'Provider/ProviderAddController@store');
Route::patch('provider', 'Provider/ProviderUpdateController@update');
Route::delete('provider', 'Provider/ProviderDeleteController@destroy');
*/

/*
Route::get('record', 'Record/RecordController@index');
Route::get('record/{record}', 'Record/RecordShowController@show');
Route::post('record', 'Record/RecordAddController@store');
Route::patch('record', 'Record/RecordUpdateController@update');
Route::delete('record', 'Record/RecordDeleteController@destroy');
*/

/*
Route::get('report', 'Report/ReportController@index');
Route::get('report/{report}', 'Report/ReportShowController@show');
Route::post('report', 'Report/ReportAddController@store');
Route::patch('report', 'Report/ReportUpdateController@update');
Route::delete('report', 'Report/ReportDeleteController@destroy');
*/

/*
Route::get('user', 'User/UserController@index');
Route::get('user/{user}', 'User/UserShowController@show');
Route::post('user', 'User/UserAddController@store');
Route::patch('user', 'User/UserUpdateController@update');
Route::delete('user', 'User/UserDeleteController@destroy');
*/

Route::get('users', 'User\UserController@index')->name('users');
Route::get('users/{user}', 'User\UserShowController@show')->name('users_show');
Route::post('users', 'User\UserAddController@store')->name('users_store');
Route::patch('users', 'User\UserUpdateController@update')->name('users_update');
Route::delete('users/{user}', 'User\UserDeleteController@destroy')->name('users_destroy');
