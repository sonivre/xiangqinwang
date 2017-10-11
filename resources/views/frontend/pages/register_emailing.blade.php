<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/11
 * Time: 20:19
 */
?>
@extends('frontend.layouts.default')
@section('title', '发送注册验证邮件')
@section('addtional-css')
<link rel="stylesheet" href="{{config('custom.staticServer')}}/css/common.css">
<link rel="stylesheet" href="{{config('custom.staticServer')}}/css/register.css">
@endsection
@section('content')
    <h2>系统给您发送了一封验证邮件，请注意查收！没收到？点击<a href="{{url($currentRoute)}}" style="color: #0000ff;">这里</a>重试。</h2>
@endsection

