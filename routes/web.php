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

Route::get('test', function () {
    var_dump(getUserLocationByIp('114.215.142.180'));
});

Route::get('logging', 'HomeController@logging');
Route::get('storeLog', 'HomeController@storeLog');
Route::get('jobFeatureTest', 'HomeController@jobFeatureTest');
Route::get('smsTest', 'HomeController@smsTest');
Route::get('redisTest', 'HomeController@redisTest');
Route::get('languageTest', 'HomeController@languageTest');

// 用户服务
Route::group(array('namespace' => 'Tools\\Json\\', 'prefix' => 'UserService'), function () {
    Route::any('getmobileverify', 'UserServiceController@sendShortMessage');
});