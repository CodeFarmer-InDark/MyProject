//JavaScript代码区域
layui.use(['layer','element','laypage', 'form'], function(){
    var $ = layui.$,//jquery引入重点
        layer = layui.layer,
        element = layui.element,
        laypage = layui.laypage,
        form = layui.form;
    var $ = layui.jquery,
        form = layui.form,
        element = layui.element;
    /* 导航菜单切换 */
    $('.main-nav a').click(function () {
        var i = $('.main-nav a').index(this);
        $('.layui-nav-tree').hide().eq(i).show();
    });
    /* 会议切换 */
    form.on('select(meetingSelect)', function(data){
        $.ajax({
            url: meetingChange.action,
            type: meetingChange.method,
            data: $('form#meetingChange').serialize(),
            success: function (info) {
                layer.msg(info.msg);
            }
        });
        return false;
    });

    //设定搜索值
    $("#name").val('{$Think.get.name|formatQuery}');
    $("#address").val('{$Think.get.price|formatQuery}');
    $("#status option[value='{$Think.get.status}']").attr("selected",true);
    //单个删除
    $('.ajax-delete').click(function(){
        var _this = $(this);
        var subHref = _this.attr('href');
        $.ajax({
            url:subHref,
            type:'get',
            success: function (info) {
                if (info.code === 1) {
                    setTimeout(function () {
                        location.href = "__URL__";
                    }, 1000);
                }
                layer.msg(info.msg);
            }
        });
        return false;
    });
    //总页数低于页码总数
    var p = "{$Think.get.p}"; //获取当前分页数
    var url = "";
    var total = "{$Think.get.pageSize}";
    if(total){
        var num = '{$Think.get.pageSize}';
    }else{
        var num = 10;
    }

    //var count = '{$count}';
    if (p == '') { //为空时赋值1
        p = 1;
    }
    laypage.render({
        elem: 'page',
        curr: p,
        count: "{$count}", //数据总数
        layout: ['count', 'prev', 'page', 'next', 'limit', 'skip'],
        limit: num,
        limits: [10, 20, 30, 40, 50, 60, 100],
        jump: function(obj, first) {
            url = '__ACTION__'; //当前页url
            if (url.indexOf('?') >= 0) {
                url = url + '&p=' + obj.curr; //跳转url参数拼装
            } else {
                url = url + '?p=' + obj.curr; //跳转url参数拼装
            }
            if (obj.limit != 10) {
                url = url + '&pageSize=' + obj.limit;
            }
            if (!first) { //跳转必须放在这个里边，不然无限刷新
                window.location.href = url; //跳转
                //layer.msg('第'+ url +'页');
            }
        }
    });
});