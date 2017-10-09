<?php

Route::group(array('namespace' => 'Tools', 'prefix' => 'tools'), function () {
    Route::get('totalDays/{year}/{month}', 'PocketController@getDaysByYearMonth');
    Route::get('cityList/{provinceCode}', 'PocketController@getCitiesByProvinceCode');
    Route::group(['namespace' => 'Json', 'prefix' => 'api'], function () {
        Route::post('registerMobileCode', 'UserServiceController@sendShortMessage');
    });
});