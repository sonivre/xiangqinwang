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
@include('frontend.includes.head')
@yield('addtional-css')
</head>
<body>
@yield('content')
@include('frontend.includes.footer')
</body>
</html>
@yield('addtional-js')
