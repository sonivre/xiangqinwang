@extends('intranet.layouts.base')
@section('title', '登录')
@section('import-resource')
@parent
<!-- 包含喜欢的表单验证engine主题样式 -->
<link href="{{config('custom.staticServerIntranet')}}/build/css/validationEngine.jquery.css" rel="stylesheet">
<style>
.tooltip {
    top: 158.5px !important;
}

.tooltip-inner {
	background-color: #AAAAAA !important;
}

.tooltip.right .tooltip-arrow {
	border-right-color: #AAAAAA !important;
}

.refresh-captcha {
	cursor: pointer;
}

/*改变validation-Engine插件的错误框显示样式*/
.formError .formErrorContent {
	background: green !important;
}

.formErrorArrow div {
	background: green !important;
}
</style>
@endsection

@section('content')
<body class="login">
@if (count($errors) > 0)
    <div class="alert alert-success" role="alert">
    <a href="#" class="close" data-dismiss="alert">
        &times;
    </a>
        <ul>
        <li style="list-style: none"><strong>警告！</strong></li>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="login-auth-form" action="" method="post">
              <h1>系统登录</h1>
              <div>
                <input type="text" class="form-control validate[required]" data-errormessage-value-missing="需要填写用户名" name="info[username]" value="@php if (! empty(old('username'))) echo old('username');@endphp" placeholder="用户名" required="" />
              </div>
              <div>
                <input type="password" class="form-control validate[required]" data-errormessage-value-missing="需要填写密码" name="info[password]" placeholder="密码" required="" />
              </div>
              <div>
                <input type="text" class="form-control slide-captcha-code btn-secondary  validate[required]"  data-errormessage-value-missing="需要填写验证码" data-toggle="tooltip" data-placement="right" data-trigger="click" data-html="true" title='<div><img title="点击更换验证码" class="refresh-captcha" src="{{captcha_src()}}&@php echo uniqid();@endphp"></div>' name="info[captcha]" placeholder="验证码" required="" />
              </div>
              <div>
                {{csrf_field()}}
                <a class="btn btn-default submit login-btn">登录</a>
<!--                 <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">
<!--                 <p class="change_link">New to site? -->
<!--                   <a href="#signup" class="to_register"> Create Account </a> -->
<!--                 </p> -->

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
<!--                   <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p> -->
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
</body>
@endsection

@section('extra-js')
<script>
var captchaUrl = '{{captcha_src()}}';
var captchaCode = '';
</script>
<script src="{{config('custom.staticServerIntranet')}}/build/js/user-authentication.js"></script>
@endsection
