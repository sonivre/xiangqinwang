@extends('intranet.layouts.intranet_iframe_style')
@section('import-resource')
@parent
<style>
.row-role-list {
	margin-top: 20px;
	font-size: 15px;
}

.row-role-list:first-child {
	margin-top: 8px;
}

.row-role-list .btn-info {
	vertical-align: top;
	margin-left: 10px;
}

.row-role-list input {
	vertical-align: top;
}
</style>
@endsection
@section('page-main')
<div class="x_panel">
@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
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

  <div class="x_title content-box">
    <h2>用户编辑</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a href="{{url('intranet/AdminUserManage/list')}}"><button type="button" class="btn btn-default btn-sm">用户列表</button></a></li>
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
          <input type="text" id="" required="required" name="username" value="@if (! empty(old('username'))){{old('username')}}@elseif (! empty($info['username'])){{$info['username']}}@endif" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">登录密码 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="password" value="@if (! empty(old('password'))) {{old('password')}} @endif" class="form-control col-md-7 col-xs-12" placeholder="留空表示原密码不变">
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">选择角色 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          @php $rows = ceil(count($roleList) / 3); @endphp
          @for ($i = 0; $i < $rows; $i++)
          @php $step = 0; ?>
          <div class="row row-role-list">
          @foreach ($roleList as $index => $role)
          <div class="col-md-4">
          <input type="checkbox" name="role_id[]" value="{{$role['role_id']}}" @if (! empty(old('role_id')) && in_array($role['role_id'], old('role_id'))) checked @elseif(in_array($role['role_id'], $roles)) checked @endif>
          <span>{{$role['role_name']}}</span>
          <a href="{{url('intranet/RoleManage/edit')}}/{{$role['role_id']}}" class="btn btn-info btn-xs">查看权限</a>
          </div>
          @php
          unset($roleList[$index]);
          
          if ($step >= 2) {
              break;
          }
          
          ++$step;
          @endphp
          @endforeach
          </div>
          @endfor
        
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
<script>
    $(function () {
    	// 监听表单提交，如果尚未选中任何角色，则弹出一个提示信息
    	$('form').on('submit', function (event) {
    		var checkboxes = $('input[name="role_id[]"');
    		// 得到被选中的checkbox的个数
    		var checkedCount = 0;
    		
    		checkboxes.each(function (i, n) {
    			if ($(n).is(':checked')) {
    				++checkedCount;
    			}
    		});

    		if (checkedCount != 0) {
    			return true;
    		}

    		$('.content-box').prev('.alert-danger').remove();
    		var content = '<div class="alert alert-danger alert-dismissible fade in" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><strong>请至少选择一个角色！</div>';
    		$('.content-box').before(content);
    		event.preventDefault();
    	});
    });
</script>
@endsection