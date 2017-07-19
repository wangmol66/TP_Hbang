<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Slike\Wechat\Weixin;
use Home\Slike\Vhall\Vhall;
class IndexController extends InitController {
	
	/**
	 * 微信CODE中转站 可以转到其他地方去
	 */
	public function wechat()
	{
		$wx=new Weixin();
		$code=$wx->get_wechat_code();//调用网页授权来获取code
		$wx->send_code_self($code);
	}
	
	/**
	 * 测试
	 */
	public function test(){
		$wx=new Weixin();
		$code=$wx->code_to_host();//get_wechat_code code_to_host; //切换本地与线上授权
		echo $code;
	}
	
    public function index(){
    	//获取直播列表
    	$v = new Vhall();
    	$list = $v->getWebinarList(5,0,0,1);
    	$list = json_decode($list,true);
    	if($list['code']=='200'){
	    	$this->assign('lists',$this->ImgEmpty($list['data']['lists'],'thumb'));
	    	$this->assign('total',$list['data']['total']);
//     		print_r($list);
    	}else{
	    	$this->assign('msg',$list['msg']);
    	}
    	
    	$this->assign('shows',$this->getShows());
    	$this->display();
    }
    
    /**
     * 获取首页轮播图
     * @return mixed|boolean|string|NULL|unknown|object
     */
    public function getShows(){
    	$tA = M('hbang_shows')->select();
    	return $tA;
    }
    
    
    /**
     * 输出
     * {@inheritDoc}
     * @see \Think\Controller::get()
     */
    public function get(){
    	for ($i = 0;$i<20;$i++){
    		echo '测试'.time().'<br/>';
    		ob_flush();
    		flush();
    		sleep(1);
    	}
    	

    	
    	
    }
     
}