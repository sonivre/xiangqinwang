@extends('intranet.layouts.intranet_iframe_style')

@section('import-resource')
@parent
<style>
.permission-box-toolbar {
	cursor: pointer;
}

.right-arrows {
    /*转换为块元素*/
    display: inline-block;
    /*定义4条边均为实线, 且颜色为黑色, 此时看起来是一个黑色小点, 因为没有宽高导致*/
    border: solid #BCBCBC;
    /*width: 5px;*/
    /*height: 5px;*/
    /*border有默认宽度, 在这里重置想要的值, 依次为上、右、下、左*/
    border-width: 0 3px 3px 0;
    /*撑开一些空白区域, 如果不明白可以展开上方的宽高调试, 或者在控制台调试初始化为0, 然后鼠标滚轮增加该值即可看到效果*/
    padding: 3px;
	transition: all 0.5s;
}

.incline-top {
	transform: rotate(-135deg);
}

.incline-bottom {
	transform: rotate(45deg);
}

.permission-box-toolbar-header {
	position: relative;
	height: 30px;
}

.permission-box-toolbar-header .right-arrows {
	position: absolute;
	top: 10px;
	right: 10px;
}
</style>
@endsection

@section('page-main')
<div class="x_panel">
<!-- 错误信息输出 -->
@if (! empty($errorMsg))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong>糟糕！</strong> @if (! empty($errorMsg)) {{$errorMsg}} @endif
</div>
@endif

  <div class="x_title">
    <h2>角色添加</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a href="{{url('intranet/RoleManage/list')}}"><button type="button" class="btn btn-default btn-sm">角色列表</button></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <br>
    <form action="" method="post" class="form-horizontal form-label-left">

      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">角色名称 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="" required="required" name="role_name" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">指定权限 <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="permission-box">
        <div class="panel panel-default permission-box-toolbar">
            <div class="panel-heading permission-box-toolbar-header"><i class="right-arrows incline-top"></i></div>
        </div>
        </div>
        <div class="permission-box-content">
        </div>
        </div>
      </div>
      
      <div class="form-group" style="margin-top: 30px;">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        {{csrf_field()}}
        <button type="submit" class="btn btn-success">提交</button>
		<button class="btn btn-primary" type="reset" onclick="window.location.href=window.location.href;">重置</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('extra-js')
<script type="text/javascript">
$(function(){
	$('.right-arrows').on('click', function () {
		console.log('aaaa');
		if ($(this).hasClass('incline-top')) {
			$(this).removeClass('incline-top').addClass('incline-bottom');
		} else {
			$(this).removeClass('incline-bottom').addClass('incline-top');
		}
	});
});
</script>
@endsection