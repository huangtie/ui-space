/**
 * Created by huangtie on 16/9/9.
 */

$("#item_down").click(function () {
    removeAllTopitemActive();
    $("#item_down").parent().addClass("nav_top_item_active_down");

});

$("#item_web").click(function () {
    removeAllTopitemActive();
    $("#item_web").parent().addClass("nav_top_item_active_web");

});

$("#item_collction").click(function () {
    removeAllTopitemActive();
    $("#item_collction").parent().addClass("nav_top_item_active_collction");

});

function removeAllTopitemActive() {
    $("#item_down").parent().removeClass("nav_top_item_active_down");
    $("#item_web").parent().removeClass("nav_top_item_active_web");
    $("#item_collction").parent().removeClass("nav_top_item_active_collction");
}

window.onbeforeunload = function(){
    var scrollPos;
    if (typeof window.pageYOffset != 'undefined') {
        scrollPos = window.pageYOffset;
    }
    else if (typeof document.compatMode != 'undefined' &&
        document.compatMode != 'BackCompat') {
        scrollPos = document.documentElement.scrollTop;
    }
    else if (typeof document.body != 'undefined') {
        scrollPos = document.body.scrollTop;
    }
    document.cookie="scrollTop="+scrollPos; //存储滚动条位置到cookies中
}

window.onload = function()
{
    if(document.cookie.match(/scrollTop=([^;]+)(;|$)/)!=null){
        var arr=document.cookie.match(/scrollTop=([^;]+)(;|$)/); //cookies中不为空，则读取滚动条位置
        document.documentElement.scrollTop=parseInt(arr[1]);
        document.body.scrollTop=parseInt(arr[1]);
    }
}