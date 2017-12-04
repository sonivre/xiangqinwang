<?php
/**
 * Created by PhpStorm.
 * User: konohanaruto
 * Date: 2017/3/26
 * Time: 10:10
 */
?>
<html>
<head>
<meta charset="UTF-8">
<title>花田网 - @yield('title')</title>
@section('basic-static-resource')
<link rel="stylesheet" href="{{config('custom.staticServer')}}/css/base.css" />
<script src="{{config('custom.staticServer')}}/js/jquery.js"></script>
@show
</head>
<body>
@yield('content')
@include('frontend.includes.footer')
</body>
</html>
@yield('addtional-js')
