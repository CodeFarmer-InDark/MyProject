<?php 
/**
 * 
 * Thesis(论文)
 *
 * @package      	Y-city Corp
 * @author          Y-city <y_city@qeeyang.com>
 * @copyright     	Copyright (c) 2008-2012  (http://www.y-city.net.cn)
 * @version        	YCITYCMS v2.2.0 2012-03-26 Y-city $

 */
 
//import("AdvModel");
class ThesisModel extends AdvModel{
    protected $_validate = array(
        array('title', 'require', '标题必填', 0, '', Model:: MODEL_BOTH),
        array('titleEn', 'require', 'Title必填', 0, '', Model:: MODEL_BOTH),
        array('author', 'require', '作者必填', 0, '', Model:: MODEL_BOTH),
        array('authorEn', 'require', 'Author必填', 0, '', Model:: MODEL_BOTH),
        array('company', 'require', '作者单位', 0, '', Model:: MODEL_BOTH),
        array('description', 'require', '论文摘要必填', 0, '', Model:: MODEL_BOTH),
        array('keyword', 'require', '关键词必填', 0, '', Model:: MODEL_BOTH),
        array('keywordEn', 'require', 'Key words必填', 0, '', Model:: MODEL_BOTH),
        array('summary', 'require', '摘要图片必填', 0, '', Model:: MODEL_BOTH),
        array('file', 'require', '论文PDF必填', 0, '', Model:: MODEL_BOTH),
        array('year', 'require', '杂志期数必填', 0, '', Model:: MODEL_BOTH),
        array('stages', 'require', '杂志期数必填', 0, '', Model:: MODEL_BOTH),
        array('column', 'require', '杂志栏目必填', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('title', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('titleEn', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('author', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('authorEn', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('company', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('description', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('keyword', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('keywordEn', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('year', 'intval', Model:: MODEL_BOTH, 'function'),
        array('stages', 'intval', Model:: MODEL_BOTH, 'function'),
        array('column', 'intval', Model:: MODEL_BOTH, 'function'),
        //array('keywords', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('createTime', 'strtotime', Model:: MODEL_BOTH, 'function'),
        array('updateTime', 'time', Model:: MODEL_BOTH, 'function'),
    );
}