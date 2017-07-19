<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\AnswerModel;
use Home\Slike\Wechat\Jssdk;
use Home\Slike\Wechat\Weixin;
use Home\Model\UserModel;

/**
 * 帮帮解答
 * @author Administrator
 */
class AnswerController extends InitController {
	
	private $TAG = array(
			'new'=>'addtime desc',
			'hot'=>'reply desc',
			'rec'=>'view desc',
		);
	
    public function index(){
    	
    	$tag = I('i');
    	if(!$tag){
    		$tag = 'new';
    	}
    	$m = new AnswerModel();
    	
    	$info = $m->getAnswerList($this->TAG[$tag]);
    	
    	
    	//print_r($info);
    	$this->assign('info',$info);
    	$this->assign('tag',$tag);
    	$this->display();
    }
    
    /**
     * 详情
     */
    public function info(){
    	$answerId = I('get.id');
    	$m = new AnswerModel();
    	
    	$tA = $m->getAnswerById($answerId);
    	
    	$reply = $m->getReplyList($answerId);
    	
    	$authority = $m->getAuthority($answerId);
    	
//     	print_r($reply);
		$isColl = (new UserModel())->isCollection($answerId,1);
    	
    	$m->answerAction(UID, $answerId,1);
    	
    	$this->assign('authority',$authority);
    	$this->assign('reply',$reply);
    	$this->assign('info',$tA);
    	$this->assign('iscoll',$isColl);
    	$this->display();
    }
    
    /**
     * 发布
     */
    public function release(){
    	$we=new Jssdk(APPID,APPSECRET);
    	$this->assign('sign',$we->getSignPackage());
    	$this->display();
    }
    
    /**
     * Ajax提交 发布问题
     */
    public function ajaxRelease(){
    	$images = I('post.images');
    	$title = I('post.title');
    	$content = I('post.content');
    	
    	$wx = new Weixin();
    //	print_r($images);
    	$imgs = $wx->downloadMEDIA($images['serverId'],'Uploads/wxPic');

    	//	print_r($res);
    	// 	print_r($_FILES);
    	
    	$m = new AnswerModel();
    	$data = array(
    			'title'=>$title,
    			'content'=>$content,
    			'user_id'=>UID,
    			'good'=>0,
    			'reply'=>0,
    			'view'=>0,
    			'addtime'=>time(),
    			'images'=>json_encode($imgs),
    			'status'=>0,
    	);
    	
    	$tId = $m->add($data);
    	if(!$tId){
    		$this->error('提交失败');
    	}
    	
    	$this->success('提交成功',U('Answer/index'));

    }
    
    
    /**
     * AJAX点赞功能提交
     */
    public function dianzan(){
    	$answerId = I('post.id');//获取ID
    	$type = I('post.type');//获取ID
    	if(!$type){
    		$type = 'answer';
    	}
    	$m = new AnswerModel();
    
    	if($type == 'answer'){
    		if($m->answerAction(UID, $answerId,2)){
    			$this->success('点赞成功');
    		}
    		$this->error('不能重复点赞');
    
    	}else if($type == 'reply'){
    
    		if($m->answerAction(UID, $answerId,3)){
    			$this->success('点赞成功');
    		}
    		$this->error('不能重复点赞');
    	}
    
    }
    
    
    /**
     * 加载更多
     */
    public function loadMore(){
    	$tag = I('post.i');
    	$page = I('post.page');
    	$size = I('post.size');
    	
    	if(!$tag){
    		$tag = 'new';
    	}
    	$m = new AnswerModel();
    	 
    	$info = $m->getAnswerList($this->TAG[$tag],(($page-1)*$size).','.$size,function($option){
    		$search = I('post.search');
    		$option['title']=array('like','%'.$search.'%');
    		return $option;
    	});
    	if(!$info){
    		$info = array();
    	}
    	echo json_encode($info);
    	
    }
    
    public function search(){
    	
    	$tag = I('post.i');
    	$page = I('post.page');
    	$size = I('post.size');
    	
    	if(!$tag){
    		$tag = 'new';
    	}
    	
    	$m = new AnswerModel();
    	
    	$tA = $m->getAnswerList($this->TAG[$tag],(($page-1)*$size).','.$size,function($option){
    		$search = I('post.search');
    		$option['title']=array('like','%'.$search.'%');
    		return $option;
    	});
    	
    	$this->success($tA,'',true);
    }
    
    /**
     * 回复功能
     */
    public function reply(){
    	$id = I('post.id');
    	$text = I('post.text');
    	 
    	if(!$text){
    		$this->error('回复内容为空');
    	}
    	$prid = I('post.prid');//回复的回复
    	if(!$prid){
    		$prid = 0;
    	}
    		
    	$mm = new AnswerModel();
    	$m = M($mm->tbAnswerReply);
    	 
    	$data = array(
    			'prid'=>$prid,
    			'answer_id'=>$id,
    			'user_id'=>UID,
    			'content'=>$text,
    			'authority'=>0,
    			'good'=>0,
    			'addtime'=>time(),
    	);
    	//添加
    	$tId = $m->add($data);
    	if (!$tId){
    		$this->error('回复失败');
    	}
    	 
    	$mm->updateReviewReply($id);
    	 
    	$this->success('回复成功');
    }
    
    /**
     * 收藏
     * @param unknown $id
     */
    public function shouc($id){
    	$this->collection(UID, $id,1);
    }
}