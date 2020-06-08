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

//Calls controllers to add dashboard views
Route::get('dashboard-view', 'Views\DashboardViewController@index');
Route::get('admin-dashboard-view', 'Views\AdminDashboardViewController@index');
Route::get('business-dashboard-view', 'Views\BusinessDashboardViewController@index');

// Requests to display vue table with all() types of a model.
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
Route::get('businesses/{business}', 'Business\BusinessShowController@show');
Route::get('invoices/{invoice}', 'Invoice\InvoiceShowController@show');
Route::get('users/{user}', 'User\UserShowController@show');
Route::get('accounts/{account}', 'Account\AccountShowController@show');
Route::get('providers/{provider}', 'Provider\ProviderShowController@show');
Route::get('payment/{payment}', 'Payment\PaymentShowController@show');

//Reports (No reports yet - ignore these routes for now
//These routes are called when user decides to print a report
//Route::get('businesses-report', 'Reports\BusinessesReportController@index');
//Route::get('invoices-report', 'Reports\InvoicesReportController@index');
//Route::get('users-report', 'Reports\UsersReportController@index');
//Route::get('reports-report', 'Reports\ReportsReportController@index');

Route::get('business-edit/{business}', 'Business\BusinessSettingsController@show');

Route::get('record-print/{record}', 'Record\RecordPrintController@download');

/** Business Settings**/
Route::put('business', 'Business/BusinessUpdateController@update')->name('business.business-update');

/*
Route::get('settings-businesss', 'Business/SettingsController@index')->name('business.settings_business');
Route::get('settings-businesss/{settings}', 'Business/SettingsController@index')->name('business.settings_business');
Route::post('settings-businesss', 'Business/SettingsController@create')->name('business.settings_business_create');
Route::patch('settings-businesss/{settings}', 'Business/SettingsController@update')->name('business.settings_business_update');
Route::delete('settings-businesss/{settings}', 'Business/SettingsController@delete')->name('business.settings_business_delete');
*/


//Route::get('api/loader', 'ApiAccessController@loader');


//Route::post('api/records', 'Record\RecordCreateController@create');
