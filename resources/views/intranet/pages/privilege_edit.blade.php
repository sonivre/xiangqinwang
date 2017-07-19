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
    <h2>权限编辑</h2>
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
          <input type="text" id="" required="required" name="permission_name_en" value="@php if (! empty($info['permission_name_en'])) echo $info['permission_name_en']; @endphp" class="form-control col-md-7 col-xs-12">
        </div>
        <span>英文名称, 类似"permission_name"</span>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">权限名称 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="" required="required" name="permission_name_zh"  value="@php if (! empty($info['permission_name_zh'])) echo $info['permission_name_zh']; @endphp" class="form-control col-md-7 col-xs-12">
        </div>
        <span>中文名称, 类似"权限名称"</span>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">上级分类 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <select class="form-control" name="parent_id">
            <option value="0" @php if (0 == $info['parent_id']) echo 'selected'; @endphp>顶级分类</option>
            <!-- 顶级分类不需要展示额外的其他项 -->
            @if (! empty($info['topCategory']) && $info['parent_id'] != 0)
            @foreach ($info['topCategory'] as $item)
            <option value="{{$item['permission_id']}}" @php if ($item['permission_id'] == $info['parent_id']) echo 'selected'; @endphp>{{$item['permission_name_zh']}}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        {{csrf_field()}}
        <input type="hidden" name="permission_id" value="@php if(! empty($info['permission_id'])) echo $info['permission_id'];@endphp">
        <!-- 记录之前的英文权限名记录 -->
        <input type="hidden" name="old_permission_name_en" value="@php if (! empty($info['permission_name_en'])) echo $info['permission_name_en']; @endphp">
        <input type="hidden" name="old_permission_name_zh" value="@php if (! empty($info['permission_name_zh'])) echo $info['permission_name_en']; @endphp">
        <button type="submit" class="btn btn-success">提交</button>
		<button class="btn btn-primary" type="reset" onclick="window.location.href=window.location.href;">重置</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection