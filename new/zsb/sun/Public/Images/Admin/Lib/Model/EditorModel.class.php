<?php 
/**
 * 
 * Editor(编辑)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
 
import("AdvModel");
class EditorModel extends AdvModel
{
    protected $_validate = array(
        array('name', 'require', '姓名必填', 0, '', Model:: MODEL_BOTH),
        array('tel', 'require', '工作电话必填', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('name', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('tel', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('mobile', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('createTime', 'time', Model::MODEL_INSERT, 'function'),
        array('updateTime', 'time', Model:: MODEL_BOTH, 'function'),
    );
}