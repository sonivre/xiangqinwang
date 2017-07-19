@extends('intranet.layouts.intranet_iframe_style')
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
    <h2>权限添加</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a href="{{url('intranet/Privilege/list')}}"><button type="button" class="btn btn-default btn-sm">权限列表</button></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <br>
    <form action="" method="post" class="form-horizontal form-label-left">

      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">权限名称 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="" required="required" name="permission_name" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
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