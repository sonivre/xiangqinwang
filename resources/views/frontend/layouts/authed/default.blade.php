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
    @include('frontend.includes.authed.require_head')
    @yield('subsequent')
</head>
<body>
@include('frontend.includes.authed.header')
@yield('content')
@include('frontend.includes.authed.footer')
</body>
</html>