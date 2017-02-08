/**
 * Created by huangtie on 16/8/11.
 */

/*
* 添加按钮操作
*
* */
$("#button-add").click(function () {
   var url = SCOPE.add_url;
    window.location.href = url;
});

/*
 * 菜单添加按钮操作
 *
 * */
$("#button-add-class").click(function () {
    var url = SCOPE.add_url;
    var id = $("#type").val();
    window.location.href = url + '&type=' + id;
});

/*
* from表单提交操作
*
* */
$("#singcms-button-submit").unbind("click").click(function () {
    var url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    var data = $("#singcms-form").serializeArray();
    postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    $.post(url,postData,function (result) {
        if (result.status==1){
            dialog.error(result.message);
        }
        else if (result.status==0)
        {
            dialog.success(result.message,jump_url);
        }
    },'JSON');
})

/*
* 点击编辑按钮
* */
$('.singcms-table #singcms-edit').click(function () {
    var url = SCOPE.edit_url;
    var id = $(this).attr('attr-id');
    window.location.href = url + '&id=' + id;
})

/*
* 有对话框的
*
* */
$('.singcms-table #singcms-delete').click(function () {
    var url = SCOPE.set_status_url;
    var id = $(this).attr('attr-id');
    var message = $(this).attr('attr-message');

    data = {};
    data['id']=id;
    data['status']=-1;
    layer.open({
        type:0,
        title:'是否提交?',
        btn:['是','否'],
        icon :3,
        closeBtn : 2,
        content: "是否确定"+message,
        scrollbar:true,
        yes:function () {
            todelete(url,data);
        },
    });
});

$('.singcms-table #singcms-on-off').click(function () {
    var url = SCOPE.set_status_url;
    var id = $(this).attr('attr-id');
    var status = $(this).attr('attr-status');
    var message = status == 1 ? '开启':'关闭';

    data = {};
    data['id']=id;
    data['status']= status;
    layer.open({
        type:0,
        title:'提示',
        btn:['是','否'],
        icon :3,
        closeBtn : 2,
        content: "是否确定"+message,
        scrollbar:true,
        yes:function () {
            todelete(url,data);
        },
    });
});

function todelete(url,data) {
    $.post(url,data,function (result) {
        if (result.status==1){
            dialog.error(result.message);
        }
        else if (result.status==0)
        {
            var url = SCOPE.jump_url;
            dialog.success(result.message,url);
        }
    },'JSON');
}

$("#button-listorder").unbind("click").click(function () {
    var data = $("#singcms-listorder").serializeArray();
    postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });
    var url = SCOPE.listorder_url;
    var jump_url = SCOPE.jump_url;
    $.post(url,postData,function (result) {
        if (result.status==1){
            dialog.error(result.message,window.location.href);
        }
        else if (result.status==0)
        {
            dialog.success(result.message,window.location.href);
        }
    },'JSON')
})

$("#button-push").unbind("click").click(function () {

    var id = $("#select-push").val();
    if(id==0){
        dialog.error("请选择推荐位");
    }
    var url = SCOPE.push_url;
    push = {};
    pushData = {};
    $("input[name='pushcheck']:checked").each(function (i) {
        push[i] = $(this).val();
    });

    pushData['push']=push;
    pushData['position_id'] = id;

    $.post(url,pushData,function (result) {
        if (result.status==1){
            dialog.error(result.message);
        }
        else if (result.status==0)
        {
            dialog.success(result.message,result['data']['jump_url']);
        }
    },'JSON')
})









































