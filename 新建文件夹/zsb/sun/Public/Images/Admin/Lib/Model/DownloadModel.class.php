<?php 
/**
 * 
 * Download(下载)
 *
 * @package      	shuguangCMS_Corp
 * @author          shuguang QQ:5565907 <web@sgcms.cn>
 * @copyright     	Copyright (c) 2008-2010  (http://www.sgcms.cn)
 * @license         http://www.sgcms.cn/license.txt
 * @version        	$Id: DownloadModel.class.php v2.0 2010-01-01 06:59:03 shuguang $

 */

import("AdvModel");
class DownloadModel extends AdvModel
{
    protected $_validate = array(
   		array('title', 'require', '文件名称必填', 0, '', Model:: MODEL_BOTH),
        array('file_size','require','文件大小必填',0,'',Model::MODEL_BOTH),
        array('description','require','描述信息必填',0,'',Model::MODEL_BOTH),
		array('content', 'require', '详细内容必填', 0, '', Model:: MODEL_BOTH),
        array('attach_file','require','必须上传文件',0,'',Model::MODEL_BOTH),
    );
    protected $_auto = array(
  		array('title', 'dHtml',Model:: MODEL_BOTH, 'function'),
		array('link_url', 'cvHttp',Model:: MODEL_BOTH, 'function'),
		array('tags', 'formatTags', Model:: MODEL_BOTH, 'function'),
		array('run_system', 'array2string', Model:: MODEL_BOTH, 'function'),
		array('create_time', 'strtotime', Model:: MODEL_BOTH, 'function'),
    );
}