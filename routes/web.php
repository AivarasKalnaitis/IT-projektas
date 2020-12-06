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


Route::post('user/profile', function () { // Validate the request...

    return back()->withInput(); });

Route::get('/', 'InsurancePlanController@index')->name('home');
Route::get('/home', 'InsurancePlanController@index');

Route::resource('/insurance-plans','InsurancePlanController', ['except' => ['index']]);

Route::resource('/insurances', 'OrderedInsuranceController', ['only' => ['index','store','destroy', 'show']]);

Route::get('/insurances/approve/{id}', 'OrderedInsuranceController@approve')->name('approve');

Route::get('reports', 'ReportController@index')->name('reports');

Route::post('reports/generated', 'ReportController@generate')->name('reports.generate');

Route::get('/insurance-plans/extend/{id}', 'OrderedInsuranceController@extend')->name('insurance-plans.extend');

Route::get('/summary', 'InsurancePlanController@summary')->name('insurance-plans.summary');


Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('history', 'HistoryController@index')->name('history');
Route::get('history/{id}', 'HistoryController@show')->name('history.show');;
