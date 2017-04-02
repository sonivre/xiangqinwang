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

    Route::any('/', 'BasicController@login');
    Route::any('register_step_one', 'BasicController@prepareRegister');
    Route::group(array('prefix' => 'User'), function () {
        Route::any('checkExists', 'BasicController@checkUserExists');
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

Route::any('test', function () {
    return redirect('User/checkExists');
});
