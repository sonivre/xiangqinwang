@extends('intranet.layouts.intranet_iframe_style')

@php
$pageTitle = '学历列表';
$navigationButtonUrl = url('intranet/Education/showAddForm');
$editRoute = url('intranet/Education/edit');
$navigationButtonName = '学历添加';
$columnTitleName = array('学历名称');
$columnKey = array('name');
$primaryKey = 'eduid';
@endphp

@section('page-main')
    @include('intranet.includes.common_list')
@endsection
@section('extra-js')
    @include('intranet.includes.common_list_js');
@endsection