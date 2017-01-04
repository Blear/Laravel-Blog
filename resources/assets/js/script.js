/**
 * Created by Blear on 2016/12/26.
 */
function _delete(element){
    swal({
        title: "你确定要执行这个操作吗?",
        text: "你确定要删除此记录吗？",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "确认",
        cancelButtonText: "取消",
        closeOnConfirm: false
    }, function(isConfirmed){
        if (isConfirmed){
            element.find('form').submit();
        }
    });
}