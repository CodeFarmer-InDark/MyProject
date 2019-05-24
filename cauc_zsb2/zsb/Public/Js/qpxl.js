//首页大广告
var gg960ShowTime = 10000; //播放时间

function open_gg960(showBtn){
    $('.gg_full .gg_fcon').html(gg960Con).slideDown(300,function(){
        if(showBtn !== false){
            $('.gg_full .gg_fbtn').fadeIn();
        }
        gg960Time = setTimeout(close_gg960,gg960ShowTime);
    });
}
function close_gg960(){
    $('.gg_full .gg_fcon').slideUp(500,function(){
        $(this).html('');
        $('.gg_fclose').hide();
        $('.gg_freplay').show();
    });
}
$('.gg_fclose').click(function(){
    close_gg960();
    return false;
});
$('.gg_freplay').click(function(){
    open_gg960(false);
    $('.gg_freplay').hide();
    $('.gg_fclose').show();
    return false;
});

var gg960Con;
var fullAdUrl = './baoming'
gg960Con = '<a href="'+fullAdUrl+'" target="_blank"><img width="980" height="400" src="/public/images/qpad.jpg"/></a>';//flash无法显示时，显示JPG广告
setTimeout(open_gg960,1500);//延迟显示