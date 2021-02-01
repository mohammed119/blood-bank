<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'v1'],function (){
    Route::get('governorates','MainController@governorates');
    Route::get('cities','MainController@cities');
    Route::post('register','AuthController@register');
    Route::post('login','AuthController@login');
    Route::post('reset-password','AuthController@resetPassword');
    Route::post('new-password','AuthController@newPassword');
    Route::post('donation-request-create','AuthController@donationRequestCreate');
    Route::post('orders','MainController@orders');
    Route::post('show-order','MainController@showOrder');




        Route::get('posts','MainController@posts');
        Route::post('show-post','MainController@showPost');
        Route::post('profile','AuthController@profile');
        Route::get('configuration','MainController@configuration');
        Route::post('contact','MainController@contact');
        Route::post('notification-setting','AuthController@notificationSetting');
        Route::post('register-notification-token','AuthController@registerNotificationSetting');
        Route::post('remove-token','AuthController@removeToken');
        Route::post('post-favorite','MainController@postFavorite');
        Route::post('notification-list','MainController@notificationList');
});