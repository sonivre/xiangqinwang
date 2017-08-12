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
<!-- 错误信息输出 -->
@if (! empty(session('errorMsg')))
<div class="alert alert-danger alert-dismissible fade in" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong>糟糕！</strong> @if (! empty(session('errorMsg'))) {{session('errorMsg')}} @endif
</div>
@endif

  <div class="x_title">
    <h2>角色修改</h2>
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
          <input type="text" id="" required="required" name="role_name" value="@if (! empty($info['role_name'])) {{$info['role_name']}}@endif" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      
      <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12">指定权限 <span class="required">*</span></label>
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
                <span><input type="checkbox" @php if (in_array($item['permission_id'], $selectedPermissionId)) echo 'checked'; @endphp></span>
                <span>{{$item['permission_name_zh']}}</span>
                </li>
                @if (! empty($item['children']))
                @foreach ($item['children'] as $sub)
                <li class="li-children">
                <span><input type="checkbox" @php if (in_array($sub['permission_id'], $selectedPermissionId)) echo 'checked'; @endphp name="permission_id[]" value="{{$sub['permission_id']}}"></span>
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
      
      <div class="form-group" style="margin-top: 30px;">
        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        {{csrf_field()}}
        <input type="hidden" name="role_id" value="{{$info['role_id']}}">
        <input type="hidden" name="old_role_name" value="{{$info['role_name']}}">
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
	$('.permission-box-toolbar-header').on('click', function () {
		if ($(this).find('.right-arrows').hasClass('incline-top')) {
			$(this).find('.right-arrows').removeClass('incline-top').addClass('incline-bottom');
			$('.permission-box-content').removeClass('hide');
		} else {
			$(this).find('.right-arrows').removeClass('incline-bottom').addClass('incline-top');
			$('.permission-box-content').addClass('hide');
		}
	});

	// 权限的checkbox全选
	$('.li-father input[type="checkbox"]').on('change', function () {
		if ($(this).is(':checked')) {
			$(this).parents('.item-group').find('.li-children input[type="checkbox"]').each(function (i, n) {
				$(n)[0].checked = true;
			});
		} else {
			$(this).parents('.item-group').find('.li-children input[type="checkbox"]').each(function (i, n) {
				$(n)[0].checked = false;
			});
		}
		
	});

	$('.li-children input[type="checkbox"]').on('change', function () {
		var ulObject = $(this).parents('.item-group');
		var liChildrens = ulObject.find('.li-children input[type="checkbox"]');
		var liFather = ulObject.find('.li-father input[type="checkbox"]');
		// 得到子级权限checkbox的个数
		var liChildrenCount = liChildrens.length;
		// 得到被选中的checkbox的个数
		var selectedLiChildrenCount = 0;
		
		liChildrens.each(function (i, n) {
			if ($(n).is(':checked')) {
				++selectedLiChildrenCount;
			}
		});

		// 子级全部被选中, 则将父级标注为选中状态
		if (liChildrenCount == selectedLiChildrenCount) {
			liFather[0].checked = true;
		} else {
			liFather[0].checked = false;
		}
	});
});
</script>
@endsection
