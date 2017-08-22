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
        var actionId = new Array();
        $('.data-row').find('.icheckbox_flat-green').each(function (index, item) {
            //console.log($(item).attr('class'));
            if ($(item).hasClass('checked')) {
            	actionId.push($(item).parent().data('actionid'));
            }
        });

        if (actionId.length === 0) {
        	swal({
                title: '操作失败!',
                text: '您还没有选择需要删除的项!',
                type: "error",
                timer: 1500
            });
            
            return false;
        }
        
        showNoticeDialog(actionId);
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