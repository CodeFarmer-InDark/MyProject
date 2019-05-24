<?php 
/**
 * 
 * Trend(燃气动态)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
 
//import("AdvModel");
class CompanyModel extends AdvModel
{
    protected $_validate = array(
        array('name', 'require', '公司名称必填', 0, '', Model:: MODEL_BOTH),
        array('contact', 'require', '联系人必填', 0, '', Model:: MODEL_BOTH),
        array('tel', 'require', '联系电话必填', 0, '', Model:: MODEL_BOTH),
        array('email', 'require', '邮箱必填', 0, '', Model:: MODEL_BOTH),
        array('address', 'require', '详细地址必填', 0, '', Model:: MODEL_BOTH),
        array('content', 'require', '内容必填', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('name', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('contact', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('tel', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('email', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('website', 'dHtml', Model:: MODEL_BOTH, 'function'),        
        array('address', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('content', 'htmlCv', Model:: MODEL_BOTH, 'function'),
        //array('tags', 'formatTags', Model:: MODEL_BOTH, 'function'),
        array('updateTime', 'time', Model:: MODEL_BOTH, 'function'),
    );
}