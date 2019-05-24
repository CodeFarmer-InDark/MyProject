<?php 
/**
 * 
 * Periodical(期刊)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
 
//import("AdvModel");
class PeriodicalModel extends AdvModel{
    protected $_validate = array(
        array('year', 'require', '年份必填', 0, '', Model:: MODEL_BOTH),
		array('stages', 'require', '期数必填', 0, '', Model:: MODEL_BOTH),
		array('digiMag', 'require', '电子杂志必填', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('year', 'intval', Model:: MODEL_BOTH, 'function'),
        array('stages', 'intval', Model:: MODEL_BOTH, 'function'),
        array('digiMag', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('createTime', 'time', Model:: MODEL_BOTH, 'function'),
        array('updateTime', 'time', Model:: MODEL_BOTH, 'function'),
    );
}