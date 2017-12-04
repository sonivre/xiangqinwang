<html>
<head>
<title>后台 - @yield('title')</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{csrf_token()}}" />
@section('import-resource')
<!-- Bootstrap -->
<link href="{{config('custom.staticServerIntranet')}}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{config('custom.staticServerIntranet')}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="{{config('custom.staticServerIntranet')}}/vendors/nprogress/nprogress.css" rel="stylesheet">
<link href="{{config('custom.staticServerIntranet')}}/build/js/sweetalert.css" rel="stylesheet">
<link href="{{config('custom.staticServerIntranet')}}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- Animate.css -->
<link href="{{config('custom.staticServerIntranet')}}/vendors/animate.css/animate.min.css" rel="stylesheet">
<link href="{{config('custom.staticServerIntranet')}}/vendors/nprogress/nprogress.css" rel="stylesheet">
<link href="{{config('custom.staticServerIntranet')}}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{config('custom.staticServerIntranet')}}/build/css/custom.min.css" rel="stylesheet">
{{--我自定义的css文件--}}
<link href="{{config('custom.staticServerIntranet')}}/build/css/common.css" rel="stylesheet">
<link href="{{config('custom.staticServerIntranet')}}/vendors/cropper/dist/cropper.min.css" rel="stylesheet">

<script src="{{config('custom.staticServerIntranet')}}/vendors/jquery/dist/jquery.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/js/JQuery-extends-functions.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/build/js/jquery.validationEngine.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/build/js/jquery.validationEngine-zh_CN.js"></script>
{{--这里记录一下，common.js和common.min.js都定义了一个download变量，它的值为$('download')，而我们html中没有，会报错，所以在这里我注视掉了那段代码--}}
<script src="{{config('custom.staticServerIntranet')}}/js/common.js"></script>
<!-- csrf token define -->
<script>
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
</script>
@show
</head>
@yield('content')
</html>

<script src="{{config('custom.staticServerIntranet')}}/build/js/bootstrap-tooltip.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/build/js/sweetalert.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/fastclick/lib/fastclick.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/nprogress/nprogress.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/iCheck/icheck.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/cropper/dist/cropper.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/build/js/custom.js"></script>

@yield('extra-js')