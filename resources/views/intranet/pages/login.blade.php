@extends('intranet.layouts.base')
@section('import-resource')
@parent
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
</style>
@endsection

@section('content')
<body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>
      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form>
              <h1>系统登录</h1>
              <div>
                <input type="text" class="form-control" name="info[username]" placeholder="用户名" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="info[password]" placeholder="密码" required="" />
              </div>
              <div>
                <input type="text" class="form-control slide-captcha-code btn-secondary" data-toggle="tooltip" data-placement="right" data-trigger="click" data-html="true" title='<div><img title="点击更换验证码" class="refresh-captcha" src="{{captcha_src()}}"></div>' name="info[captcha]" placeholder="验证码" required="" />
              </div>
              <div>
                <a class="btn btn-default submit">登录</a>
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
</script>
<script src="{{config('custom.staticServerIntranet')}}/build/js/user-authentication.js"></script>
@endsection
