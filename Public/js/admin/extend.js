/**
 * Created by huangtie on 16/10/10.
 */

$("#button-addclass-submit").unbind("click").click(function () {
    var url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    var data = $("#singcms-form").serializeArray();
    var type = $("#type_id").val();
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
            var a = 'one';
            if(type==2){
                a='two';
            }
            if(type == 3){
                a='three';
            }
            dialog.success(result.message,jump_url + '&a=' + a);
        }
    },'JSON');
})

/*
 * 点击编辑按钮
 * */
$('.singcms-table #singcms-class-edit').unbind("click").click(function () {
    var url = SCOPE.edit_url;
    var id = $(this).attr('attr-id');
    var type = $("#type").val();
    window.location.href = url + '&id=' + id + '&type=' + type;
})

$('.singcms-table #singcms-on-off-class').click(function () {
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
            todeleteEX(url,data);
        },
    });
});

$('.singcms-table #singcms-class-delete').unbind("click").click(function () {
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
            todeleteEX(url,data);
        },
    });
});

function todeleteEX(url,data) {
    $.post(url,data,function (result) {
        if (result.status==1){
            dialog.error(result.message);
        }
        else if (result.status==0)
        {
            var type = $("#type").val();
            var a = 'one';
            if(type==2){
                a='two';
            }
            if(type == 3){
                a='three';
            }
            var url = SCOPE.jump_url + '&a=' + a;
            dialog.success(result.message,url);
        }
    },'JSON');
}

$("#class_screen_btn").unbind('click').click(function () {
    var parent_id = $("#parentselect").val();
    var type = $("#type").val();
    var a = 'one';
    if(type==2){
        a='two';
    }
    if(type == 3){
        a='three';
    }
    var url = '/admin.php?c=class&a=' + a;
    if(parent_id){
        url = url + '&parent_id='+parent_id;
    }
    window.location.href = url;
})

$("#editcontent-button-submit").unbind("click").click(function () {
    var url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    var data = $("#singcms-form").serializeArray();
    postData = {};
    $(data).each(function (i) {
        postData[this.name] = this.value;
    });

    if (!postData['class_id'] && $("#class_id_old").val()){
        postData['class_id'] = $("#class_id_old").val();
    }
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