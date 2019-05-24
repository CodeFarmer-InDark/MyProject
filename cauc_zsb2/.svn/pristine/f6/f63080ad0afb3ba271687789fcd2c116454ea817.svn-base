<!--
/*JS Marquee Version 1.2(Javascript实现Marquee的效果,实现无缝/有间隙的二维滚动效果)*/
/*Author : ChenReal
  Email  : chenreal@21cn.com
  Date   : 2007-10-22*/
function Marquee(MarName)
{
 this.ID = document.getElementById(MarName);
    this.Speed = 30; //数字越大速度越慢
    this.Direction = 0;//滚动方向：0代表左;1代表右;2代表上;3代表下 
    this.Width = 0;//高度
    this.Height = 0;//宽度
 this.Space = 0;//是否有间隙：0代表否;1代表是
 this.Tag = "p";//滚动内容的标签,默认是<p>，也可以是<ul>，实践证明：<p>与<ul>不能嵌套使用。其他标签暂时不推荐。
 //开始滚动 
 this.Start = function(){
  MarqueeStart(this,this.Direction,this.Width,this.Height,this.Speed,this.Space,this.Tag);
 }
 //停止滚动并释放对象
 this.End = function(){
  MarqueeEnd(this);
 }
}
function MarqueeStart(Mar,Direction,Width,Height,Speed,Space,Tag){  
 var msobj;
 if(typeof(Mar) == "string"){
  msobj = new Marquee(Mar);
 }
 if(typeof(Mar) == "object"){
  msobj = Mar;
 }
 if(!msobj.ID) return;
 msobj.ID.style.width = Width + "px";
 msobj.ID.style.height = Height + "px";
 msobj.ID.style.overflow = msobj.ID.style.overflowX = msobj.ID.style.overflowY = "hidden";
    msobj.Direction = Direction;
    msobj.Width = Width;
    msobj.Height = Height;
    msobj.Speed = Speed;
 msobj.Space = Space;
 msobj.Tag = Tag;
    msobj.InnerDiv = msobj.ID.getElementsByTagName("div")[0];
 if(!msobj.InnerDiv) return;
    msobj.InnerDiv.innerHTML += msobj.InnerDiv.innerHTML;
    msobj.Inner = msobj.ID.getElementsByTagName(Tag); 
 if(!msobj.Inner) return;
    switch(Direction)
    {    
     case 2:  
         msobj.InnerDiv.style.width = Width + "px";
   msobj.Inner[0].style.width =Width + "px";
   msobj.Inner[1].style.width =Width + "px";
      if(Height>=msobj.Inner[1].offsetHeight || msobj.Space ==1){
       msobj.Inner[0].style.paddingTop = Height + "px";
       msobj.Inner[1].style.paddingTop = Height + "px";;
      } 
      break;
     case 3:
      msobj.InnerDiv.style.width = Width + "px";
   msobj.Inner[0].style.width =Width + "px";
   msobj.Inner[1].style.width =Width + "px";   
      if(Height>=msobj.Inner[1].offsetHeight || msobj.Space ==1){
       msobj.Inner[0].style.paddingBottom = Height + "px";
       msobj.Inner[1].style.paddingBottom = Height + "px";
      }
      break;
  default:   
      msobj.InnerDiv.noWrap = true;
   if(Width >= msobj.Inner[1].offsetWidth || msobj.Space ==1){
    msobj.Inner[0].style.paddingLeft = Width + "px";
    msobj.Inner[1].style.paddingLeft = Width + "px";
   }
      break;
    }
    
    msobj.ID.onmouseover = function(){
        clearInterval(msobj.TimerID);
    }
    
    msobj.ID.onmouseout = function(){
        clearInterval(msobj.TimerID);
        msobj.TimerID = funcInterval(MarqueeScroll,msobj.Speed,msobj);
    }
    msobj.TimerID = funcInterval(MarqueeScroll,msobj.Speed,msobj);  
 
}
function MarqueeScroll(Mar){     
    switch(Mar.Direction)
    {
        case 0: 
            if(Mar.Inner[1].offsetWidth-Mar.ID.scrollLeft<=0)
             Mar.ID.scrollLeft-=Mar.Inner[0].offsetWidth;
            else{              
             Mar.ID.scrollLeft++;
            }
        break;
        case 1:          
            if(Mar.ID.scrollLeft==0)
             Mar.ID.scrollLeft=Mar.Inner[1].offsetWidth;
            else{
             Mar.ID.scrollLeft--;
            }          
        break;
        case 2:    
            if(Mar.Inner[1].offsetHeight-Mar.ID.scrollTop<=0)
             Mar.ID.scrollTop-=Mar.Inner[0].offsetHeight;
            else{
             Mar.ID.scrollTop++;
            }
        break;
        case 3:          
            if(Mar.ID.scrollTop<=0)
             Mar.ID.scrollTop = Mar.Inner[1].offsetHeight;
            else{
             Mar.ID.scrollTop--;
            }        
        break;
    }
}
function MarqueeEnd(Mar){
 if(!Mar)return;
 if(typeof(Mar.TimerID) == "number") {
  clearInterval(Mar.TimerID);
  Mar = null;
 }
}function funcInterval(funcName,time){
  var args=[];
  for(var i=2;i<arguments.length;i++){
      args.push(arguments[i]);
  }
  return window.setInterval(function(){
            funcName.apply(this,args);
        },time);
}
//-->