<?php 
namespace Home\Controller;
use Think\Controller;
use Home\Slike\Wechat\Jssdk;

class PublicController extends Controller{
	
	public function index(){
		echo '中转接口区';
	}
	
	/**
	 * 发布
	 */
	public function getSign(){
		$we=new Jssdk(APPID,APPSECRET);
		echo json_encode($we->getSignPackage());
	}
}