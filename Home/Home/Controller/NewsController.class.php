<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\NewsModel;
class NewsController extends InitController {
    public function index(){
    	$this->display();
    }
    
    /**
     * 信息
     */
    public function info(){
    	$id = I('get.id');
    	$m = new NewsModel();
    	$tA = $m->where(array('id'=>$id))->find();
    	
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 获取新闻
     */
    public function ajaxNews(){
    	$month = I('post.month');
    	$m = new NewsModel();
    	$tA = $m->where(array('year'=>date('Y'),'month'=>$month,'status'=>1))->select();
    	echo json_encode($tA);
    }
}