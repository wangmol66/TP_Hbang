<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\DoctorModel;
use Home\Model\UserModel;
class DoctorController extends InitController {
    public function index(){
    	$m = new DoctorModel();
    	$mm = M($m->tbDoctorCategory);
    	
    	$types = $mm->select();
    	$tType = array();
    	$IK = 0;
    	foreach ($types as $k=>$v){
    		$tType[$IK][] = $v;
    		if($k >= (($IK+1)*8)-1){
    			$IK++;
    		}
    	}
    	
    	//print_r($tType);
    	
    	//获取文章
    	$type_id = I('get.typeid');
    	if ($type_id){
    		$m->where(array('type_id'=>$type_id));
    	}
    	
    	$m->where(array('status'=>1));
    	
    	$tA = $m->order('addtime desc')->select();
    	foreach ($tA as $k=>$v){
    		$tA[$k]['addtime_1'] = date('Y-m-d H:i:s',$v['addtime']);
    	}
    	//print_r($tA);
    	
    	$this->assign('info',$tA);
    	$this->assign('types',$tType);
    	$this->display();
    }
    
    /**
     * 邦邦好医生详情
     */
    public function info(){
    	$id = I('get.id');
    	$m = new DoctorModel();
    	$tA = $m->where(array('id'=>$id))->find();
    	$log = $m->getUserLog($tA['id'],UID);
    	
    	$tA['addtime_1'] = date('Y-m-d H:i:s',$tA['addtime']);
    	$tA['dianzan'] = empty($log[$tA['id']])?'0':'1';
    	
    	
    	//获取评论
    	$reply = $m->getReplyList($id);
//     	print_r($reply);
    	//是否收藏
    	$isColl = (new UserModel())->isCollection($id,3);
    	
    	//查看更新一次
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
    
    	$m = new DoctorModel();
    
    	if($type == 'doctor'){
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
    		
    	$mm = new DoctorModel();
    	$m = M($mm->tbDoctorReply);
    	 
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
     * 搜索文字
     */
    public function search(){
    	$content = I('post.content');
    	$typeid = I('post.typeid');
    	
    	$m = new DoctorModel();
    	
    	if($typeid){
    		$m->where(array('type_id'=>$typeid));
    	}
    	
    	$tA = $m->where(array('title'=>array('like','%'.$content.'%')))->order('addtime desc')->select();
    	
    	foreach ($tA as $k=>$v){
    		$tA[$k]['addtime_1'] = date('Y-m-d H:i:s',$v['addtime']);
    	}
    	print_r(json_encode($tA));
    }
    
    /**
     * 收藏
     * @param unknown $id
     */
    public function shouc($id){
    	$this->collection(UID, $id,3);
    }
}