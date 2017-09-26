@extends('intranet.layouts.intranet_iframe_style')

@php
$pageTitle = '角色列表';
$navigationButtonUrl = url('intranet/RoleManage/add');
$editRoute = url('intranet/RoleManage/edit');
$deleteRoute = url('intranet/RoleManage/delete');
$navigationButtonName = '角色添加';
$columnTitleName = array('角色名称', '操作用户', '创建时间');
$columnKey = array('role_name', 'username', 'create_time');
$primaryKey = 'role_id';
@endphp

@section('page-main')
@include('intranet.includes.common_list')
@endsection
@section('extra-js')
@include('intranet.includes.common_list_js');
@endsection