<?php
namespace Admin\Controller;
use Admin\Model\AnswerModel;
use Admin\Model\MemberModel;

class ReplyController extends AdminController {
	
	public function index(){
		//加载静态插件
		$this->assign('__plugins', 'uniform,select2,datatable');
		$this->assign('__sidebar', 'Reply/index');
		$this->assign('meta_title', '回复列表');
		$this->display();
	}
	
	
	/**
	 * 获取问题列表
	 */
	public function getList()
	{
		$title = trim(I('get.title'));
		$author = trim(I('get.author'));
		$status = trim(I('get.status'));
	
		$m = M((new AnswerModel())->tbAnswerReply);
		
		if($title){
			$mm = new AnswerModel();
			$tAnswer = $mm->where(array('title'=>array('like','%'.$title.'%')))->select();
			
			$tAid = array();
			
			foreach ($tAnswer as $k=>$v){
				if (!in_array($v['id'],$tAid)){
					$tAid[] = $v['id'];
				}
			}
			
			if($tAid){
				$m->where(array('answer_id'=>array('in',$tAid)));
			}else{
				$m->where(array('answer_id'=>array('in',array(0))));
			}
		}
		
		if($author){
			$um = new MemberModel();
			$tUser = M($um->tbUser)->where(array('nickname'=>array('like','%'.$author.'%')))->select();
		
			$tUid = array();
		
			foreach ($tUser as $k=>$v){
				if (!in_array($v['uid'],$tUid)){
					$tUid[] = $v['uid'];
				}
			}
			//print_r($tUid);
			if($tUid){
				$m->where(array('user_id'=>array('in',$tUid)));
			}else{
				$m->where(array('user_id'=>array('in',array(0))));
			}
		}
		
		if ($status){
			$m->where(array('status'=>($status-1)));
		}else{
			$m->where(array('status'=>array('egt',0)));
		}
		
		$tA   = $this->pagination($m);
	
		int_to_string($tA['data']);
		
		
		if( ! empty($tA['data'])){
			$uid = array();
			foreach ($tA['data'] as $k=>$v){
				if(!in_array($v['user_id'], $uid)){
					$uid[] = $v['user_id'];
				}
			}
	
			$um = M((new MemberModel())->tbUser);
	
			$tUA = $um->where(array('uid'=>array('in',$uid)))->select();
			$tUser = array();
			foreach ($tUA as $k=>$v){
				$tUser[$v['uid']] = $v;
			}
			
			$aid = array();
			foreach ($tA['data'] as $k=>$v){
				if(!in_array($v['answer_id'], $aid)){
					$aid[] = $v['answer_id'];
				}
			}
			
			$um = new AnswerModel();
			
			$tUA = $um->where(array('id'=>array('in',$aid)))->select();
			$tAnswer = array();
			foreach ($tUA as $k=>$v){
				$tAnswer[$v['id']] = $v;
			}
			
	
			foreach ($tA['data'] as $k => $v){
	
				$status = $v['status'] == 1 ? '禁用' : '启用';
				
				$url = U(CONTROLLER_NAME.'/changeReply/id/'.$v['rid']);
				if($v['status'] == 1){
					$url = U(CONTROLLER_NAME.'/changeReply/id/'.$v['rid']);
				}
				

				
				$btn = '<div class="btn-group">
									<a href="'.U('Answer/info/id/'.$v['answer_id']).'"  class="btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 详情
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.$url.'" class="ajax-request-btn" alert-message="确认是否'.$status.$v['nickname'].'？">'.$status.'</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="'.U(CONTROLLER_NAME.'/deleteReply/id/'.$v['rid']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['user_id']['nickname'].'？">删除</a>
										</li>
									</ul>
								</div>';
				
				$tA['aaData'][$k][] = '<input type="checkbox" name="checkList">';
				$tA['aaData'][$k][] = $tUser[$v['user_id']]['nickname'];
				//$tA['aaData'][$k][] = '<textarea style="height: 22px; padding: 2px; line-height: 1;" readonly="readonly" class="form-control remaks-item">'.$v['content'].'</textarea>';
				//$tA['aaData'][$k][] = $v['good'];
				$tA['aaData'][$k][] = $tAnswer[$v['answer_id']]['title'];
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
				$tA['aaData'][$k][] = $this->_getStatus($v['status'], true,array('1'=>'显示','0'=>'隐藏'));
				$tA['aaData'][$k][] = $btn;
			}
		}
	
		unset($tA['data']);
		echo json_encode($tA);
	}
	
	
	/**
	 * 改变回复状态
	 */
	public function changeReply(){
		$id = I('get.id');
		 
		$m = M((new AnswerModel())->tbAnswerReply);
		 
		$tA = $m->where(array('rid'=>$id))->find();
		 
		$status = $tA['status'] == 1?0:1;
		 
		$query = $m->where(array('rid'=>$id))->save(array('status'=>$status));
		if ($query === false){
			$this->error('保存失败');
		}
		$this->success('保存成功');
	}
	
	
	/**
	 * 改变回复状态
	 */
	public function deleteReply(){
		$id = I('get.id');
		 
		$mm = new AnswerModel();
		$m = M($mm->tbAnswerReply);
		$m->startTrans();
		 
		$query = $m->where(array('rid'=>$id))->delete();
		if ($query === false){
			$m->rollback();
			$this->error('保存失败');
		}
		 
		$query = $m->where(array('prid'=>$id))->delete();
		 
		if ($query === false){
			$m->rollback();
			$this->error('保存失败');
		}
	
		$m->commit();
		$this->success('保存成功');
	}
}