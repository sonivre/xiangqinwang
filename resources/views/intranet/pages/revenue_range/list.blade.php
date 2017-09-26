@extends('intranet.layouts.intranet_iframe_style')

@php
$pageTitle = '收入范围列表';
$navigationButtonUrl = url('intranet/RegisterRevenue/showAddForm');
$editRoute = url('intranet/RegisterRevenue/showEditForm');
$deleteRoute = url('intranet/RegisterRevenue/delete');
$navigationButtonName = '添加';
$columnTitleName = array('收入范围');
$columnKey = array('revenue');
$primaryKey = 'rev_id';
@endphp

@section('page-main')
    @include('intranet.includes.common_list')
@endsection
@section('extra-js')
    @include('intranet.includes.common_list_js');
@endsection