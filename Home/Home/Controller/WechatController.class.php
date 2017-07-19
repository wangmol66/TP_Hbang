<?php
namespace Home\Controller;

use Home\Slike\Wechat\Wechat;

class WechatController {
	
    public function index(){
    	/* 加载微信SDK */
    
    	$options = array(
    			'token'=>'TOKEN', //填写你设定的key
    			'debug'=>true,
    			'logcallback'=>'logdebug'
    	);
    	
    	$weObj = new Wechat($options);
    	
    	$weObj->valid();
    	
    	$type = $weObj->getRev()->getRevType();
    	
    	switch($type) {
    		case Wechat::MSGTYPE_TEXT:
    			$weObj->text("功能正在开发中哦~")->reply();
    			exit;
    			break;
    		case Wechat::MSGTYPE_EVENT:
    			$arr = $weObj->getRevEvent();
    			if($arr['event'] == Wechat::EVENT_SUBSCRIBE){
    				$weObj->text("点击参与第十八期华西真菌班线上直播：http://e.vhall.com/290360806")->reply();
    			}elseif($arr['event'] == 'CLICK' && $arr['key'] == 'V1001_GOOD'){
	    			$weObj->text("功能正在开发中哦~")->reply();
    			}
    			break;
    		case Wechat::MSGTYPE_IMAGE:
    			break;
    		default:
    			$weObj->text("help info")->reply();
    	}
    }
}