<?php 
/**
 * 
 * Feedback(留言)
 *
 */
 
import("AdvModel");
class FeedbackModel extends AdvModel
{
    protected $_validate = array(
        array('title', 'require', '标题必须填写', 0, '', Model:: MODEL_BOTH),
        array('content', 'require', '内容必须填写', 0, '', Model:: MODEL_BOTH),
		array('verifyCode', 'require', '验证码必须填写', 0, '', Model:: MODEL_BOTH),
    );

    protected $_auto = array(
        array('title', 'dHtml', Model:: MODEL_BOTH, 'function'),
        array('content', 'htmlCv', Model:: MODEL_BOTH, 'function'),
        array('ip', 'get_client_ip', Model:: MODEL_BOTH, 'function'),
        array('create_time', 'time', Model:: MODEL_BOTH, 'function'),
        array('update_time', 'time', Model:: MODEL_UPDATE, 'function'),
    );
}
?>