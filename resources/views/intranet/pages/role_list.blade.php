@extends('intranet.layouts.intranet_iframe_style')
@section('page-main')
<div class="x_panel">
  <div class="x_title">
    <h2>角色列表</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a href="{{url('intranet/RoleManage/add')}}"><button type="button" class="btn btn-default btn-sm">添加角色</button></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content table-responsive" style="display: block;">
    <table class="table table-hover">
      <thead>
        <tr class="pointer">
          <th class="a-center check-all-box">#</th>
          <th style="width: 20%">角色名称</th>
          <th>操作用户</th>
          <th>创建时间</th>
          <th style="width: 20%">#操作</th>
        </tr>
      </thead>
      <tbody>
          @if (! empty($roleList))
              @foreach ($roleList as $item)
              <tr class="pointer">
              <td class="a-center">
              <div class="data-row" data-actionid="{{$item['role_id']}}"><input type="checkbox" class="flat" name="table_records" style="position: absolute; opacity: 0;"></div>
              </td>
              <td>{{$item['role_name']}}</td>
              <td>{{$item['username']}}</td>
              <td>{{$item['create_time']}}</td>
              <td>
<!--                 <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a> -->
                <a href="{{url('intranet/RoleManage/edit')}}/{{$item['role_id']}}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 编辑</a>
                <a href="javascript:;" class="btn btn-danger btn-xs remove-item" data-actionid="{{$item['role_id']}}"><i class="fa fa-trash-o"></i> 删除</a>
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
      <button type="button" class="btn btn-default remove-all-btn">删除所选</button>
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
        // 全选和取消全选功能
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
            
        });

        $('.remove-item').on('click', function () {
            var actionId = $(this).data('actionid');
            var id = new Array();
            id[0] = actionId;
            showNoticeDialog(id);
    	});

        // 批量删除
        $('.remove-all-btn').on('click', function () {
            var itemId = new Array();
            $('.data-row').find('.icheckbox_flat-green').each(function (index, item) {
                //console.log($(item).attr('class'));
                if ($(item).hasClass('checked')) {
                	itemId.push($(item).parent().data('itemid'));
                }
            });
            showNoticeDialog(itemId);
        });
    });

    /**
     * 移除权限
     *
     * @param array actionId 需要删除的id数组
     * @param boolean isConfirm 类似alert弹出框的用户行为判断
     * @return void
     */
    function removeData(actionId, isConfirm) 
    {
        // 数组
        var actionArray = actionId;
        // 拼接成1, 2, 3类似的字符串
        var actionId = actionId.join();
        if (isConfirm) {
            // 发送ajax删除请求
        	$.ajax({
     		   type: "POST",
     		   url: "{{url('intranet/RoleManage/delete')}}",
     		   data: "_token=" + CSRF_TOKEN + "&action_id=" + actionId,
     		   success: function (msg) {
         		   //console.log(msg);
         		   if (msg.error) {
          			  swal({
                       title: '操作失败!',
                       text: msg.error,
                       type: "error",
                       timer: 1500
                     });
             	   } else {
                 	  // 删除DOM行
                 	  for (var i in actionArray) {
                  		 $(".data-row[data-actionid=" + actionArray[i] + "]").parents('tr').remove();
                      }
                 	  
                      swal({
                        title: "操作成功!",
                        text: msg.rows + "条记录被删除!",
                        type: "success",
                        timer: 1500
                      });
                   }
     		   }
   		   
     		});
     		
        }
    }

    function showNoticeDialog(actionId)
    {
    	swal({
  		  title: "确定要删除吗？",
  		  //text: "删除后将不能恢复",
  		  type: "warning",
  		  showCancelButton: true,
  		  confirmButtonColor: "#DD6B55",
  		  confirmButtonText: "确定",
  		  cancelButtonText: "取消",
  		  closeOnConfirm: false,
  		  closeOnCancel: true,
  		  //allowOutsideClick: true
  		}, function (isConfirm) {
  	  		removeData(actionId, isConfirm);
  	  	});
    }
</script>
@endsection