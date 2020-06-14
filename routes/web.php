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

$path = base_path('routes/*');

$directories = glob( $path , GLOB_ONLYDIR);

foreach ($directories as $directory)
{
    //$baseName = basename($directory);
   // require $directory . "/" . $baseName . ".php";
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return view('test');
});

Auth::routes();


Route::get('/home', 'Views\DashboardViewController@index')->name('dashboard');

//Dashboard views
Route::get('dashboard-view', 'Views\DashboardViewController@index');
Route::get('admin-dashboard-view', 'Views\AdminDashboardViewController@index');
Route::get('business-dashboard-view', 'Views\BusinessDashboardViewController@index');

// These display vue tables with all records in a collection.
Route::get('reports-view', 'Views\ReportsViewController@index');
Route::get('records-view', 'Views\RecordsViewController@index');
Route::get('business-view', 'Views\BusinessViewController@index');
Route::get('invoices-view', 'Views\InvoicesViewController@index');
Route::get('users-view', 'Views\UsersViewController@index');
Route::get('accounts-view', 'Views\AccountsViewController@index');
Route::get('providers-view', 'Views\ProvidersViewController@index');

//show data for a single model type
Route::get('reports/{report}', 'Report\ReportShowController@show');
Route::get('records/{record}', 'Record\RecordShowController@show');

Route::get('providers/{provider}', 'Provider\ProviderShowController@show');
//Route::get('payment/{payment}', 'Payment\PaymentShowController@show');



Route::get('record-print/{record}', 'Record\RecordPrintController@download');

/** Business Settings**/
Route::patch('business-edit', 'Business\BusinessUpdateController@update')->name('business.business-update');
Route::get('business-edit/{business}', 'Business\BusinessSettingsController@show');

/***********************************************************************
 * SINGLE RESPONSIBILITY CONTROLLER ROUTES
 ***********************************************************************/

//Business
Route::get('businesses', 'Business\BusinessController@index');
Route::get('businesses/{business}', 'Business\BusinessShowController@show');
Route::post('businesses', 'Business\BusinessAddController@store');
Route::patch('businesses/{business}', 'Business\BusinessUpdateController@update');
Route::delete('businesses/{business}', 'Business\BusinessDeleteController@delete');

//Account
Route::get('accounts', 'Account\AccountController@index');
Route::get('accounts/{account}', 'Account\AccountShowController@show');
Route::post('accounts', 'Account\AccountAddController@store');
Route::patch('accounts/{account}', 'Account\AccountUpdateController@update');
Route::delete('accounts/{account}', 'Account\AccountDeleteController@delete');

//User
Route::get('users', 'User\UserController@index');
Route::get('users/{user}', 'User\UserShowController@show');
Route::post('users', 'User\UserAddController@store');
Route::patch('users/{user}', 'User\UserUpdateController@update');
Route::delete('users/{user}', 'User\UserDeleteController@delete');

//Invoice
Route::get('invoices', 'Invoice\InvoiceController@index');
Route::get('invoices/{invoice}', 'Invoice\InvoiceShowController@show');
Route::post('invoices', 'Invoice\InvoiceAddController@store');
Route::patch('invoices/{invoice}', 'Invoice\InvoiceUpdateController@update');
Route::delete('invoices/{invoice}', 'Invoice\InvoiceDeleteController@delete');

//Payment
Route::get('payments', 'Payment\PaymentController@index');
Route::get('payments/{payment}', 'Payment\PaymentShowController@show');
Route::post('payments', 'Payment\PaymentAddController@store');
Route::patch('payments/{payment}', 'Payment\PaymentUpdateController@update');
Route::delete('payments/{payment}', 'Payment\PaymentDeleteController@delete');


/***********************************************************************
 * SINGLE CONTROLLER ROUTES
 ***********************************************************************/

//Addresses
Route::get('addresses', 'Address\AddressController@index');
Route::get('addresses/{address}', 'Address\AddressController@show');
Route::post('addresses', 'Address\AddressController@create');
Route::patch('addresses/{address}', 'Address\AddressController@update');
Route::delete('addresses/{address}', 'Address\AddressController@delete');

//Phone Numbers
Route::get('phone_numbers', 'PhoneNumber\PhoneNumberController@index');
Route::get('phone_numbers/{phone_number}', 'PhoneNumber\PhoneNumberController@show');
Route::post('phone_numbers', 'PhoneNumber\PhoneNumberController@create');
Route::patch('phone_numbers/{phone_number}', 'PhoneNumber\PhoneNumberController@update');
Route::delete('phone_numbers/{phone_number}', 'PhoneNumber\PhoneNumberController@delete');
