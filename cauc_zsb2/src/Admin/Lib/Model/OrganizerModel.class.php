<?php 
/**
 * 
 * Organizer(杂志协办)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
 
import("AdvModel");
class OrganizerModel extends AdvModel
{
    protected $_validate = array(
        array('title', 'require', '名称必填', 0, '', Model:: MODEL_BOTH),
        array('link_url', 'require', '网址必填', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('title', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('attach_alt', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('link_url', 'cvHttp', Model:: MODEL_BOTH, 'function'),
        array('create_time', 'time', Model::MODEL_INSERT, 'function'),
        array('update_time', 'time', Model:: MODEL_UPDATE, 'function'),
    );
}