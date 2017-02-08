/**
 * Created by huangtie on 16/8/31.
 */

var newsIds={};
$(".news_count").each(function (i) {
    newsIds[i]=$(this).attr("news-id");
});

url = "index.php?c=index&a=getCount";

$.post(url,newsIds,function (result) {
    if (result.status==0){
        counts = result.data;
        $.each(counts,function (news_id,count) {
           $(".node-"+news_id).html(count);
        });
    }
},"json");