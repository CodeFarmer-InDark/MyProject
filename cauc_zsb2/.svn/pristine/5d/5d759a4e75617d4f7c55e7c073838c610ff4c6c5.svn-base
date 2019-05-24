<?php 
/**
 * 
 * News(新闻)
 *
 * @package      	shuguangCMS_Corp
 * @author          shuguang QQ:5565907 <web@sgcms.cn>
 * @copyright     	Copyright (c) 2008-2010  (http://www.sgcms.cn)
 * @license         http://www.sgcms.cn/license.txt
 * @version        	$Id: NoticeModel.class.php v2.0 2010-01-01 06:59:03 shuguang $

 */
 
import("AdvModel");
class BriefModel extends AdvModel 
{
    protected $_validate = array(
        array('attach_file','require','必须上传文件',0,'',Model::MODEL_BOTH),
        array('tags','require','标签必填',0,'',Model::MODEL_BOTH),
    );
    protected $_auto = array(
        array('title', 'dHtml', Model:: MODEL_BOTH, 'function'),       
        array('create_time', 'time', Model:: MODEL_BOTH, 'function'),     
        array('update_time', 'time', Model:: MODEL_UPDATE, 'function'),      
    );
}