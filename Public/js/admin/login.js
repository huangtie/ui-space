/**
 * Created by huangtie on 16/8/9.
 */

var login = {
    check : function () {
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();

        if(!username)
        {
            return dialog.error("用户名不能为空!");
        }
        if(!password)
        {
            return dialog.error("密码不能为空!");
        }

         var url = '/admin?c=login&a=login';
         var data = {'username':username,'password':password};
        $.post(url,data,function (result) {
            if(result.status == 1){
                return dialog.error(result.message);
            }
            if(result.status ==0){
                return dialog.success(result.message,'/admin.php?c=index');
            }
        },'JSON');

    }
}