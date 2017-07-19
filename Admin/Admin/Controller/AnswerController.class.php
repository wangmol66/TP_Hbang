<?php
namespace Admin\Controller;
use Admin\Model\AnswerModel;
use Admin\Model\MemberModel;

class AnswerController extends AdminController {
    public function index(){
    	//加载静态插件
    	$this->assign('__plugins', 'uniform,select2,datatable');
    	$this->assign('__sidebar', 'Answer/index');
    	$this->assign('meta_title', '邦邦列表');
    	$this->display();
    }
    
    public function info(){
    	$answerId = I('get.id');
    	$m = new AnswerModel();
    	$tA = $m->getAnswerById($answerId);
//     	print_r($tA);
    	//加载静态插件
    	$this->assign('__plugins', 'uniform,select2,datatable');
    	$this->assign('__sidebar', 'Answer/index');
    	$this->assign('info', $tA);
    	$this->assign('meta_title', '问题详情');
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

    	$m = new AnswerModel();
    	
    	if($title){
    		$m->where(array('title'=>array('like','%'.$title.'%')));
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
    		
    		foreach ($tA['data'] as $k => $v){
    
    			$status = $v['status'] == 1 ? '隐藏' : '显示';
    			 
    			$url = U(CONTROLLER_NAME.'/changeStatus/id/'.$v['id']);
    			if($v['status'] == 1){
    				$url = U(CONTROLLER_NAME.'/changeStatus/id/'.$v['id']);
    			}
    			 
    			$btn = '<div class="btn-group">
									<a href="'.U(CONTROLLER_NAME.'/info/id/'.$v['id']).'" class="btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 详情
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<!--<li>
											<a href="'.$authurl.'" class="ajax-request-btn" alert-message="确认是否'.$auth.$v['nickname'].'？">'.$auth.'</a>
										</li>
										<li class="divider">
										</li>-->
										<li>
											<a href="'.$url.'" class="ajax-request-btn" alert-message="确认是否'.$status.$v['nickname'].'？">'.$status.'</a>
										</li>
										<li class="divider">
										</li>
										<!--<li>
											<a href="'.U('member/edit/id/'.$v['user_id']).'" class="">
												 编辑
											</a>
										</li>
										<li class="divider">
										</li>-->
										<li>
											<a href="'.U(CONTROLLER_NAME.'/delete/id/'.$v['id']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['nickname'].'？">
												 删除
											</a>
										</li>
									</ul>
								</div>';
    
    			$tA['aaData'][$k][] = '<input type="checkbox" name="checkList" class="checkable" value="'.$v['id'].'">';
    			$tA['aaData'][$k][] = $v['title'];
    			$tA['aaData'][$k][] = $tUser[$v['user_id']]['nickname'];
    			//$tA['aaData'][$k][] = '<textarea style="height: 22px; padding: 2px; line-height: 1;" readonly="readonly" class="form-control remaks-item">'.$v['content'].'</textarea>';
    			$tA['aaData'][$k][] = $v['good'];
    			$tA['aaData'][$k][] = $v['reply'];
    			$tA['aaData'][$k][] = $v['view'];
    			$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
    			$tA['aaData'][$k][] = $this->_getStatus($v['status'], true,array('1'=>'显示','0'=>'隐藏'));
    			$tA['aaData'][$k][] = $btn;
    		}
    	}
    
    	unset($tA['data']);
    	echo json_encode($tA);
    }
    
    /**
     * 获取问题列表
     */
    public function getReplyList()
    {
    	$id = trim(I('id'));
    
    	$m = M((new AnswerModel())->tbAnswerReply);
    	$m->where(array('answer_id'=>$id));
    	$m->order('prid asc');
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
    
    		foreach ($tA['data'] as $k => $v){
    
    			$status = $v['status'] == 1 ? '禁用' : '启用';
    
    			$url = U(CONTROLLER_NAME.'/changeReply/id/'.$v['rid']);
    			if($v['status'] == 1){
    				$url = U(CONTROLLER_NAME.'/changeReply/id/'.$v['rid']);
    			}
    			
    			$authority = $v['authority'] == 1 ? '撤销权威' : '设置权威';
    			
    			$urla = U(CONTROLLER_NAME.'/changeAuthority/id/'.$v['rid']);
    			if($v['authority'] == 1){
    				$urla = U(CONTROLLER_NAME.'/changeAuthority/id/'.$v['rid']);
    			}
    			
    			$btn = '<div class="btn-group">
									<a href="'.U(CONTROLLER_NAME.'/deleteReply/id/'.$v['rid']).'" alert-message="确认是否删除'.$v['user_id']['nickname'].'？" class="ajax-request-btn btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 删除
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.$url.'" class="ajax-request-btn" alert-message="确认是否'.$status.$v['nickname'].'？">'.$status.'</a>
										</li>';
				if($v['prid'] == 0){
						
										
    				$btn .=	'	<li class="divider"></li>
										<li>
											<a href="'.$urla.'" class="ajax-request-btn" alert-message="确认是否'.$authority.'？只能设置一个权威答案,是否替换？">'.$authority.'</a>
										</li>';
				}					
    			$btn .=	'	</ul>
								</div>';
					
    			$tA['aaData'][$k][] = '<input type="checkbox" name="checkList" class="checkable" value="'.$v['id'].'">';
    			$tA['aaData'][$k][] = $tUser[$v['user_id']]['nickname'];
    			$tA['aaData'][$k][] = '<textarea style="height: 22px; padding: 2px; line-height: 1;" readonly="readonly" class="form-control remaks-item">'.$v['content'].'</textarea>';
    			$tA['aaData'][$k][] = $v['good'];
    			$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
    			$tA['aaData'][$k][] = $this->_getStatus($v['authority'], true,array('1'=>'是','0'=>'否'));
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
    public function changeAuthority(){
    	$id = I('get.id');
    		
    	$m = M((new AnswerModel())->tbAnswerReply);
    
    	$tA = $m->where(array('rid'=>$id))->find();
    
    	$m->where(array('answer_id'=>$tA['answer_id']))->save(array('authority'=>0));
    
    	$status = $tA['authority'] == 1?0:1;
    		
    	$query = $m->where(array('rid'=>$id))->save(array('authority'=>$status));
    	if ($query === false){
    		$this->error('保存失败');
    	}
    	$this->success('保存成功');
    }
    
    
    /**
     * 改变状态
     * @param unknown $id
     */
    public function changeStatus($id){
    	$m = new AnswerModel();
    	$tA = $m->where(array('id'=>$id))->find();
    	
    	$status = $tA['status']==1?0:1;
    	
    	$query = $m->where(array('id'=>$id))->save(array('status'=>$status));
    	if (!$query){
    		$this->error('保存失败');
    	}
    	$this->success('保存成功');
    }
    
    public function delete(){
    	$id = I('get.id');
    	
    	$m = new AnswerModel();
    	$query = $m->where(array('id'=>$id))->save(array('status'=>-1));
    	if ($query === FALSE){
    		$this->error('删除失败');
    	}
    	
    	$this->success('删除成功');
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
    
    
    
    
    
    public function checked($val,$type){
    	
    	if($type == 1){
    		$m = new AnswerModel();
    		$query = $m->where(array('id'=>array('in',$val)))->save(array('status'=>-1));
    		
    		if($query === false){
    			$this->error('删除失败');;
    		}
    		$this->success('删除成功');
    	}
    }
    
    
}














