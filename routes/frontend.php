<?php
Route::group(array('namespace' => 'Frontend'), function () {

    Route::any('/', 'UserController@authenticationRegisterEmail');
    Route::any('register_step_one', 'UserController@prepareRegister');
    Route::any('finalRegister', 'UserController@finalRegister');
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