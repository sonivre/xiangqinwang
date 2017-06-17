<html>
<head>
<title>intranet系统 - @yield('title')</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@section('import-resource')
<!-- Bootstrap -->
<link href="{{config('custom.staticServerIntranet')}}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{config('custom.staticServerIntranet')}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="{{config('custom.staticServerIntranet')}}/vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- Animate.css -->
<link href="{{config('custom.staticServerIntranet')}}/vendors/animate.css/animate.min.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{config('custom.staticServerIntranet')}}/build/css/custom.min.css" rel="stylesheet">
<script src="{{config('custom.staticServerIntranet')}}/build/js/jquery.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/build/js/bootstrap-tooltip.js"></script>
@show
</head>
@yield('content')
</html>
@yield('extra-js')