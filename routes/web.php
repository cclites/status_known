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
    $baseName = basename($directory);
    require $directory . "/" . $baseName . ".php";
}

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return view('test');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'Views\DashboardViewController@index')->name('dashboard');

//Views
Route::get('dashboard-view', 'Views\DashboardViewController@index');
Route::get('admin-dashboard-view', 'Views\AdminDashboardViewController@index');
Route::get('business-dashboard-view', 'Views\BusinessDashboardViewController@index');
Route::get('checks-view', 'Views\ChecksViewController@index');
Route::get('business-view', 'Views\BusinessViewController@index');
Route::get('invoices-view', 'Views\InvoicesViewController@index');
Route::get('users-view', 'Views\UsersViewController@index');
Route::get('accounts', 'Views\AccountsViewController@index');

//Reports
Route::get('checks-report', 'Reports\ChecksReportController@index');
Route::get('businesses-report', 'Reports\BusinessesReportController@index');
Route::get('invoices-report', 'Reports\InvoicesReportController@index');
Route::get('users-report', 'Reports\UsersReportController@index');

Route::get('reports', 'Views\ReportsViewController@index');
