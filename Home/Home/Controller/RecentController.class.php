<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Slike\Vhall\Vhall;
class RecentController extends InitController {
    public function index(){
    	//获取直播列表
    	$v = new Vhall();
    	$list = $v->getWebinarList(5,0,0,array(2));
    	$list = json_decode($list,true);
    	
    	if($list['code']=='200'){
    		
    		$list = $this->ImgEmpty($list['data']['lists'],'thumb');
    		$list = $this->hasFollow($list);
//     		print_r($list);
    		$this->assign('lists',$list);
    		$this->assign('total',count($list));
    	}else{
    		$this->assign('msg',$list['msg']);
    	}
    	
    	$this->display();
    }
    
    /**
     * 检测是否关注
     * @param array $list
     * @return number
     */
    public function hasFollow($list = array()){
    	
    	foreach ($list as $k=>$v){
    		$list[$k]['isFollow'] = 0;
    		if(A('Follow')->hasFollow(UID.'_'.$v['webinar_id'])){
    			$list[$k]['isFollow'] = 1;
    		}
    	}
    	
    	return $list;
    }
    
    public function past(){
    	//获取直播列表
    	$v = new Vhall();
    	$list = $v->getWebinarList(5,0,0,array(3));
    	$list = json_decode($list,true);
    	
    	if($list['code']=='200'){
    		$this->assign('lists',$this->ImgEmpty($list['data']['lists'],'thumb'));
    		$this->assign('total',$list['data']['total']);
    	}else{
    		$this->assign('msg',$list['msg']);
    	}
    	 
    	$this->display();
    }
}