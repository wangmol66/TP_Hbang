<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\ReviewModel;
use Home\Model\UserModel;
class ReviewController extends InitController {
    public function index(){
    	$m = new ReviewModel();
    	$lunbo = $m->getLunbo();
    	
    	$mm = M($m->tbReivewCategory);
    	
    	$types = $mm->select();
    	$tType = array();
    	$IK = 0;
    	foreach ($types as $k=>$v){
    		$v['icon'] = $v['icon'].'?r='.rand(1,999);
    		$tType[$IK][] = $v;
    		if($k >= (($IK+1)*8)-1){
    			$IK++;
    		}
    		//print_r($v);
    	}
    	
    	$this->assign('lunbo',$lunbo);
    	$this->assign('types',$tType);
    	$this->display();
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
    	$m = new ReviewModel();
    
    	$info = $m->getAnswerList('id desc',(($page-1)*$size).','.$size,function($option){
    		
    		$search = I('post.search');
    		$typeid = I('post.typeid');
    		
    		$option['title']=array('like','%'.$search.'%');
    		if($typeid){
	    		$option['type_id']=array('like','%,'.$typeid.',%');
    		}
    		
    		return $option;
    	});

    	if(!$info){
    		$info = array();
    	}
    	echo json_encode($info);
    }
    
    /**
     * 搜索
     */
    public function search(){
    	 
    	$tag = I('post.i');
    	$page = I('post.page');
    	$size = I('post.size');
    	 
    	if(!$tag){
    		$tag = 'new';
    	}
    	 
    	$m = new ReviewModel();
    	 
    	$tA = $m->getAnswerList('id desc',(($page-1)*$size).','.$size,function($option){
    		$search = I('post.search');
    		$typeid = I('post.typeid');
    		
    		$option['title']=array('like','%'.$search.'%');
    		$option['type_id']=$typeid;
    		
    		return $option;
    	});
    		 
    		$this->success($tA,'',true);
    }
    
    /**
     * 获取详情
     */
    public function info(){
    	$id = I('get.id');
    	
    	$m = new ReviewModel();
    	$tA = $m->where(array('id'=>$id))->find();
    	
    	$log = $m->getUserLog(array($tA['id']), UID);
    	
    	$tA['addtime_1'] = date('Y-m-d H:i:s',$tA['addtime']);
    	$tA['dianzan'] = empty($log[$tA['id']])?'0':'1';
    	
    	
    	//获取评论
    	$reply = $m->getReplyList($id);
    	
    	//是否收藏
    	$isColl = (new UserModel())->isCollection($id,2);
		
    	//浏览记录
    	$m->reviewAction(UID, $id,1);
    	
    	$this->assign('reply',$reply);
    	$this->assign('info',$tA);
    	$this->assign('iscoll',$isColl);
    	$this->display();
    }
    
    
    /**
     * AJAX点赞功能提交
     */
    public function dianzan(){
    	$reviewId = I('post.id');//获取ID
    	$type = I('post.type');//获取ID
    	 
    	$m = new ReviewModel();
    	 
    	if($type == 'review'){
    		if($m->reviewAction(UID, $reviewId,2)){
    			$this->success('点赞成功');
    		}
    		$this->error('不能重复点赞');
    		
    	}else if($type == 'reply'){
    		
    		if($m->reviewAction(UID, $reviewId,3)){
    			$this->success('点赞成功');
    		}
    		$this->error('不能重复点赞');
    	}

    }
    
    /**
     * 回复功能
     */
    public function reply(){
    	$id = I('post.id');
    	$text = I('post.text');
    	
    	if(!$text){
    		$this->error('回复内容不能为空');
    	}
    	
    	$prid = I('post.prid');//回复的回复
 		if(!$prid){
 			$prid = 0;
 		}
 		
 		$mm = new ReviewModel();
    	$m = M($mm->tbReviewReply);
    	
    	$data = array(
    			'prid'=>$prid,
    			'review_id'=>$id,
    			'user_id'=>UID,
    			'content'=>$text,
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
    	$this->collection(UID, $id,2);
    }
}