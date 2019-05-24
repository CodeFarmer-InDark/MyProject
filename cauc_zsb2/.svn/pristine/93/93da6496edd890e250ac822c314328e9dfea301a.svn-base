<?php 
/**
 * 
 * Inquiry(来稿查询)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
 
import("AdvModel");
class InquiryModel extends AdvModel
{
    protected $_validate = array(
        array('id', 'require', '论文编号必填', 0, '', Model:: MODEL_BOTH),                  
        array('title', 'require', '名称必填', 0, '', Model:: MODEL_BOTH),
        array('author', 'require', '作者必填', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('id', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('title', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('author', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('createTime', 'time', Model::MODEL_INSERT, 'function'),
        array('updateTime', 'time', Model:: MODEL_BOTH, 'function'),
    );
}