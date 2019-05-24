<?php 
/**
 * 
 * Instruction(考生须知)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
 
import("AdvModel");
class InstructionModel extends AdvModel
{
    protected $_validate = array(
        array('title', 'require', '标题必填', 0, '', Model:: MODEL_BOTH),
        array('content', 'require', '内容必填', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('title', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('link_url', 'cvHttp', Model:: MODEL_BOTH, 'function'),
        array('tags', 'formatTags', Model:: MODEL_BOTH, 'function'),
        array('create_time', 'strtotime', Model:: MODEL_BOTH, 'function'),
        array('update_time', 'time', Model:: MODEL_UPDATE, 'function'),
    );
}