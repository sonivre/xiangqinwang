<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Blog: http://www.muyesanren.com
 * QQ: 1039814413
 * Wechat Number: wikitest
 * Date: 2017/10/16
 * Time: 19:53
 */
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>花田网 - @yield('title')</title>
@section('basic-static-resource')
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/base.css">
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/common.css">
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/form.css">
    <link rel="stylesheet" href="{{config('custom.staticServer')}}/css/cropper.min.css" />
    <script src="{{config('custom.staticServer')}}/js/jquery.js"></script>
    <script src="{{config('custom.staticServer')}}/js/cropper.min.js"></script>
    <script type="text/javascript" src="{{config('custom.staticServer')}}/js/common.js"></script>
    <script type="text/javascript" src="{{config('custom.staticServer')}}/js/default.js"></script>

@show
</head>
<body>
@include('frontend.includes.authed.header')
@yield('content')
@include('frontend.includes.authed.footer')
</body>
</html>
@yield('additional-js')