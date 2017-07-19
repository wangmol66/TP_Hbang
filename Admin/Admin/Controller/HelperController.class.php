<?php
namespace Admin\Controller;
use Admin\Model\HelperModel;
use Admin\Model\MemberModel;

class HelperController extends AdminController {
 
	public function index(){
		//加载静态插件
		$this->assign('__plugins', 'uniform,select2,datatable');
		$this->assign('__sidebar', 'Helper/index');
		$this->assign('meta_title', '会议助手');
		$this->display();
	}
	
	public function info(){
		$id = I('get.id');
		$m = new HelperModel();
		$tA = $m
		->where(array('id'=>$id))
		->find();
		
		$um = M((new MemberModel())->tbUser);
		$User = $um->where(array('uid'=>$tA['user_id']))->find();
		
		$tA['answer'] = json_decode($tA['answer'],true);
		$tA['true'] = json_decode($tA['true'],true);
		$tA['nickname'] = $User['nickname'];
		
		//加载静态插件
		$this->assign('__plugins', 'uniform,select2,datatable');
		$this->assign('__sidebar', 'Helper/index');
		$this->assign('title', '会议详情');
		$this->assign('info', $tA);
		$this->display();
	}
	/**
	 * 获取问题列表
	 */
	public function getList()
	{
		$author = trim(I('author'));
		$title = trim(I('title'));
		$address = trim(I('address'));
		$status = trim(I('status'));
	
		$m = new HelperModel();
		$m->alias('a');
		
		if($author){
			$m->where(array('b.nickname'=>array('like','%'.$author.'%')));
		}
		
		if ($title){
			$m->where(array('a.title'=>array('like','%'.$title.'%')));
		}
		
		if ($address){
			$m->where(array('a.address'=>array('like','%'.$address.'%')));
		}
		
		if ($status){
			$m->where(array('a.status'=>($status)));
		}else{
			$m->where(array('a.status'=>array('egt',0)));
		}
		
		$m->field('a.id,a.title,b.nickname,a.address,a.content,a.is_question,a.addtime,a.status');
		$m->join('wechat_user b ON a.user_id = b.uid','LEFT');
		$tA   = $this->pagination($m);
	
		int_to_string($tA['data']);
		if( ! empty($tA['data'])){
	
			foreach ($tA['data'] as $k => $v){
	
				$status = $v['status'] == 1 ? '进行中' : '已完成';
	
				$url = U(CONTROLLER_NAME.'/changeReply/id/'.$v['rid']);
				if($v['status'] == 1){
					$url = U(CONTROLLER_NAME.'/changeReply/id/'.$v['rid']);
				}
	
	
				$btn = '<div class="btn-group">
									<a href="'.U(CONTROLLER_NAME.'/info/id/'.$v['id']).'" class="btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 详情
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<!--<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.$url.'" class="ajax-request-btn" alert-message="确认是否'.$status.$v['nickname'].'？">'.$status.'</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="'.$urla.'" class="ajax-request-btn" alert-message="确认是否'.$authority.$v['nickname'].'？">'.$authority.'</a>
										</li>
									</ul>-->
								</div>';
	
				$tA['aaData'][$k][] = '<input type="checkbox" name="checkList" >';
				$tA['aaData'][$k][] = $v['nickname'];
				$tA['aaData'][$k][] = $v['title'];
				//$tA['aaData'][$k][] = '<textarea style="height: 22px; padding: 2px; line-height: 1;" readonly="readonly" class="form-control remaks-item">'.$v['content'].'</textarea>';
				$tA['aaData'][$k][] = $v['address'];
				//$tA['aaData'][$k][] = $this->_getStatus($v['is_question'], false,array('1'=>'是','0'=>'否'));
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
				$tA['aaData'][$k][] = $this->_getStatus($v['status'], true,array('1'=>'进行中','2'=>'已完成'));
				$tA['aaData'][$k][] = $btn;
			}
		}
	
		unset($tA['data']);
		echo json_encode($tA);
	}
	
	/**
	 * 获取状态
	 *
	 * @param	integer	$key
	 * @param	boolean	$show	是否显示
	 * @return	mixed
	 */
	protected function _getStatus($key = null, $show = false,$config = array()){
	
		if (!$config){
			$config = array(
					0 => '禁用',
					1 => '启用',
			);
		}
	
		if($key !== null){
	
			if(isset($config[$key]) && ! $show){
				return $config[$key];
			}
	
			if(isset($config[$key]) && $show){
	
				if($key == 1){
					return '<span class="label label-danger">'.$config[$key].'</span>';
				}else if($key == 2){
					return '<span class="label label-success">'.$config[$key].'</span>';
				}
			}
			return '';
		}
	
		return $config;
	}
	
	/**
	 * 获取问题列表
	 */
	public function getHelperList()
	{
		$id = trim(I('id'));
	
		$m = M((new HelperModel())->tbHelperJoin);
		
		$m->alias('a');
		$m->where(array('helper_id'=>$id));
		$m->field('b.nickname,b.headimgurl,a.is_prize,a.addtime');
		$m->join('wechat_user b ON a.user_id = b.uid','LEFT');
		
		$tA   = $this->pagination($m);
		
		//print_r($tA);
		int_to_string($tA['data']);
		if( ! empty($tA['data'])){
	
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
									<a href="'.U(CONTROLLER_NAME.'/info/id/'.$v['id']).'" class="btn btn-default btn-xs">
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
											<a href="'.$urla.'" class="ajax-request-btn" alert-message="确认是否'.$authority.$v['nickname'].'？">'.$authority.'</a>
										</li>
									</ul>
								</div>';
	
				$tA['aaData'][$k][] = '<input type="checkbox" name="checkList">';
				$tA['aaData'][$k][] = '<img src="'.$v['headimgurl'].'" width="30">';
				$tA['aaData'][$k][] = $v['nickname'];
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
				$tA['aaData'][$k][] = $this->_getStatus($v['is_prize'], true,array('1'=>'是','0'=>'否'));
			}
		}
	
		unset($tA['data']);
		echo json_encode($tA);
	}
}