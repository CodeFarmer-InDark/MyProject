<?php
/**
 * 字符串截取，支持中文和其他编码
 * @static
 * @access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * @return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr"))
        $slice = mb_substr($str, $start, $length, $charset);
    elseif(function_exists('iconv_substr')) {
        $slice = iconv_substr($str,$start,$length,$charset);
        if(false === $slice) {
            $slice = '';
        }
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
    }
    //return $suffix ? $slice.'...' : $slice;
    if($str == $slice){
        return $slice;
    }else{
        return $suffix ? $slice.'...' : $slice;
    }
}

/**
 * 产生随机字串，可用来自动生成密码 默认长度6位 字母和数字混合
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
 * @return string
 */
function rand_string($len=6,$type='',$addChars='') {
    $str ='';
    switch($type) {
        case 0:
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        case 1:
            $chars= str_repeat('0123456789',3);
            break;
        case 2:
            $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZ'.$addChars;
            break;
        case 3:
            $chars='abcdefghijklmnopqrstuvwxyz'.$addChars;
            break;
        case 4:
            $chars = "们以我到他会作时要动国产的一是工就年阶义发成部民可出能方进在了不和有大这主中人上为来分生对于学下级地个用同行面说种过命度革而多子后自社加小机也经力线本电高量长党得实家定深法表着水理化争现所二起政三好十战无农使性前等反体合斗路图把结第里正新开论之物从当两些还天资事队批点育重其思与间内去因件日利相由压员气业代全组数果期导平各基或月毛然如应形想制心样干都向变关问比展那它最及外没看治提五解系林者米群头意只明四道马认次文通但条较克又公孔领军流入接席位情运器并飞原油放立题质指建区验活众很教决特此常石强极土少已根共直团统式转别造切九你取西持总料连任志观调七么山程百报更见必真保热委手改管处己将修支识病象几先老光专什六型具示复安带每东增则完风回南广劳轮科北打积车计给节做务被整联步类集号列温装即毫知轴研单色坚据速防史拉世设达尔场织历花受求传口断况采精金界品判参层止边清至万确究书术状厂须离再目海交权且儿青才证低越际八试规斯近注办布门铁需走议县兵固除般引齿千胜细影济白格效置推空配刀叶率述今选养德话查差半敌始片施响收华觉备名红续均药标记难存测士身紧液派准斤角降维板许破述技消底床田势端感往神便贺村构照容非搞亚磨族火段算适讲按值美态黄易彪服早班麦削信排台声该击素张密害侯草何树肥继右属市严径螺检左页抗苏显苦英快称坏移约巴材省黑武培著河帝仅针怎植京助升王眼她抓含苗副杂普谈围食射源例致酸旧却充足短划剂宣环落首尺波承粉践府鱼随考刻靠够满夫失包住促枝局菌杆周护岩师举曲春元超负砂封换太模贫减阳扬江析亩木言球朝医校古呢稻宋听唯输滑站另卫字鼓刚写刘微略范供阿块某功套友限项余倒卷创律雨让骨远帮初皮播优占死毒圈伟季训控激找叫云互跟裂粮粒母练塞钢顶策双留误础吸阻故寸盾晚丝女散焊功株亲院冷彻弹错散商视艺灭版烈零室轻血倍缺厘泵察绝富城冲喷壤简否柱李望盘磁雄似困巩益洲脱投送奴侧润盖挥距触星松送获兴独官混纪依未突架宽冬章湿偏纹吃执阀矿寨责熟稳夺硬价努翻奇甲预职评读背协损棉侵灰虽矛厚罗泥辟告卵箱掌氧恩爱停曾溶营终纲孟钱待尽俄缩沙退陈讨奋械载胞幼哪剥迫旋征槽倒握担仍呀鲜吧卡粗介钻逐弱脚怕盐末阴丰雾冠丙街莱贝辐肠付吉渗瑞惊顿挤秒悬姆烂森糖圣凹陶词迟蚕亿矩康遵牧遭幅园腔订香肉弟屋敏恢忘编印蜂急拿扩伤飞露核缘游振操央伍域甚迅辉异序免纸夜乡久隶缸夹念兰映沟乙吗儒杀汽磷艰晶插埃燃欢铁补咱芽永瓦倾阵碳演威附牙芽永瓦斜灌欧献顺猪洋腐请透司危括脉宜笑若尾束壮暴企菜穗楚汉愈绿拖牛份染既秋遍锻玉夏疗尖殖井费州访吹荣铜沿替滚客召旱悟刺脑措贯藏敢令隙炉壳硫煤迎铸粘探临薄旬善福纵择礼愿伏残雷延烟句纯渐耕跑泽慢栽鲁赤繁境潮横掉锥希池败船假亮谓托伙哲怀割摆贡呈劲财仪沉炼麻罪祖息车穿货销齐鼠抽画饲龙库守筑房歌寒喜哥洗蚀废纳腹乎录镜妇恶脂庄擦险赞钟摇典柄辩竹谷卖乱虚桥奥伯赶垂途额壁网截野遗静谋弄挂课镇妄盛耐援扎虑键归符庆聚绕摩忙舞遇索顾胶羊湖钉仁音迹碎伸灯避泛亡答勇频皇柳哈揭甘诺概宪浓岛袭谁洪谢炮浇斑讯懂灵蛋闭孩释乳巨徒私银伊景坦累匀霉杜乐勒隔弯绩招绍胡呼痛峰零柴簧午跳居尚丁秦稍追梁折耗碱殊岗挖氏刃剧堆赫荷胸衡勤膜篇登驻案刊秧缓凸役剪川雪链渔啦脸户洛孢勃盟买杨宗焦赛旗滤硅炭股坐蒸凝竟陷枪黎救冒暗洞犯筒您宋弧爆谬涂味津臂障褐陆啊健尊豆拔莫抵桑坡缝警挑污冰柬嘴啥饭塑寄赵喊垫丹渡耳刨虎笔稀昆浪萨茶滴浅拥穴覆伦娘吨浸袖珠雌妈紫戏塔锤震岁貌洁剖牢锋疑霸闪埔猛诉刷狠忽灾闹乔唐漏闻沈熔氯荒茎男凡抢像浆旁玻亦忠唱蒙予纷捕锁尤乘乌智淡允叛畜俘摸锈扫毕璃宝芯爷鉴秘净蒋钙肩腾枯抛轨堂拌爸循诱祝励肯酒绳穷塘燥泡袋朗喂铝软渠颗惯贸粪综墙趋彼届墨碍启逆卸航衣孙龄岭骗休借".$addChars;
            break;
        default :
            // 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
            $chars='ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789'.$addChars;
            break;
    }
    if($len>10 ) {//位数过长重复字符串一定次数
        $chars= $type==1? str_repeat($chars,$len) : str_repeat($chars,5);
    }
    if($type!=4) {
        $chars   =   str_shuffle($chars);
        $str     =   substr($chars,0,$len);
    }else{
        // 中文随机字
        for($i=0;$i<$len;$i++){
            $str.= msubstr($chars, floor(mt_rand(0,mb_strlen($chars,'utf-8')-1)),1);
        }
    }
    return $str;
}

/**
 * 获取登录验证码 默认为4位数字
 * @param string $fmode 文件名
 * @return string
 */
function build_verify ($length=4,$mode=1) {
    return rand_string($length,$mode);
}

/**
 * 字节格式化 把字节数格式为 B K M G T 描述的大小
 * @return string
 */
function byte_format($size, $dec=2) {
    $a = array("B", "KB", "MB", "GB", "TB", "PB");
    $pos = 0;
    while ($size >= 1024) {
        $size /= 1024;
        $pos++;
    }
    return round($size,$dec)." ".$a[$pos];
}

/**
 * 检查字符串是否是UTF8编码
 * @param string $string 字符串
 * @return Boolean
 */
function is_utf8($string) {
    return preg_match('%^(?:
         [\x09\x0A\x0D\x20-\x7E]            # ASCII
       | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
       |  \xE0[\xA0-\xBF][\x80-\xBF]        # excluding overlongs
       | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
       |  \xED[\x80-\x9F][\x80-\xBF]        # excluding surrogates
       |  \xF0[\x90-\xBF][\x80-\xBF]{2}     # planes 1-3
       | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
       |  \xF4[\x80-\x8F][\x80-\xBF]{2}     # plane 16
    )*$%xs', $string);
}
/**
 * 代码加亮
 * @param String  $str 要高亮显示的字符串 或者 文件名
 * @param Boolean $show 是否输出
 * @return String
 */
function highlight_code($str,$show=false) {
    if(file_exists($str)) {
        $str    =   file_get_contents($str);
    }
    $str  =  stripslashes(trim($str));
    // The highlight string function encodes and highlights
    // brackets so we need them to start raw
    $str = str_replace(array('&lt;', '&gt;'), array('<', '>'), $str);

    // Replace any existing PHP tags to temporary markers so they don't accidentally
    // break the string out of PHP, and thus, thwart the highlighting.

    $str = str_replace(array('&lt;?php', '?&gt;',  '\\'), array('phptagopen', 'phptagclose', 'backslashtmp'), $str);

    // The highlight_string function requires that the text be surrounded
    // by PHP tags.  Since we don't know if A) the submitted text has PHP tags,
    // or B) whether the PHP tags enclose the entire string, we will add our
    // own PHP tags around the string along with some markers to make replacement easier later

    $str = '<?php //tempstart'."\n".$str.'//tempend ?>'; // <?

    // All the magic happens here, baby!
    $str = highlight_string($str, TRUE);

    // Prior to PHP 5, the highlight function used icky font tags
    // so we'll replace them with span tags.
    if (abs(phpversion()) < 5) {
        $str = str_replace(array('<font ', '</font>'), array('<span ', '</span>'), $str);
        $str = preg_replace('#color="(.*?)"#', 'style="color: \\1"', $str);
    }

    // Remove our artificially added PHP
    $str = preg_replace("#\<code\>.+?//tempstart\<br />\</span\>#is", "<code>\n", $str);
    $str = preg_replace("#\<code\>.+?//tempstart\<br />#is", "<code>\n", $str);
    $str = preg_replace("#//tempend.+#is", "</span>\n</code>", $str);

    // Replace our markers back to PHP tags.
    $str = str_replace(array('phptagopen', 'phptagclose', 'backslashtmp'), array('&lt;?php', '?&gt;', '\\'), $str); //<?
    $line   =   explode("<br />", rtrim(ltrim($str,'<code>'),'</code>'));
    $result =   '<div class="code"><ol>';
    foreach($line as $key=>$val) {
        $result .=  '<li>'.$val.'</li>';
    }
    $result .=  '</ol></div>';
    $result = str_replace("\n", "", $result);
    if( $show!== false) {
        echo($result);
    }else {
        return $result;
    }
}

//输出安全的html
function h($text, $tags = null) {
    $text	=	trim($text);
    //完全过滤注释
    $text	=	preg_replace('/<!--?.*-->/','',$text);
    //完全过滤动态代码
    $text	=	preg_replace('/<\?|\?'.'>/','',$text);
    //完全过滤js
    $text	=	preg_replace('/<script?.*\/script>/','',$text);

    $text	=	str_replace('[','&#091;',$text);
    $text	=	str_replace(']','&#093;',$text);
    $text	=	str_replace('|','&#124;',$text);
    //过滤换行符
    $text	=	preg_replace('/\r?\n/','',$text);
    //br
    $text	=	preg_replace('/<br(\s\/)?'.'>/i','[br]',$text);
    $text	=	preg_replace('/<p(\s\/)?'.'>/i','[br]',$text);
    $text	=	preg_replace('/(\[br\]\s*){10,}/i','[br]',$text);
    //过滤危险的属性，如：过滤on事件lang js
    while(preg_match('/(<[^><]+)( lang|on|action|background|codebase|dynsrc|lowsrc)[^><]+/i',$text,$mat)){
        $text=str_replace($mat[0],$mat[1],$text);
    }
    while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i',$text,$mat)){
        $text=str_replace($mat[0],$mat[1].$mat[3],$text);
    }
    if(empty($tags)) {
        $tags = 'table|td|th|tr|i|b|u|strong|img|p|br|div|strong|em|ul|ol|li|dl|dd|dt|a';
    }
    //允许的HTML标签
    $text	=	preg_replace('/<('.$tags.')( [^><\[\]]*)>/i','[\1\2]',$text);
    $text = preg_replace('/<\/('.$tags.')>/Ui','[/\1]',$text);
    //过滤多余html
    $text	=	preg_replace('/<\/?(html|head|meta|link|base|basefont|body|bgsound|title|style|script|form|iframe|frame|frameset|applet|id|ilayer|layer|name|script|style|xml)[^><]*>/i','',$text);
    //过滤合法的html标签
    while(preg_match('/<([a-z]+)[^><\[\]]*>[^><]*<\/\1>/i',$text,$mat)){
        $text=str_replace($mat[0],str_replace('>',']',str_replace('<','[',$mat[0])),$text);
    }
    //转换引号
    while(preg_match('/(\[[^\[\]]*=\s*)(\"|\')([^\2=\[\]]+)\2([^\[\]]*\])/i',$text,$mat)){
        $text=str_replace($mat[0],$mat[1].'|'.$mat[3].'|'.$mat[4],$text);
    }
    //过滤错误的单个引号
    while(preg_match('/\[[^\[\]]*(\"|\')[^\[\]]*\]/i',$text,$mat)){
        $text=str_replace($mat[0],str_replace($mat[1],'',$mat[0]),$text);
    }
    //转换其它所有不合法的 < >
    $text	=	str_replace('<','&lt;',$text);
    $text	=	str_replace('>','&gt;',$text);
    $text	=	str_replace('"','&quot;',$text);
    //反转换
    $text	=	str_replace('[','<',$text);
    $text	=	str_replace(']','>',$text);
    $text	=	str_replace('|','"',$text);
    //过滤多余空格
    $text	=	str_replace('  ',' ',$text);
    return $text;
}

function ubb($Text) {
    $Text=trim($Text);
    //$Text=htmlspecialchars($Text);
    $Text=preg_replace("/\\t/is","  ",$Text);
    $Text=preg_replace("/\[h1\](.+?)\[\/h1\]/is","<h1>\\1</h1>",$Text);
    $Text=preg_replace("/\[h2\](.+?)\[\/h2\]/is","<h2>\\1</h2>",$Text);
    $Text=preg_replace("/\[h3\](.+?)\[\/h3\]/is","<h3>\\1</h3>",$Text);
    $Text=preg_replace("/\[h4\](.+?)\[\/h4\]/is","<h4>\\1</h4>",$Text);
    $Text=preg_replace("/\[h5\](.+?)\[\/h5\]/is","<h5>\\1</h5>",$Text);
    $Text=preg_replace("/\[h6\](.+?)\[\/h6\]/is","<h6>\\1</h6>",$Text);
    $Text=preg_replace("/\[separator\]/is","",$Text);
    $Text=preg_replace("/\[center\](.+?)\[\/center\]/is","<center>\\1</center>",$Text);
    $Text=preg_replace("/\[url=http:\/\/([^\[]*)\](.+?)\[\/url\]/is","<a href=\"http://\\1\" target=_blank>\\2</a>",$Text);
    $Text=preg_replace("/\[url=([^\[]*)\](.+?)\[\/url\]/is","<a href=\"http://\\1\" target=_blank>\\2</a>",$Text);
    $Text=preg_replace("/\[url\]http:\/\/([^\[]*)\[\/url\]/is","<a href=\"http://\\1\" target=_blank>\\1</a>",$Text);
    $Text=preg_replace("/\[url\]([^\[]*)\[\/url\]/is","<a href=\"\\1\" target=_blank>\\1</a>",$Text);
    $Text=preg_replace("/\[img\](.+?)\[\/img\]/is","<img src=\\1>",$Text);
    $Text=preg_replace("/\[color=(.+?)\](.+?)\[\/color\]/is","<font color=\\1>\\2</font>",$Text);
    $Text=preg_replace("/\[size=(.+?)\](.+?)\[\/size\]/is","<font size=\\1>\\2</font>",$Text);
    $Text=preg_replace("/\[sup\](.+?)\[\/sup\]/is","<sup>\\1</sup>",$Text);
    $Text=preg_replace("/\[sub\](.+?)\[\/sub\]/is","<sub>\\1</sub>",$Text);
    $Text=preg_replace("/\[pre\](.+?)\[\/pre\]/is","<pre>\\1</pre>",$Text);
    $Text=preg_replace("/\[email\](.+?)\[\/email\]/is","<a href='mailto:\\1'>\\1</a>",$Text);
    $Text=preg_replace("/\[colorTxt\](.+?)\[\/colorTxt\]/eis","color_txt('\\1')",$Text);
    $Text=preg_replace("/\[emot\](.+?)\[\/emot\]/eis","emot('\\1')",$Text);
    $Text=preg_replace("/\[i\](.+?)\[\/i\]/is","<i>\\1</i>",$Text);
    $Text=preg_replace("/\[u\](.+?)\[\/u\]/is","<u>\\1</u>",$Text);
    $Text=preg_replace("/\[b\](.+?)\[\/b\]/is","<b>\\1</b>",$Text);
    $Text=preg_replace("/\[quote\](.+?)\[\/quote\]/is"," <div class='quote'><h5>引用:</h5><blockquote>\\1</blockquote></div>", $Text);
    $Text=preg_replace("/\[code\](.+?)\[\/code\]/eis","highlight_code('\\1')", $Text);
    $Text=preg_replace("/\[php\](.+?)\[\/php\]/eis","highlight_code('\\1')", $Text);
    $Text=preg_replace("/\[sig\](.+?)\[\/sig\]/is","<div class='sign'>\\1</div>", $Text);
    $Text=preg_replace("/\\n/is","<br/>",$Text);
    return $Text;
}

// 随机生成一组字符串
function build_count_rand ($number,$length=4,$mode=1) {
    if($mode==1 && $length<strlen($number) ) {
        //不足以生成一定数量的不重复数字
        return false;
    }
    $rand   =  array();
    for($i=0; $i<$number; $i++) {
        $rand[] =   rand_string($length,$mode);
    }
    $unqiue = array_unique($rand);
    if(count($unqiue)==count($rand)) {
        return $rand;
    }
    $count   = count($rand)-count($unqiue);
    for($i=0; $i<$count*3; $i++) {
        $rand[] =   rand_string($length,$mode);
    }
    $rand = array_slice(array_unique ($rand),0,$number);
    return $rand;
}

function remove_xss($val) {
    // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
    // this prevents some character re-spacing such as <java\0script>
    // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
    $val = preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);

    // straight replacements, the user should never need these since they're normal characters
    // this prevents like <IMG SRC=@avascript:alert('XSS')>
    $search = 'abcdefghijklmnopqrstuvwxyz';
    $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $search .= '1234567890!@#$%^&*()';
    $search .= '~`";:?+/={}[]-_|\'\\';
    for ($i = 0; $i < strlen($search); $i++) {
        // ;? matches the ;, which is optional
        // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars

        // @ @ search for the hex values
        $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
        // @ @ 0{0,7} matches '0' zero to seven times
        $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
    }

    // now the only remaining whitespace attacks are \t, \n, and \r
    $ra1 = array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
    $ra2 = array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
    $ra = array_merge($ra1, $ra2);

    $found = true; // keep replacing as long as the previous round replaced something
    while ($found == true) {
        $val_before = $val;
        for ($i = 0; $i < sizeof($ra); $i++) {
            $pattern = '/';
            for ($j = 0; $j < strlen($ra[$i]); $j++) {
                if ($j > 0) {
                    $pattern .= '(';
                    $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                    $pattern .= '|';
                    $pattern .= '|(&#0{0,8}([9|10|13]);)';
                    $pattern .= ')*';
                }
                $pattern .= $ra[$i][$j];
            }
            $pattern .= '/i';
            $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
            $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
            if ($val_before == $val) {
                // no replacements were made, so exit the loop
                $found = false;
            }
        }
    }
    return $val;
}

/**
 * 把返回的数据集转换成Tree
 * @access public
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk='id',$pid = 'pid',$child = '_child',$root=0) {
    // 创建Tree
    $tree = array();
    if(is_array($list)) {
        // 创建基于主键的数组引用
        $refer = array();
        foreach ($list as $key => $data) {
            $refer[$data[$pk]] =& $list[$key];
        }
        foreach ($list as $key => $data) {
            // 判断是否存在parent
            $parentId = $data[$pid];
            if ($root == $parentId) {
                $tree[] =& $list[$key];
            }else{
                if (isset($refer[$parentId])) {
                    $parent =& $refer[$parentId];
                    $parent[$child][] =& $list[$key];
                }
            }
        }
    }
    return $tree;
}

/**
 * 对查询结果集进行排序
 * @access public
 * @param array $list 查询结果
 * @param string $field 排序的字段名
 * @param array $sortby 排序类型
 * asc正向排序 desc逆向排序 nat自然排序
 * @return array
 */
function list_sort_by($list,$field, $sortby='asc') {
    if(is_array($list)){
        $refer = $resultSet = array();
        foreach ($list as $i => $data)
            $refer[$i] = &$data[$field];
        switch ($sortby) {
            case 'asc': // 正向排序
                asort($refer);
                break;
            case 'desc':// 逆向排序
                arsort($refer);
                break;
            case 'nat': // 自然排序
                natcasesort($refer);
                break;
        }
        foreach ( $refer as $key=> $val)
            $resultSet[] = &$list[$key];
        return $resultSet;
    }
    return false;
}

/**
 * 在数据列表中搜索
 * @access public
 * @param array $list 数据列表
 * @param mixed $condition 查询条件
 * 支持 array('name'=>$value) 或者 name=$value
 * @return array
 */
function list_search($list,$condition) {
    if(is_string($condition))
        parse_str($condition,$condition);
    // 返回的结果集合
    $resultSet = array();
    foreach ($list as $key=>$data){
        $find   =   false;
        foreach ($condition as $field=>$value){
            if(isset($data[$field])) {
                if(0 === strpos($value,'/')) {
                    $find   =   preg_match($value,$data[$field]);
                }elseif($data[$field]==$value){
                    $find = true;
                }
            }
        }
        if($find)
            $resultSet[]     =   &$list[$key];
    }
    return $resultSet;
}

// 自动转换字符集 支持数组转换
function auto_charset($fContents, $from='gbk', $to='utf-8') {
    $from = strtoupper($from) == 'UTF8' ? 'utf-8' : $from;
    $to = strtoupper($to) == 'UTF8' ? 'utf-8' : $to;
    if (strtoupper($from) === strtoupper($to) || empty($fContents) || (is_scalar($fContents) && !is_string($fContents))) {
        //如果编码相同或者非字符串标量则不转换
        return $fContents;
    }
    if (is_string($fContents)) {
        if (function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($fContents, $to, $from);
        } elseif (function_exists('iconv')) {
            return iconv($from, $to, $fContents);
        } else {
            return $fContents;
        }
    } elseif (is_array($fContents)) {
        foreach ($fContents as $key => $val) {
            $_key = auto_charset($key, $from, $to);
            $fContents[$_key] = auto_charset($val, $from, $to);
            if ($key != $_key)
                unset($fContents[$key]);
        }
        return $fContents;
    }
    else {
        return $fContents;
    }
}
//自定义函数
// 循环创建目录
    function mk_dir($dir, $mode = 0777) {
        if (is_dir($dir) || @mkdir($dir, $mode))
            return true;
        if (!mk_dir(dirname($dir), $mode))
            return false;
        return @mkdir($dir, $mode);
    }

    function upload($model='',$path = 1,$fileSize = 0,$thumbStatus = 1,$thumbSize = 0,$allowExts = 0,$attachFields = 'attach_file'){
        if(attachTrue($_FILES[$attachFields]['name'])){
            $globalConfig = getContent('cms.config.php','.');
            $globalAttachSize = intval($globalConfig['global_attach_size']);
            $globalAttachSuffix = $globalConfig['global_attach_suffix'];
            $dot = '/';
            $setFolder = empty($model) ?'file/': $model .$dot ;
            $setUserPath = empty($path) ?'': makeFolderName($path) ;
            $finalPath = UPLOAD_PATH.$dot.$setFolder.$setUserPath;
            if(!is_dir($finalPath)){
                @mk_dir($finalPath);
            }
            import("Org.Net.UploadFile");
            $upload = new UploadFile();
            $upload->maxSize = empty($fileSize) ?$globalAttachSize : intval($fileSize) ;
            $upload->allowExts = empty($allowExts) ?explode(',',$globalAttachSuffix) : explode(',',$allowExts) ;
            $upload->savePath = $finalPath;
            $upload->saveRule = 'uniqid';
            switch ($model){
                case 'News':
                    $globalThumbStatus = intval($globalConfig['news_thumb_status']);;
                    $globalThumbSize = trim($globalConfig['news_thumb_size']);
                    break;
                case 'Product':
                    $globalThumbStatus = intval($globalConfig['product_thumb_status']);;
                    $globalThumbSize = trim($globalConfig['product_thumb_size']);
                    break;
                case 'Download':
                    $globalThumbStatus = intval($globalConfig['download_thumb_status']);;
                    $globalThumbSize = trim($globalConfig['download_thumb_size']);
                    break;
                default:
                    $globalThumbStatus = intval($globalConfig['global_thumb_status']);;
                    $globalThumbSize = trim($globalConfig['global_thumb_size']);
                    break;
            }
            $globalThumbSizeExplode = explode(',',$globalThumbSize);
            $userThumbSizeExplode = explode(',',$thumbSize);
            if(!empty($globalThumbStatus) &&!empty($thumbStatus)){
                $upload->thumb = true;
            }else{
                $upload->thumb = false;
            }
            if(!empty($thumbStatus) &&!empty($thumbSize)){
                $upload->thumbMaxWidth = $userThumbSizeExplode[0] ;
                $upload->thumbMaxHeight = $userThumbSizeExplode[1] ;
            }else{
                $upload->thumbMaxWidth = $globalThumbSizeExplode[0] ;
                $upload->thumbMaxHeight = $globalThumbSizeExplode[1] ;
            }
            $upload->thumbPrefix = '';
            $upload->thumbSuffix = '_s';
            if(!$upload->upload()){
                echo ($upload->getErrorMsg());
            }else{
                return $upload->getUploadFileInfo();
            }
        }
    }

    function isEnglist($param){
        if (!eregi("^[A-Z0-9]{1,26}$",$param)) {
            return false;
        }else {
            return true;
        }
    }

    function safe_b64encode($string){
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }

    function safe_b64decode($string){
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) %4;
        if ($mod4){
            $data .= substr('====',$mod4);
        }
        return base64_decode($data);
    }

    function dHtml($string){
        if(is_array($string)){
            foreach($string as $key =>$val){
                $string[$key] = dhtml($val);
            }
        }else{
            $string = str_replace(array('"','\'','<','>',"\t","\r",'{','}'),array('&quot;','&#39;','&lt;','&gt;','&nbsp;&nbsp;','','&#123;','&#125;'),$string);
        }
        return $string;
    }

    function cvHttp($http){
        if ($http == ''){
            return '';
        }else{
            $link = substr($http,0,7) == "http://"?$http : 'http://'.$http;
            return $link;
        }
    }

    function htmlCv($string){
        $pattern = array('/(javascript|jscript|js|vbscript|vbs|about):/i','/on(mouse|exit|error|click|dblclick|key|load|unload|change|move|submit|reset|cut|copy|select|start|stop)/i','/<script([^>]*)>/i','/<iframe([^>]*)>/i','/<frame([^>]*)>/i','/<link([^>]*)>/i','/@import/i');
        $replace = array('','','&lt;script${1}&gt;','&lt;iframe${1}&gt;','&lt;frame${1}&gt;','&lt;link${1}&gt;','');
        $string = preg_replace($pattern,$replace,$string);
        $string = str_replace(array('</script>','</iframe>','&#'),array('&lt;/script&gt;','&lt;/iframe&gt;','&amp;#'),$string);
        return stripslashes($string);
    }

    function splitThumb($attach){
        $splitAttach = explode('.',$attach);
        $thumb =  $splitAttach[0].'_s.'.$splitAttach[1];
        return $thumb;
    }

    function formatAttachPath($path,$find = './Public/Uploads/',$replace =''){
        if(!empty($path)){
            return str_replace($find,$replace,$path);
        }
    }

    function string2checked($sring,$param,$split = ','){
        $splitParam = explode($split,$sring);
        if (in_array($param,$splitParam)) $result = ' checked=checked';
        return $result;
    }

    function array2string($data = array(),$split = ','){
        if (is_array($data)) {
            return implode($split,$data);
        }else{
            return $data;
        }
    }

    function selected($string,$param =1,$type = 'select'){
        $returnString = '';
        if ($string == $param){
            $returnString = $type == 'select'?'selected="selected"': 'checked="checked"';
        }
        return $returnString;
    }

    function a2bc($a,$param =1,$b = '',$c = ''){
        $returnString = $a == $param ?$b : $c;
        return $returnString;
    }

    function disable($param,$typeParam =1,$stringParam = array(' disabled="disabled"','')){
        return $param == $typeParam ?$stringParam[0] : '';
    }

    function getMethod(){
        return  strtolower($_SERVER['REQUEST_METHOD']);
    }

    function getDir($dirname){
        $files = array();
        if(is_dir($dirname)){
            $fileHander = opendir($dirname);
            while (($file = readdir($fileHander)) !== false){
                $filepath = $dirname .'/'.$file;
                if (strcmp($file,'.') == 0 ||strcmp($file,'..') == 0 ||is_file($filepath)){
                    continue;
                }
                $files[] = auto_charset($file,'GBK','UTF8');;
            }
            closedir($fileHander);
        }else{
            $files = false;
        }
        return $files;
    }

    function getFile($dirname){
        $files = array();
        if(is_dir($dirname)){
            $fileHander = opendir($dirname);
            while (($file = readdir($fileHander)) !== false){
                $filepath = $dirname .'/'.$file;
                if (strcmp($file,'.') == 0 ||strcmp($file,'..') == 0 ||is_dir($filepath) ){
                    continue;
                }
                $files[] = auto_charset($file,'GBK','UTF8');;
            }
            closedir($fileHander);
        }else{
            $files = false;
        }
        return $files;
    }

    function formatQuery($string){
        return $string;
    }

    function makeFolderName($type =0,$prefix=1){
        $setPrefix = empty($prefix) ?'': '/';
        switch ($type){
            case 1: $result = date('Ym').$setPrefix ;break ;
            case 2: $result = date('Y-m').$setPrefix ;break ;
            case 3: $result = date('Ymd').$setPrefix ;break ;
            case 4: $result = date('Y-m-d').$setPrefix ;break ;
            case 5: $result = date('Y').$setPrefix ;break ;
            default: $result = date('Ym').$setPrefix ;break ;
        }
        return $result;
    }

    function attachTrue($fields,$trueNum = 0){
        if(is_array($fields)){
            foreach ($fields as $value) {
                if(!empty($value)){
                    $trueNum = $trueNum+1;
                }
            }
        }else {
            if(empty($fields)){
                $trueNum = 0;
            }else {
                $trueNum = 1;
            }
        }
        return $trueNum;
    }

    function statusIcon($data = 1,$status = 1,$folder = 0,$icon = 'hidden.png',$alt = '显示',$condition = 'eq'){
        $strStart = '<img src="';
        $strMiddle = $folder.'/Public/Admin/'.$icon;
        $strEnd = '" alt="'.$alt.'" align="absmiddle" />';
        if ($condition == 'eq'){
            if($data == $status){
                return $strStart.$strMiddle.$strEnd;
            }
        }elseif($condition == 'neq'){
            if($data != (int)$status){
                return $strStart .$strMiddle .$strEnd;
            }
        }
    }

    function attachStatus($data = 1,$status = 1,$folder = 0,$icon = 'hidden.png',$alt = '显示'){
        $string = '<img src="'.$folder.'/Public/Admin/'.$icon.'" alt="'.$alt.'" align="absmiddle" />';
        switch ($status){
            case '1':
                $returnString = !empty($data) ?$string : '';
                break;
            case '0':
                $returnString = empty($data) ?$string : '';
                break;
            default:
                $returnString = $data == $status ?$string : '';
                break;
        }
        return $returnString;
    }

    function str2time($string,$time = 0){
        if(!empty($string)){
            return strtotime($string);
        }
    }

    function createStyle($data,$style = array(),$styleArray = array()){
        $dataStyle = '';
        if($data){
            if(strtolower($data['style_color']) != '#ffffff'&&!empty($data['style_color'])){
                $style['color'] = $data['style_color'];
                $styleArray[] = 'color:'.$data['style_color'];
            }
            if(!empty($data['style_bold'])){
                $style['bold'] = $data['style_bold'];
                $styleArray[] = 'font-weight:bold';
            }
            if(!empty($data['style_underline'])){
                $style['underline'] = $data['style_underline'];
                $styleArray[] = 'TEXT-DECORATION: underline';
            }
            $dataStyle['title_style'] = empty($styleArray) ?'': implode(';',$styleArray);
            $dataStyle['title_style_serialize'] = empty($style) ?'': serialize($style);
        }
        return $dataStyle;
    }

    function string2Checkbox($string = '',$emptyString = '未定义'){
        if(empty($string)){
            $resultString = $emptyString;
        }else{
            $stringSplit = explode(',',$string);
            foreach ($stringSplit as $row){
                $resultString .= '<input name="run_system[]" type="checkbox" id="run_system[]" value="'.$row.'"/>'.$row;
            }
        }
        return $resultString;
    }

    function string2checkboxSelect($string = '',$param = '',$emptyString = '未定义'){
        if(empty($string)){
            $resultString = $emptyString;
        }else{
            $stringSplit = explode(',',$string);
            foreach ($stringSplit as $row){
                if(in_array($row,explode(',',$param))){
                    $resultString.='<input name="run_system[]" type="checkbox" id="run_system[]" value="'.$row.'" checked="checked"/> '.$row.' ';
                }else{
                    $resultString.='<input name="run_system[]" type="checkbox" id="run_system[]" value="'.$row.'"/> '.$row.' ';
                }
            }
        }
        return $resultString;
    }

    function setOrder($orderFields = 0,$selectField = 'id',$orderType = 'DESC',$join = NULL){
        $orderValue = empty($join) ?'id': 'a.id';
        foreach ((array)$orderFields as $value){
            if(is_array($value)){
                if($value[0] == $selectField){
                    $orderValue = $value[1];
                }
            }else{
                if($value == $selectField){
                    $orderValue = $value;
                }
            }
        }
        $orderByValue = empty($orderValue) ?'id': $orderValue ;
        $orderByType = empty($orderType) ?'DESC': $orderType ;
        return $orderByValue.' '.$orderByType;
    }

    function setTime($time = 0,$time1 = 0){
        $createTime = empty($time) ?0 : strtotime($time) ;
        $createTime1 = strtotime($time1) ;
        if(!empty($time1)){
            return $createTime.','.$createTime1;
        }
    }

    function setViewCount($count = 0,$count1 = 0){
        $viewCount = empty($count) ?0 : $count ;
        $viewCount1 = $count1 ;
        if(!empty($count1)){
            return $viewCount.','.$viewCount1;
        }
    }

    function styleSelected($titelStyle = 0,$type = 'color',$returnString = 'checked="checked"'){
        $result = '';
        if(!empty($titelStyle)){
            $unserialize = unserialize($titelStyle);
            switch ($type) {
                case 'color':
                    $result = empty($unserialize['color']) ?'#ffffff': $unserialize['color'];
                    break;
                case 'bold':
                    $result = empty($unserialize['bold']) ?'': $returnString ;
                    break;
                case 'underline':
                    $result = empty($unserialize['underline']) ?'': $returnString ;
                    break;
                default:
                    break;
            }
        }
        return $result;
    }

    function formatTags($data){
        if(!empty($data)){
            $tagCount = 0;
            $tag = explode(',',$data);
            foreach ($tag as $value){
                if(!empty($value)){
                    $tags[] = $value;
                    $tagCount ++;
                    if($tagCount >4) {
                        unset($tag);
                        break;
                    }
                }
            }
            return implode(',',$tags);
        }else {
            return '';
        }
    }

    function tagsGet($tags,$module = ''){
        if(!empty($tags)){
            $str = '';
            $format = explode(',',$tags);
            foreach ((array)$format as $row){
                $str .= '<a href="'.U("Tags/getList",array('module'=>$module,'name'=>urlencode($row))).'" target="_blank">'.$row.'</a> ';
            }
            echo $str;
        }
    }

    function fileExit($file){
        return file_exists($file) ?true : false ;
    }

    function explodeRole($permission,$inData = '',$field = 'role_permission'){
        if(!empty($permission)){
            if ($inData == 'all'){
                $str = '';
                $pmArray = explode('|',$permission);
                foreach ((array)$pmArray as $row){
                    $subRow = explode('=',$row);
                    if(in_array($subRow[1],explode(',',$inData))){
                        $str .= '<span style="float:left; width:20%;margin:3px 0;"><input name="'.$field.'[]" type="checkbox" id="'.$field.'[]" value="'.trim($subRow[1]).'" class="checkbox" checked="checked"/>'.trim($subRow[0]).'</span>';
                    }else{
                        $str .= '<span style="float:left; width:20%;margin:3px 0;"><input name="'.$field.'[]" type="checkbox" id="'.$field.'[]" value="'.trim($subRow[1]).'" class="checkbox" checked="checked"/>'.trim($subRow[0]).'</span>';
                    }
                }
                return $str;
            }else{
                $str = '';
                $pmArray = explode('|',$permission);
                foreach ((array)$pmArray as $row){
                    $subRow = explode('=',$row);
                    if(in_array($subRow[1],explode(',',$inData))){
                        $str .= '<span style="float:left; width:20%;margin:3px 0;"><input name="'.$field.'[]" type="checkbox" id="'.$field.'[]" value="'.trim($subRow[1]).'" class="checkbox" checked="checked"/>'.trim($subRow[0]).'</span>';
                    }else{
                        $str .= '<span style="float:left; width:20%;margin:3px 0;"><input name="'.$field.'[]" type="checkbox" id="'.$field.'[]" value="'.trim($subRow[1]).'" class="checkbox" />'.trim($subRow[0]).'</span>';
                    }
                }

                return $str;
            }

        }
    }

    function splitsql($sql) {
        $sql = str_replace("\r","\n",$sql);
        $returnSql = array();
        $num = 0;
        $queryArray = explode(";\n",trim($sql));
        unset($sql);
        foreach($queryArray as $query) {
            $queries = explode("\n",trim($query));
            foreach($queries as $query) {
                $returnSql[$num] .= $query[0] == "#"||$query[0].$query[1] == '--'?NULL : $query;
            }
            $num ++;
        }
        return($returnSql);
    }

    if(!function_exists('file_put_contents')) {
        function file_put_contents($filename,$data) {
            if($fp = @fopen($filename,'w') === false){
                exit($filename.'if not writeable');
            }else {
                $bytes = fwrite($fp,$contents);
                fclose($fp);
            }
        }
    }

    function writeCache($name = NULL,$data = NULL,$order = '',$where = '',$path = './Data/'){
        if(empty($data)){
            $dao = M($name);
            $getData = $dao->where($where)->order($order)->select();
            $fileName = strtolower($name);
            $writeData = "<?php\n/** \n* cache.{$fileName}.php\n*\n* @package      	Y-city Corp\n* @author          Y-city <y_city@qeeyang.com>\n* @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)\n* @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $\n   \n*/\n\nif (!defined('YCITYCMS')) exit();\n\nreturn ";
            $writeData .= var_export($getData,true);
            $writeData .= ';';
        }else{
            $writeData = $data;
        }
        $writeFile = 'cache.'.$fileName.'.php';
        @file_put_contents($path .$writeFile,$writeData);
        return $writeData;
    }

    function configCache($id = 1,$data = NULL,$file = NULL,$path = NULL){
        $writePath = empty($path) ?'./': $path ;
        $writeFile = empty($file) ?'fcms.config.php': $file ;
        $writeDataHeader = "<?php\n/** \n* cache.{$fileName}.php\n*\n* @package      	Y-city Corp\n* @author          Y-city <y_city@qeeyang.com>\n* @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)\n* @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $\n*/\n\nif (!defined('YCITYCMS')) exit();\n\nreturn array(\r\n";
        $writeDataFooter =  ');';
        if(empty($data)){
            $configDao = D('Config');
            $getConfig = $configDao->where("id=1")->find();
            foreach((array)$getConfig as $key =>$value){
                if(strtolower($value) == "true"||strtolower($value) == "false"||is_numeric($value)){
                    $data .= "    '".$key."' => ".dadds($value).",\r\n";
                }else{
                    $data .= "    '".$key."' => '".dadds($value)."',\r\n";
                }
            }
            $writeData = $writeDataHeader .$data .$writeDataFooter;
        }else {
            $writeData = $writeDataHeader .$data .$writeDataFooter;
        }
        @file_put_contents($writePath .$writeFile,$writeData);
        return $getConfig;
    }

    function clearCore(){
        delFile('./'.APP_PATH.'/Runtime/Cache');
        delFile('./'.APP_PATH.'/Runtime/Data');
        delFile('./'.APP_PATH.'/Runtime/Logs');
        delFile('./'.APP_PATH.'/Runtime/Temp');
        @unlink('./'.APP_PATH.'/Runtime/~app.php');
        @unlink('./'.APP_PATH.'/Runtime/~runtime.php');
        delFile('./'.YCITYCMS.'/Runtime/Cache/Home');
        delFile('./'.YCITYCMS.'/Runtime/Cache/Member');
        delFile('./'.YCITYCMS.'/Runtime/Data');
        delFile('./'.YCITYCMS.'/Runtime/Logs');
        delFile('./'.YCITYCMS.'/Runtime/Temp');
        @unlink('./'.YCITYCMS.'/Runtime/~app.php');
        @unlink('./'.YCITYCMS.'/Runtime/~runtime.php');
    }

    function delDir($directory,$subdir=true){
        if (is_dir($directory) != false){
            $handle = opendir($directory);
            while (($file = readdir($handle)) !== false){
                if ($file != "."&&$file != ".."){
                    is_dir("$directory/$file")?
                    delDir("$directory/$file"):
                    unlink("$directory/$file");
                }
            }
            if (readdir($handle) == false){
                closedir($handle);
                rmdir($directory);
            }
        }
    }

    function delFile($directory){
        if (is_dir($directory) != false){
            $handle = opendir($directory);
            while (($file = readdir($handle)) !== false){
                if ($file != "."&&$file != ".."&&is_file("$directory/$file")){
                    unlink("$directory/$file");
                }
            }
            closedir($handle);
        }
    }

    function getCache($name = '',$root = './Data/',$returnData = ''){
        $formatName = strtolower($name);
        $getFile = $root .'cache.'.$formatName .'.php';
        if(fileExit($getFile)){
            $returnData = @require($getFile);
        }else{
            switch ($formatName){
                case 'adminrole': $returnData = writeCache('AdminRole') ;break;
                case 'config': $returnData = configCache(1);break;
                case 'category': $returnData = writeCache('Category',0,'display_order DESC,id DESC') ;break;
                case 'link': $returnData = writeCache('Link',0,'display_order DESC,id DESC');break;
                case 'menu': $returnData = writeCache('Menu',0,'display_order DESC,id DESC');break;
                case 'module': $returnData = writeCache('Module');break;
            }
        }
        return $returnData;
    }

    function getContent($file = NULL,$path = NULL){
        $gFile = empty($file) ?exit('error function getFile: file is LOST') : $file ;
        $getPath = empty($path) ?DATA : $path ;
        $getFile = $getPath .'/'.$gFile;
        if(!file_exists($getFile)) die("file:$getFile is LOST");
        return @require($getFile);
    }

    function putContent($data,$file = NULL,$path = NULL){
        $pFile = empty($file) ?exit('error function getFile: file is LOST') : $file ;
        $pPath = empty($path) ?DATA : $path ;
        if ($path != '.'){
            if(!is_dir($pPath)){
                @mk_dir($pPath);
            }
        }
        $putFile = $pPath.'/'.$pFile;
        @file_put_contents($putFile,$data);
    }

    function xCopy($source,$dest,$child = 0){
        if(!is_dir($source)){
            echo("Error:the $source is not a direction!");
            exit();
        }
        if(!is_dir($dest)){
            @mk_dir($dest,0777);
        }
        $fileHander = opendir($source);
        while (($file = readdir($fileHander)) !== false){
            $filepath = $source .'/'.$file;
            if (strcmp($file,'.') == 0 ||strcmp($file,'..') == 0 ){
                continue;
            }
            if(is_dir($filepath)){
                if($child) xCopy($source."/".$file,$dest."/".$file,$child);
            }else{
                copy($source."/".$file,$dest."/".$file);
            }
        }
    }

    function copyDir($source,$dest,$child = 0){
        if(!is_dir($source)){
            echo("Error:the $source is not a direction!");
            exit();
        }
        if(!is_dir($dest)){
            @mk_dir($dest,0777);
        }
        $fileHander = opendir($source);
        while (($file = readdir($fileHander)) !== false){
            $filepath = $source .'/'.$file;
            if (strcmp($file,'.') == 0 ||strcmp($file,'..') == 0 ) continue;
            if(is_dir($filepath)){
                if($child) xCopy($source."/".$file,$dest."/".$file,$child);
            }
        }
    }

    function getCategory($array,$parentid = 0,$level = 0,$add = 2,$repeat = '　') {
        $str_repeat = '';
        if($level) {
            for($j=0;$j<$level;$j++) {
            $str_repeat .= $repeat;
            }
        }
        $newarray = array();
        $temparray = array();
        foreach((array)$array as $v) {
            if($v['parent_id'] == $parentid) {
                $newarray[] = array(
                    'id'=>$v['id'],
                    'module'=>$v['module'],
                    'title'=>$v['title'],
                    'parent_id'=>$v['parent_id'],
                    'level'=>$level,
                    'display_order'=>$v['display_order'],
                    'description'=>$v['description'],
                    'status'=>$v['status'],
                    'create_time'=>$v['create_time'],
                    'update_time'=>$v['create_time'],
                    'status'=>$v['status'],
                    'protected'=>$v['protected'],
                    'str_repeat'=>$str_repeat
                );
                $temparray = getCategory($array,$v['id'],($level +$add));
                if($temparray) {
                    $newarray = array_merge($newarray,$temparray);
                }
            }
        }
        return $newarray;
    }

    function bgStyle($data,$param = 1,$color = '#00F'){
        if($data == $param){
            return $color;
        }
    }

    function buildSelect($data,$parentId = 0,$selected = 0,$str = ''){
        $formatArray = getCategory($data,$parentId);
        foreach ((array)$formatArray as $row){
            if($row['id'] == $selected){
                $str .= '<option value="'.$row['id'] .'" selected="selected">'.$row['str_repeat'] .$row['title'] .'</option>';
            }else{
                $str .= '<option value="'.$row['id'] .'">'.$row['str_repeat'] .$row['title'] .'</option>';
            }
        }
        return $str;
    }

    function moduleTitle($name = '',$file = NULL,$path = NULL){
        $getData = getCache('Module');
        foreach ((array)$getData as $key=>$value){
            if($value['module_name'] == $name){
                echo $value['module_title'];
            }
        }
    }

    function dadds($str){
        $content = (!get_magic_quotes_gpc ()) ?addslashes($str) : $str;
        return trim($content);
    }

    function daddslashes($string, $force = 0, $strip = FALSE) {
        //字符串或数组  是否强制  是否去除
        //如果魔术引用未开启 或 $force不为0
        if(!MAGIC_QUOTES_GPC || $force) {
            if(is_array($string)) { //如果其为一个数组则循环执行此函数
                foreach($string as $key => $val) {
                    $string[$key] = daddslashes($val, $force);
                }
            } else {
            //如果魔术引用开启或$force为0
            //下面是一个三元操作符，如果$strip为true则执行stripslashes去掉反斜线字符，再执行addslashes
            //$strip为true的，也就是先去掉反斜线字符再进行转义的为$_GET,$_POST,$_COOKIE和$_REQUEST $_REQUEST数组包含了前三个数组的值
            //这里为什么要将＄string先去掉反斜线再进行转义呢，因为有的时候$string有可能有两个反斜线，stripslashes是将多余的反斜线过滤掉
                $string = addslashes($strip ? stripslashes($string) : $string);
            }
        }
        return $string;
    }

    function categoryModule($data){
        foreach ((array)$data as $row){
            if(in_array($row['module_name'],array('News','Product','Download','Job','Link','Ad'))){
                $datas[] = $row;
            }
        }
        return $datas;
    }

    function selectCategory($slid){
        $category = getCache('Category');
        foreach ((array)$category as $c){
            if($c['id'] == $slid){
                echo $c['title'];
            }
        }
    }

    function selectCategoryId($slid){
        $category = getCache('Category');
        foreach ((array)$category as $c){
            if($c['id'] == $slid){
                echo $c['id'];
            }
        }
    }

    function explodeUrl($url,$img = ''){
        $str = empty($url) ?'': explode("\n",$url);
        foreach ((array)$str as $key=>$row){
            $key = $key+1;
            $result .= "<a href='$row' target='_blank'><img src='$img' align='absmiddle'/>下载地址 $key</a><br />";
        }
        echo $result;
    }

    function sysmd5($str,$key='',$type='sha1'){
        $key =  $key ?  $key : C('ADMIN_ACCESS');
        return hash ( $type, $str.$key );
    }

    /**
    * @param string $string 原文或者密文
    * @param string $operation 操作(ENCODE | DECODE), 默认为 DECODE
    * @param string $key 密钥
    * @param int $expiry 密文有效期, 加密时候有效， 单位 秒，0 为永久有效
    * @return string 处理后的 原文或者 经过 base64_encode 处理后的密文
    *
    * @example
    *
    *  $a = authcode('abc', 'ENCODE', 'key');
    *  $b = authcode($a, 'DECODE', 'key');  // $b(abc)
    *
    *  $a = authcode('abc', 'ENCODE', 'key', 3600);
    *  $b = authcode('abc', 'DECODE', 'key'); // 在一个小时内，$b(abc)，否则 $b 为空
    */
    function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
    {
        $ckey_length = 4;
        // 随机密钥长度 取值 0-32;
        // 加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
        // 取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
        // 当此值为 0 时，则不产生随机密钥

        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);
        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) :
            sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);
        $result = '';
        $box = range(0, 255);
        $rndkey = array();
        for($i = 0; $i <= 255; $i++){
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }
        for($j = $i = 0; $i < 256; $i++){
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for($a = $j = $i = 0; $i < $string_length; $i++){
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if($operation == 'DECODE'){
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)){
                return substr($result, 26);
            }
            else{
                return '';
            }
        }
        else{
            return $keyc.str_replace('=', '', base64_encode($result));
        }
    }
    /**
    * @param string $string 原文或者密文
    * @param string $operation 操作(ENCODE | DECODE), 默认为 ENCODE
    * @param string $key 密钥
    */
    function url_auth($txt, $operation = 'ENCODE', $key = '') {
        $key    = $key ? $key : C('ADMIN_ACCESS');
        $txt    = $operation == 'ENCODE' ? $txt : base64_decode($txt);
        $len    = strlen($key);
        $code    = '';
        for ($i=0; $i<strlen($txt); $i++) {
            $k        = $i % $len;
            $code  .= $txt[$i] ^ $key[$k];
        }
        $code = $operation == 'DECODE' ? $code : base64_encode($code);
        return $code;
    }
    // 计算身份证校验码，根据国家标准GB 11643-1999
    function idcard_verify_number($idcard_base) {
        if(strlen($idcard_base) != 17) {
            return false;
        }
        //加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码对应值
        $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        $checksum = 0;
        for ($i = 0; $i < strlen($idcard_base); $i++) {
            $checksum += substr($idcard_base, $i, 1) * $factor[$i];
        }
        $mod = $checksum % 11;
        $verify_number = $verify_number_list[$mod];
        return $verify_number;
    }
    // 18位身份证校验码有效性检查
    function idcard_check($idcard){
        if (strlen($idcard) != 18){ return false; }
        $idcard_base = substr($idcard, 0, 17);
        if (idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1))){
            return false;
        }else{
            return true;
        }
    }
    /**
     * pkcs7补码
     *
     * @param string $string  明文
     * @param int $blocksize Blocksize , 以 byte 为单位
     *
     * @return String
     */
    function addPkcs7Padding($string, $blocksize = 32) {
        $len = strlen($string); //取得字符串长度
        $pad = $blocksize - ($len % $blocksize); //取得补码的长度
        $string .= str_repeat(chr($pad), $pad); //用ASCII码为补码长度的字符， 补足最后一段
        return $string;
    }
//    /**
//     * 加密然后base64转码
//     *
//     * @param String 明文
//     * @param 加密的初始向量（IV的长度必须和Blocksize一样， 且加密和解密一定要用相同的IV）
//     * @param $key 密钥
//     */
//    function aes256cbcEncrypt($str, $iv, $key ) {
//        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, addPkcs7Padding($str) , MCRYPT_MODE_CBC, $iv));
//    }

    /**
     * 加密然后base64转码
     *
     * @param String 明文
     * @param 加密的初始向量（IV的长度必须和Blocksize一样， 且加密和解密一定要用相同的IV）
     * @param $key 密钥
     */
    //function aes256cbcEncrypt($str,  $iv = 'qwertyuioplkjhgfdsazxcvbnmqwertz', $key = '12345678901234567890123456789012' ) {
    //    return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, addPkcs7Padding($str) , MCRYPT_MODE_CBC, $iv));
    //}
    function aes256cbcEncrypt($str,  $iv = '117bd4e24f1cf5642a0332cf38014d08', $key = '117bd4e24f1cf5642a0332cf38014d08' ) {
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, addPkcs7Padding($str) , MCRYPT_MODE_CBC, $iv));
    }
    /**
     * 除去pkcs7 padding
     *
     * @param String 解密后的结果
     *
     * @return String
     */
    function stripPkcs7Padding($string){
        $slast = ord(substr($string, -1));
        $slastc = chr($slast);
        $pcheck = substr($string, -$slast);
        if(preg_match("/$slastc{".$slast."}/", $string)){
            $string = substr($string, 0, strlen($string)-$slast);
            return $string;
        } else {
            return false;
        }
    }
//    /**
//     * 解密
//     *
//     * @param String $encryptedText 二进制的密文
//     * @param String $iv 加密时候的IV
//     * @param String $key 密钥
//     *
//     * @return String
//     */
//    function aes256cbcDecrypt($encryptedText, $iv, $key) {
//        $encryptedText =base64_decode($encryptedText);
//        return stripPkcs7Padding(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encryptedText, MCRYPT_MODE_CBC, $iv));
//    }

    /**
     * 解密
     *
     * @param String $encryptedText 二进制的密文
     * @param String $iv 加密时候的IV
     * @param String $key 密钥
     *
     * @return String
     */
    function aes256cbcDecrypt($encryptedText, $iv = '117bd4e24f1cf5642a0332cf38014d08', $key = '117bd4e24f1cf5642a0332cf38014d08') {
        $encryptedText =base64_decode($encryptedText);
        return stripPkcs7Padding(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encryptedText, MCRYPT_MODE_CBC, $iv));
    }

    function content_page($content,$id){
        $contents=split(C('PAGE_BREAK_TAG'),$content);
        $totalsize=count($contents);
        import('ORG.Util.Page');
        $pagesize=1;
        $PageParam = C("VAR_PAGE");
        $page = new Page($totalsize,$pagesize);
        //$page->setLinkWraper("li");
        //$page->SetPager('default', $pagetpl, array("listlong" => "6", "first" => "首页", "last" => "尾页", "prev" => "上一页", "next" => "下一页", "list" => "*", "disabledclass" => ""));
        $page->parameter   .=   $id.'/';
        $content=$contents[$page->firstRow];
        $data['content']=$content;
        if(1 !== count($contents)){
            $data['page']=$page->show();
        }
        return $data;
    }
    function htmlSubString($content,$maxlen=300){
        //把字符按HTML标签变成数组。
        $content = preg_split("/(<[^>]+?>)/si",$content, -1,PREG_SPLIT_NO_EMPTY| PREG_SPLIT_DELIM_CAPTURE);
    $wordrows=0; //中英字数
    $outstr="";  //生成的字串
    $wordend=false; //是否符合最大的长度
    $beginTags=0; //除<img><br><hr>这些短标签外，其它计算开始标签，如<div*>
    $endTags=0;  //计算结尾标签，如</div>，如果$beginTags==$endTags表示标签数目相对称，可以退出循环。
    //print_r($content);
    foreach($content as $value){
        if (trim($value)=="") continue; //如果该值为空，则继续下一个值
        if (strpos(";$value","<")>0){
            //如果与要载取的标签相同，则到处结束截取。
            if (trim($value)==$maxlen) {
                $wordend=true;
                continue;
            }
            if ($wordend==false){
                $outstr.=$value;
                if (!preg_match("/<img([^>]+?)>/is",$value) && !preg_match("/<param([^>]+?)>/is",$value) && !preg_match("/<!([^>]+?)>/is",$value) && !preg_match("/<br([^>]+?)>/is",$value) && !preg_match("/<hr([^>]+?)>/is",$value)) {
                    $beginTags++; //除img,br,hr外的标签都加1
                }
            }else if (preg_match("/<\/([^>]+?)>/is",$value,$matches)){
                $endTags++;
                $outstr.=$value;
                if ($beginTags==$endTags && $wordend==true) break; //字已载完了，并且标签数相称，就可以退出循环。
            }else{
                if (!preg_match("/<img([^>]+?)>/is",$value) && !preg_match("/<param([^>]+?)>/is",$value) && !preg_match("/<!([^>]+?)>/is",$value) && !preg_match("/<br([^>]+?)>/is",$value) && !preg_match("/<hr([^>]+?)>/is",$value)) {
                    $beginTags++; //除img,br,hr外的标签都加1
                    $outstr.=$value;
                }
            }
        }else{
            if (is_numeric($maxlen)){ //截取字数
                $curLength=getStringLength($value);
                $maxLength=$curLength+$wordrows;
                if ($wordend==false){
                    if ($maxLength>$maxlen){ //总字数大于要截取的字数，要在该行要截取
                        $outstr.=subString($value,0,$maxlen-$wordrows);
                        $wordend=true;
                    }else{
                        $wordrows=$maxLength;
                        $outstr.=$value;
                    }
                }
            }else{
                if ($wordend==false) $outstr.=$value;
            }
        }
    }
    //循环替换掉多余的标签，如<p></p>这一类
    while(preg_match("/<([^\/][^>]*?)><\/([^>]+?)>/is",$outstr)){
        $outstr=preg_replace_callback("/<([^\/][^>]*?)><\/([^>]+?)>/is","strip_empty_html",$outstr);
    }
    //把误换的标签换回来
    if (strpos(";".$outstr,"[html_")>0){
        $outstr=str_replace("[html_&lt;]","<",$outstr);
        $outstr=str_replace("[html_&gt;]",">",$outstr);
    }
    //echo htmlspecialchars($outstr);
    return $outstr;
    }
    //取得字符串的长度，包括中英文。
    function getStringLength($text){
        if (function_exists('mb_substr')) {
            $length=mb_strlen($text,'UTF-8');
        } elseif (function_exists('iconv_substr')) {
            $length=iconv_strlen($text,'UTF-8');
        } else {
            preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $text, $ar);
            $length=count($ar[0]);
        }
        return $length;
    }
    /***********按一定长度截取字符串（包括中文）*********/
    function subString($text, $start=0, $limit=12) {
        if (function_exists('mb_substr')) {
            $more = (mb_strlen($text,'UTF-8') > $limit) ? TRUE : FALSE;
            $text = mb_substr($text, 0, $limit, 'UTF-8');
            $text = $text.'...';
            return $text;
        } elseif (function_exists('iconv_substr')) {
            $more = (iconv_strlen($text,'UTF-8') > $limit) ? TRUE : FALSE;
            $text = iconv_substr($text, 0, $limit, 'UTF-8');
            $text = $text.'...';
            //return array($text, $more);
            return $text;
        } else {
            preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $text, $ar);
            if(func_num_args() >= 3) {
                if (count($ar[0])>$limit) {
                    $more = TRUE;
                    $text = join("",array_slice($ar[0],0,$limit));
                } else {
                    $more = FALSE;
                    $text = join("",array_slice($ar[0],0,$limit));
                }
            } else {
                $more = FALSE;
                $text =  join("",array_slice($ar[0],0));
            }
            return $text;
        }
    }
    function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }

    /**
     * 使用curl获取远程数据
     * @param  string $url url连接
     * @return string      获取到的数据
     */
    function curl_get_contents($url){
        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);                //设置访问的url地址
        // curl_setopt($ch,CURLOPT_HEADER,1);               //是否显示头部信息
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);               //设置超时
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);   //用户访问代理 User-Agent
        curl_setopt($ch, CURLOPT_REFERER,$_SERVER['HTTP_HOST']);        //设置 referer
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);          //跟踪301
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);        //返回结果
        $r=curl_exec($ch);
        curl_close($ch);
        return $r;
    }


function encrypt($string,$operation,$key=''){
    $key=md5($key);
    $key_length=strlen($key);
    $string=$operation=='D'?base64_decode($string):substr(md5($string.$key),0,8).$string;
    $string_length=strlen($string);
    $rndkey=$box=array();
    $result='';
    for($i=0;$i<=255;$i++){
        $rndkey[$i]=ord($key[$i%$key_length]);
        $box[$i]=$i;
    }
    for($j=$i=0;$i<256;$i++){
        $j=($j+$box[$i]+$rndkey[$i])%256;
        $tmp=$box[$i];
        $box[$i]=$box[$j];
        $box[$j]=$tmp;
    }
    for($a=$j=$i=0;$i<$string_length;$i++){
        $a=($a+1)%256;
        $j=($j+$box[$a])%256;
        $tmp=$box[$a];
        $box[$a]=$box[$j];
        $box[$j]=$tmp;
        $result.=chr(ord($string[$i])^($box[($box[$a]+$box[$j])%256]));
    }
    if($operation=='D'){
       if(substr($result,0,8)==substr(md5(substr($result,8).$key),0,8)){
           return substr($result,8);
      }else{
           return'';
      }
    }else{
        return str_replace('=','',base64_encode($result));
    }
}
/**
 * 去除多维数组中的空值
 * @author
 * @param $arr array 目标数组
 * @param array $values 去除的值  默认 去除  '',null,false,0,'0',[]
 * @return mixed
 */
function filter_array($arr, $values = ['', null, false, 0, '0',[]]) {
    foreach ($arr as $k => $v) {
        if (is_array($v) && count($v)>0) {
            $arr[$k] = filter_array($v, $values);
            foreach ($values as $value) {
                if ($arr[$k] === $value) {
                    unset($arr[$k]);
                    break;
                }
            }
        }
        foreach ($values as $value) {
            if ($v === $value) {
                unset($arr[$k]);
                break;
            }
        }
    }
    return $arr;
}

//生成正确专业名称
function correctZyname($zy){
    //根据配置项特殊处理重复专业代码的专业
    /*$getConfig = getContent('cms.config.php','.');
    $special_zydm = explode(',',str_replace('，',',',$getConfig['zyfx']));//配置中特殊项
    if (in_array($zy['zydm'],$special_zydm)){
        $zyname = $zy['zymc'];
    }else{
        $condition = [];
        $condition['year'] = $zy['year'];
        $condition['zydm'] = $zy['zydm'];
        $zymc = M('Zy')->where($condition)->field('zymc,zyfx')->find();
        if ($zymc['zyfx'] != ''){
            $zyname = $zymc['zymc'].'('.$zymc['zyfx'].')';
        }else{
            $zyname = $zymc['zymc'];
        }
    }
    if (($zy['provinceid'] == 15 and $zy['jhxz'] == 1) OR (strstr($zy['zymc'],'定向'))){
        $zyname = str_replace('定向','',$zyname);
        $zyname = $zyname.'（定向）';
    }
    return $zyname;*/

    //根据配置项特殊处理重复专业代码的专业
    $getConfig = getContent('cms.config.php','..');
    $special_zydm = explode(',',str_replace('，',',',$getConfig['zyfx']));//配置中特殊项
    if (in_array($zy['zydm'],$special_zydm)){
        if ($zy['zydm'] == '600409'){
            $zy['zymc'] = str_replace('（','(',$zy['zymc']);
            $temp = explode('(',$zy['zymc']);
            if(strstr($zy['zymc'],'直升机')){
                $zyname = is_null($temp[0])?'':$temp[0].'（直升机）';
            }else{
                $zyname = is_null($temp[0])?'':$temp[0];
            }
        }elseif($zy['zydm'] == '600401'){
            if ($zy['year'] < 2018){
                if(strpos($zy['zymc'], '地面')){
                    $zyname = '民航运输（地面服务）';
                }elseif(strpos($zy['zymc'], '机场')||strpos($zy['zymc'], '指挥')){
                    $zyname = '民航运输（机场指挥）';
                }elseif(strpos($zy['zymc'], '通航')||strpos($zy['zymc'], '服务')){
                    $zyname = '民航运输（通航综合航务）';
                }else{
                    $zyname = '民航运输';
                }
            }else{
                $zyname = '民航运输';
            }
        }else{
            $zyname = $zy['zymc'];
        }

    }else{
        $condition = [];
        $condition['year'] = $zy['year'];
        if ($zy['zydm'] == '120200'){
            $zy['zydm'] = 1202;
        }
        $condition['zydm'] = $zy['zydm'];
        $zymc = M('Zy')->where($condition)->field('zymc,zyfx')->find();
        if ($zymc['zyfx'] != ''){
            $zyname = $zymc['zymc'].'('.$zymc['zyfx'].')';
        }else{
            $zyname = $zymc['zymc'];
        }
    }
    if (($zy['provinceid'] == 15 and $zy['jhxz'] == 1) OR (strstr($zy['zymc'],'定向'))){
        $zyname = str_replace('定向','',$zyname);
        $zyname = $zyname.'（定向）';
    }
    return $zyname;
}