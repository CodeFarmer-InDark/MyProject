$(function(){
		if($("#header_searchkeyword").val()==""||$("#header_searchkeyword").val("快速找到您需要的信息！")){$("#header_searchkeyword").val("快速找到您需要的信息！");$("#header_searchkeyword").css('color','#ccc');}   
		 $("#header_searchkeyword").focus(function(){        
			var txt_value =  $(this).val();
			if(txt_value=="快速找到您需要的信息！"){  
                $(this).val("");  
				$(this).css('color','#000');
			} 
	   });
	   $("#header_searchkeyword").blur(function(){		  
	  	    var txt_value =  $(this).val(); 
					
			if(txt_value==""){
                $(this).val("快速找到您需要的信息！");
				$(this).css('color','#ccc');
			} 
	   });		   
	});
function addCookie()
{
 if (document.all)
    {
       window.external.addFavorite('http://www.chinagas.com.cn','中国国家燃气用具质量监督检验中心');
    }
    else if (window.sidebar)
    {
       window.sidebar.addPanel('中国国家燃气用具质量监督检验中心', 'http://www.chinagas.com.cn', "");
 }
}

function setHomepage()
{
 if (document.all)
    {
        document.body.style.behavior='url(#default#homepage)';
  document.body.setHomePage('http://www.chinagas.com.cn');
 
    }
    else if (window.sidebar)
    {
    if(window.netscape)
    {
         try
   {  
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  
         }  
         catch (e)  
         {  
    alert( "该操作被浏览器拒绝，如果想启用该功能，请在地址栏内输入 about:config,然后将项 signed.applets.codebase_principal_support 值该为true" );  
         }
    } 
    var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components. interfaces.nsIPrefBranch);
    prefs.setCharPref('browser.startup.homepage','www.chinagas.com.cn');
 }
}
function tabss_z(o,o2,n,o1c,o2c){
	var m_n=document.getElementById(o).getElementsByTagName(o1c);
	var c_n=document.getElementById(o2).getElementsByTagName(o2c);
	for(i=0;i<m_n.length;i++){
		m_n[i].className=i==n?"over":"out";
		c_n[i].className=i==n?"dis":"undis";
	}
};
function search_class_change(n){
	$("#search_c").val(n-0+1);
	$("#header_searchclass>ul>li").eq(n).prependTo("#header_searchclass>ul");
	$("#header_searchclass .arror_down:first").css("visibility","visible");
}
function more_menu_hide(e,name){
	var top=$("#"+name+"_top");
	var menu=$("#"+name+"_menu");
	if((e.pageX<top.offset().left||e.pageX>=(top.offset().left+top.outerWidth())||e.pageY<top.offset().top||e.pageY>=(top.offset().top+top.outerHeight()))&&(e.pageX<menu.offset().left||e.pageX>=(menu.offset().left+menu.outerWidth())||e.pageY<menu.offset().top||e.pageY>=(menu.offset().top+menu.outerHeight()))){
		$("#"+name+"_top").removeClass(name+"_top_active").find(".arror_down").removeClass("arror_up");
		$("#"+name+"_menu").hide();
	}
}

function search_list_hide(obj){
	$(obj).removeClass("active").find("li").unbind("click").find("img:visible").removeClass("arror_up");
	if($(obj).find("li:first").attr("name")==4){
		$("#header_searchtype").css("visibility","hidden").find(".arror_down:first").css("visibility","hidden");
	}else{
		$("#header_searchtype").css("visibility","visible").find(".arror_down:first").css("visibility","visible");
	}
}

$(document).ready(function(){

$("#header_searchclass>ul>li").hover(function(){
	$(this).addClass("active");
},function(){
	$(this).removeClass("active");
})
$("#header_searchclass>ul").hover(function(){
	var obj=this;
	$(this).addClass("active").find("img:visible").addClass("arror_up").end().find("li:gt(0)").click(function(){
		$(this).removeClass("active").insertBefore($(obj).find("li:first").find("img").css("visibility","hidden").end()).find("img").css("visibility","visible");
		if($(this).parents("#header_searchclass").length){$("#search_c").val($(this).attr("name"));}
		search_list_hide(obj);
	});
},function(){
	var obj=this;
	search_list_hide(obj);
});


$("#taskpay_top").hover(function(e){
	$("#taskpay_menu").show().unbind().hover(function(e){
	},function(e){
		more_menu_hide(e,"taskpay");
	});
	$(this).addClass("taskpay_top_active").find(".arror_down").addClass("arror_up");
},function(e){
	more_menu_hide(e,"taskpay");
});

if(typeof(topchannel)!="undefined"){
	switch(topchannel){
		case "#taskindex":
			nav_channel_active(0);
			search_class_change(0);
			break;
		case "#taskweike":
			nav_channel_active(1);
			search_class_change(0);
			break;
		case "#taskzhaobiao":
			nav_channel_active(2);
			search_class_change(1);
			break;
		case "#taskzhaoji":
			nav_channel_active(3);
			search_class_change(2);
			break;
		case "#taskfuwu":
			nav_channel_active(3);
			search_class_change(2);
			break;
		case "#taskvip":
			nav_channel_active(4);
			search_class_change(3);
			break;
		default:
	}
}else{
	search_class_change(0);
}
});