<?php
Route::group(array('namespace' => 'Frontend'), function () {

    Route::any('/', 'UserController@authenticationRegisterEmail');
    Route::get('register_step_one', 'UserController@prepareRegister');
    Route::group(array('prefix' => 'User'), function () {
        Route::post('checkExists', 'UserController@checkUserExists');
        Route::post('storeRegisterInfo', 'UserController@actionStoreRegisterInfo');
        Route::get('registerMemberAvatar', 'UserController@actionRegisterMemberAvatar');
        Route::post('storeMemberRegisterAvatar', 'UserController@actionStoreMemberRegisterAvatar');
        Route::post('uploadMemberAvatar', 'UserController@actionUploadMemberAvatar');
        Route::get('activationAccount', 'UserController@actionActivationAccount');
        Route::group(['prefix' => 'Supports'], function () {
            Route::get('activationEmail', 'UserController@actionActivationEmail');
        });
    });

    // 登录后的用户
    Route::group([], function () {
        Route::get('home', 'MemberRecommendController@actionHome');
    });

    Route::group(array('middleware' => 'LoginCheck'), function () {

    });
    Route::group(array('prefix' => 'home'), function () {
        //        Route::any('/login', function () {
        //            echo 'aaa';
        //        });
    });

});