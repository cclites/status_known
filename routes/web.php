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

Route::get('/home', 'HomeController@index')->name('home');

//Views
Route::get('dashboard', 'DashboardViewController@index');
Route::get('business', 'BusinessViewController@index');
Route::get('report', 'ReportViewController@index');

//Reports
Route::get('checks', 'Reports/ChecksReportController@index');
Route::get('businesses', 'Reports/BusinessesReportController@index');

Route::get('invoices', 'Reports/InvoicesReportController@index');

Route::get('users', 'Reports/UsersReportController@index');

Route::get('', 'ViewController@index');

Route::get('', 'ViewController@index');

Route::get('', 'ViewController@index');
