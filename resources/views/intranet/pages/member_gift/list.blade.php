<?php
/**
 * Created by PhpStorm.
 * File: list.blade.php
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 11/5/2017
 * Time: 5:13 PM
 */
?>
@extends('intranet.layouts.intranet_iframe_style')

@php
$pageTitle = '礼物设置列表';
$navigationButtonUrl = url('intranet/MemberGift/showAddForm');
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
