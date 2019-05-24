<?php 
/**
 * 
 * Option(问题选项)
 *
 * @package      	shuguangCMS_Corp
 * @author          shuguang QQ:5565907 <web@sgcms.cn>
 * @copyright     	Copyright (c) 2008-2010  (http://www.sgcms.cn)
 * @license         http://www.sgcms.cn/license.txt
 * @version        	$Id: NoticeModel.class.php v2.0 2010-01-01 06:59:03 shuguang $

 */
 
import("AdvModel");
class OptionModel extends AdvModel 
{
    protected $_validate = array(
        array('question', 'require', '问题名称必填', 1, '', 2),
    );

    protected $_auto = array(       
        array('create_time', 'time', 1, 'function'),     
        array('update_time', 'time', 2, 'function'),      
    );
}