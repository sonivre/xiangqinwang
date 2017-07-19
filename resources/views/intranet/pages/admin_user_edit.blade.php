@extends('intranet.layouts.intranet_iframe_style')
@section('page-main')
<div class="x_panel">
<!-- 错误信息输出 -->
@if (count($errors) > 0 || ! empty($errorMsg))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<ul>
<li style="list-style: none"><strong>警告！</strong></li>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    <!-- 认证错误 -->
    @php if (! empty($errorMsg)) echo '<li>' . $errorMsg . '</li>';@endphp
</ul>
</div>
@endif

  <div class="x_title">
    <h2>编辑用户</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a href="{{url('intranet/AdminUserManage/list')}}"><button type="button" class="btn btn-default btn-sm">管理员列表</button></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <br>
    <form action="" method="post" class="form-horizontal form-label-left">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">用户名 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="" required="required" name="permission_name" value="@php if(! empty($info['permission_name'])) echo $info['permission_name'];@endphp" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        {{csrf_field()}}
        <input type="hidden" name="permission_id" value="@php if(! empty($info['permission_id'])) echo $info['permission_id'];@endphp">
        <button type="submit" class="btn btn-success">提交</button>
		<button class="btn btn-primary" type="reset" onclick="window.location.href=window.location.href;">重置</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection