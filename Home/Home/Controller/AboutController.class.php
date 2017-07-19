<?php
namespace Home\Controller;
use Think\Controller;
class AboutController extends Controller {
	
    public function index(){
    	$show = M('bang_showpic')->select();
    
    	$this->assign('show',$show);
    	$this->display();
    }
   
    /**
     * 图文编辑
     */
    public function jieshao(){
    	$id = I('get.id');
    	if(!$id){
	    	$id = 2;
    	}
    	$tA = M('about')->where(array('id'=>$id))->find();
    	
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    public function lainxi(){
    	$tA = M('about')->where(array('id'=>1))->find();
    
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 产品
     */
    public function chanpin(){
    	
    	$chanpin = M('bang_column')->select();
    	$column_id = I('type');
    	if (!$column_id){
    		$column_id = 1;
    	}
    	
    	$tA = M('bang_article')->where(array('column_id'=>array('like','%,'.$column_id.',%')))->order('sort desc')->select();
    	
    	$this->assign('info',$tA);
    	$this->assign('type',$chanpin);
    	$this->assign('column_id',$column_id);
    	$this->display('\chanpin\lists');
    }
    
    public function shows(){
    	$id = I('get.id');
    	$info= M('bang_article')->where(array('article_id'=>$id))->find();
    	
    	$tA = M('bang_article_page')->where(array('article_id'=>$id))->select();
    	
    	$this->views($id);
    	
    	$this->assign('page',$tA);
    	$this->assign('article',$info);
    	$this->display('\chanpin\shows');
    }
    /**
     * 大记事
     */
    public function dajishi(){
    	$tA = M('about_bang_news')->where(array('type'=>1))->order('id desc')->select();
    
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 研发信息
     */
    public function yanfa(){
    	$tA = M('about_bang_news')->where(array('type'=>2))->order('id desc')->select();
    
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 集团信息
     */
    public function xinxi(){
    	$tA = M('about_bang_news')->where(array('type'=>3))->order('id desc')->select();
    
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 详细信息
     */
    public function info(){
    	$tA = M('about_bang_news')->where(array('id'=>I('get.id')))->find();
    	
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 记录
     */
    public function views($showid){
    	$data = array('showid'=>$showid,'client_id'=>get_client_ip(1),'time'=>strtotime(date('Y-m-d')));
    	
    	$tA = M('bang_views')->where($data)->find();
   
    	if(!$tA){
    		$query = M('bang_views')->add($data);
    		if ($query){
    			M('bang_article')->where(array('article_id'=>$showid))->setInc('page_view');
    		}
    	}
    }
}