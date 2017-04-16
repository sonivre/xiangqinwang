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

//Route::get('/', function () {
//    return view('welcome');
//});

// frontend 前端模块
// intranet 后端模块

Route::group(array('namespace' => 'Frontend'), function () {

    Route::any('/', 'UserController@authenticationRegisterEmail');
    Route::any('register_step_one', 'UserController@prepareRegister');
    Route::group(array('prefix' => 'User'), function () {
        Route::post('checkExists', 'UserController@checkUserExists');
    });
    Route::group(array('middleware' => 'LoginCheck'), function () {

    });
    Route::group(array('prefix' => 'home'), function () {
//        Route::any('/login', function () {
//            echo 'aaa';
//        });
    });

});

Route::group(array('namespace' => 'Intranet'), function () {

});

Route::group(array('namespace' => 'Tools', 'prefix' => 'tools'), function () {
    Route::get('totalDays/{year}/{month}', 'PocketController@getDaysByYearMonth');
    Route::get('cityList/{provinceCode}', 'PocketController@getCitiesByProvinceCode');
});

Route::get('test', function () {
    var_dump(getUserLocationByIp('114.215.142.180'));
});
