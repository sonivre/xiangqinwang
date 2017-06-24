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

Route::group(array('namespace' => 'Tools', 'prefix' => 'tools'), function () {
    Route::get('totalDays/{year}/{month}', 'PocketController@getDaysByYearMonth');
    Route::get('cityList/{provinceCode}', 'PocketController@getCitiesByProvinceCode');
});

Route::get('test', function () {
    var_dump(getUserLocationByIp('114.215.142.180'));
});
