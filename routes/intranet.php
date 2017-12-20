<?php

Route::group(array('namespace' => 'Intranet', 'prefix' => 'intranet'), function () {
    Route::any('login', 'SystemController@login');
    Route::group(array('middleware' => array('intranet.logincheck', 'intranet.useranalyzetool')), function () {
        Route::get('/', 'SystemController@home');
        Route::get('logout', 'SystemController@actionLogout');
        // 权限设置
        Route::get('Privilege/list', 'PrivilegeController@actionList');
        Route::any('Privilege/add', 'PrivilegeController@actionAdd');
        Route::any('Privilege/edit/{permissionId?}', 'PrivilegeController@actionEdit');
        Route::any('Privilege/delete/{permissionId?}', 'PrivilegeController@actionDelete');
        // 管理员管理
        Route::get('AdminUserManage/list', 'AdminController@actionList');
        Route::any('AdminUserManage/add', 'AdminController@actionAdd');
        Route::any('AdminUserManage/edit/{userid?}', 'AdminController@actionEdit');
        Route::any('AdminUserManage/delete', 'AdminController@actionDelete');
        // 角色管理
        Route::get('RoleManage/list', 'RoleController@actionList');
        Route::any('RoleManage/add', 'RoleController@actionAdd');
        Route::any('RoleManage/edit/{actionId?}', 'RoleController@actionEdit');
        Route::any('RoleManage/delete/{actionId?}', 'RoleController@actionDelete');
        // 菜单管理
        Route::get('MenuManage/list', 'MenuController@actionList');
        Route::get('MenuManage/add', 'MenuController@actionAdd');
        Route::post('MenuManage/storeMenu', 'MenuController@actionStoreMenu');
        Route::get('MenuManage/edit/{actionId}', 'MenuController@actionEdit');
        Route::post('MenuManage/update', 'MenuController@actionUpdate');
        Route::post('MenuManage/delete', 'MenuController@actionDelete');
        // 基础设置模块
        Route::get('SafeSetting/detail', 'SafeSettingController@actionDetail');

        // 用户管理模块
        Route::get('Education/list', 'EducationController@actionList');
        Route::get('Education/showAddForm', 'EducationController@actionShowAddForm');
        Route::post('Education/store', 'EducationController@actionStore');
        Route::get('Education/showEditForm/{actionId}', 'EducationController@actionShowEditForm');
        Route::post('Education/update', 'EducationController@actionUpdate');
        Route::post('Education/delete', 'EducationController@actionDelete');

        // 注册项 月均收入
        Route::get('RegisterRevenue/list', 'RegisterRevenueController@actionList');
        Route::get('RegisterRevenue/showAddForm', 'RegisterRevenueController@actionShowAddForm');
        Route::post('RegisterRevenue/store', 'RegisterRevenueController@actionStore');
        Route::get('RegisterRevenue/showEditForm/{actionId}', 'RegisterRevenueController@actionShowEditForm');
        Route::post('RegisterRevenue/update', 'RegisterRevenueController@actionUpdate');
        Route::post('RegisterRevenue/delete', 'RegisterRevenueController@actionDelete');

        // 礼物管理
        Route::get('MemberGift/list', 'MemberGiftController@actionList');
        Route::get('MemberGift/showAddForm', 'MemberGiftController@actionShowAddForm');
        Route::post('MemberGift/uploadGiftThumb', 'MemberGiftController@uploadGiftThumb');
        Route::post('MemberGift/store', 'MemberGiftController@store');
        Route::get('MemberGift/showEditForm/{actionId}', 'MemberGiftController@showEditForm');
        Route::post('MemberGift/update', 'MemberGiftController@update');
    });
});