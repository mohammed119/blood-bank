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

Route::get('/', function () {
    return view('layouts.app');
});
Route::get('dash-board', function () {
    return view('home');
});



   


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::resource('governorate', 'GovernorateController');
Route::resource('city', 'CityController');
Route::resource('category', 'CategoryController');
Route::resource('post', 'PostController');
Route::resource('client', 'ClientController');
Route::resource('contact-detail', 'ContactDetailController');
Route::resource('order', 'OrderController');

Route::resource('message', 'MessageController');
Route::get('client/{id}/activate', 'ClientController@activate');
Route::get('client/{id}/deactivate', 'ClientController@deactivate');
Route::resource('role', 'RoleController');
Route::resource('user', 'UserController');
Route::get('user/change-password', 'UserController@changePassword');
Route::post('user/change-password', 'UserController@changePasswordSave');

