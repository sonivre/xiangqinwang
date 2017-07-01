@extends('intranet.layouts.intranet_iframe_style')
@section('import-resource')
@parent
<link href="{{config('custom.staticServerIntranet')}}/vendors/nprogress/nprogress.css" rel="stylesheet">
<link href="{{config('custom.staticServerIntranet')}}/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<script src="{{config('custom.staticServerIntranet')}}/vendors/fastclick/lib/fastclick.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/nprogress/nprogress.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/vendors/iCheck/icheck.min.js"></script>
<script src="{{config('custom.staticServerIntranet')}}/build/js/custom.min.js"></script>
@endsection
@section('page-main')
<div class="x_panel">
  <div class="x_title">
    <h2>权限列表</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a href="{{url('intranet/Privilege/add')}}"><button type="button" class="btn btn-default btn-sm">添加权限</button></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content table-responsive" style="display: block;">
    <table class="table table-hover">
      <thead>
        <tr class="pointer">
          <th class="a-center check-all-box">#</th>
          <th style="width: 20%">权限名称</th>
          <th>操作用户</th>
          <th>创建时间</th>
          <th style="width: 20%">#操作</th>
        </tr>
      </thead>
      <tbody>
        
          @if(!empty($permissionList))
              @foreach($permissionList as $item)
              <tr class="pointer">
              <td class="a-center">
              <div class="icheckbox_flat-green"><input type="checkbox" class="flat" name="table_records" style="position: absolute; opacity: 0;"></div>
              </td>
              <td>{{$item['permission_name']}}</td>
              <td>{{$item['username']}}</td>
              <td>{{$item['create_time']}}</td>
              <td>
<!--                 <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> -->
                <a href="{{url('intranet/Privilege/edit')}}/{{$item['permission_id']}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> 删除</a>
              </td>
              </tr>
              @endforeach
          @endif
          
      </tbody>
    </table>
  </div>
  <div class="x_content">
      <div class="col-md-4 col-sm-4 col-xs-4">
      <div class="pagination" style="margin: 0">
      <input type="checkbox" class="check-box-all-delete" style="vertical-align: sub"><span style="margin-right: 10px;"> 全选</span>
      <button type="button" class="btn btn-default">删除所选</button>
      </div>
      </div>
      <div class="col-md-8 col-sm-8 col-xs-8">
      <ul class="pagination" style="float: right; margin: 0;">
        <li>
          <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
          <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
      </div>
  </div>
</div>
@endsection
@section('extra-js')
<script>
    $(function () {
        $(document).on('change', '.check-box-all-delete', function () {
            if (! $(this).is(':checked')) {
            	$('.a-center .icheckbox_flat-green').each(function (index, item) {
                    $(item).removeClass('checked');
                });
            } else {
            	$('.a-center .icheckbox_flat-green').each(function (index, item) {
                    $(item).addClass('checked');
                });
            }
            
        })
    });
</script>
@endsection