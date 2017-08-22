@extends('intranet.layouts.intranet_iframe_style')

@section('import-resource')
@parent
<style>
.permission-box-toolbar {
	cursor: pointer;
	margin-bottom: 0;
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

.permission-box-content {
	height: 300px;
	border: 1px solid #CCCCCC;
	border-top: none;
	overflow-y: scroll;
}

.permission-box-content.hide {
	display: none;
}

.item-group {
	list-style: none;
	border-bottom: 1px solid #cccccc;
/* 	padding-left: 15px; */
	padding-left: 0;
}

.item-group:last-of-type {
	border-bottom: none;
}

.item-group > li {
	display: inline-block;
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 15px;
}

.item-group > li input {
	vertical-align: sub;
}

.item-group > .li-father {
	display: block;
/* 	border-bottom: 1px solid #cccccc; */
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

<!-- 错误信息输出 -->
@if (! empty($errorMsg))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong>糟糕！</strong> @if (! empty($errorMsg)) {{$errorMsg}} @endif
</div>
@endif

  <div class="x_title content-box">
    <h2>菜单添加</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a href="{{url('intranet/MenuManage/list')}}"><button type="button" class="btn btn-default btn-sm">菜单列表</button></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <br>
    <form action="{{url('intranet/MenuManage/storeMenu')}}" method="post" class="form-horizontal form-label-left">
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单名称 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" required="required" name="menu_name" value="{{old('menu_name')}}" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">菜单链接 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="menu_route" value="{{old('munu_route')}}" class="form-control col-md-7 col-xs-12">
        </div>
        <span>类似： MenuManage/add</span>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">上级菜单 <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <select class="form-control" name="menu_parent_id">
            <option value="0">顶级分类</option>
            @if (! empty($topMenus))
            @foreach ($topMenus as $item)
            <option value="{{$item['menu_id']}}" @if (old('menu_parent_id') == $item['menu_id']) selected @endif>{{$item['menu_name']}}</option>
            @endforeach
            @endif
          </select>
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">选择权限 <span class="required">*</span></label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="permission-box">
            <div class="panel panel-default permission-box-toolbar">
                <div class="panel-heading permission-box-toolbar-header"><i class="right-arrows incline-bottom"></i></div>
            </div>
            </div>
            <div class="permission-box-content">
            @if (! empty($permissions))
            @foreach ($permissions as $item)
            <ul class="item-group">
                <li class="li-father">
                <span>{{$item['permission_name_zh']}}</span>
                </li>
                @if (! empty($item['children']))
                @foreach ($item['children'] as $sub)
                <li class="li-children">
                <span><input type="checkbox" name="permission_id" value="{{$sub['permission_id']}}" @if (old('permission_id') == $sub['permission_id']) checked @endif></span>
                <span>{{$sub['permission_name_zh']}}</span>
                </li>
                @endforeach
                @endif
            </ul>
            @endforeach
            @endif
            </div>
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

@section('extra-js')
<script type="text/javascript">
$(function () {
	$('.permission-box-toolbar-header').on('click', function () {
		if ($(this).find('.right-arrows').hasClass('incline-top')) {
			$(this).find('.right-arrows').removeClass('incline-top').addClass('incline-bottom');
			$('.permission-box-content').removeClass('hide');
		} else {
			$(this).find('.right-arrows').removeClass('incline-bottom').addClass('incline-top');
			$('.permission-box-content').addClass('hide');
		}
	});

	$('input[type="checkbox"]').on('change', function () {
		$('input[type="checkbox"]').each(function (i, n) {
			$(n)[0].checked = false;
		});

		$(this)[0].checked = true;
	});
});
</script>
@endsection