@extends('intranet.layouts.base')
@section('title', '后台 - 管理员中心')

@section('content')
<body class="nav-md">
<div class="container body">
  <div class="main_container">
    @include('intranet.includes.left-menu');
    <!-- top navigation -->
    @include('intranet.includes.top-nav');
    <!-- /top navigation -->

    <!-- page content -->
    @yield('page-main')
    <!-- /page content -->

    <!-- footer content -->
    @include('intranet.includes.footer')
    <!-- /footer content -->
  </div>
</div>
@endsection