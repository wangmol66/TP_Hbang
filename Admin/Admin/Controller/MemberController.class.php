<?php

namespace Admin\Controller;
use Admin\Model\MemberModel;
use Admin\Model\OrganizationModel;
use Admin\Model\MicroModel;

class MemberController extends AdminController {
    public $tableName ='user'; //定义自己的表名
    public $tbUserStudyLog ='user_study_log'; //定义自己的表名
    public $field = 'user_id';
    public $status = 'status';
    private $model = null;
    function __construct()
    {
        parent::__construct();
        $this->model=new MemberModel();
    }

    /**
     * 后台首页
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function index(){
        $this->meta_title = '会员管理';
        //加载静态插件
        $this->assign('__plugins', 'uniform,select2,datatable');
        $this->assign('__sidebar', 'Member/index');
        $this->assign('meta_title', '会员列表');
        $this->display();
    }
    
    
    /**
     *	信息
     */
    public function info()
    {
    	$id = I('get.id');
    	$m = M((new MemberModel())->tbUser);
    		
    	$tA = $m->where(array('uid'=>$id))->find();
//     	print_r($tA);
    	//加载静态插件
    	$this->assign('__plugins', 'uniform,select2,datatable');
    	$this->assign('__sidebar', 'Doctor/index');
    	$this->assign('title', '“'.$tA['nickname'].'”的详情');
    	$this->assign('info', $tA);
    	$this->display();
    }
    
    
    /**
     * 获取用户列表
     */
    public function getList()
    {
        $nickname = trim(I('nickname'));
        $sex = trim(I('sex'));
        $subscribe = trim(I('subscribe'));
        $m = M((new MemberModel())->tbUser);
		if ($nickname){
			$m->where(array('nickname'=>array('like','%'.$nickname.'%')));
		}
		
		if ($sex){
			$m->where(array('sex'=>$sex));
		}
		
		if ($subscribe){
			$m->where(array('subscribe'=>($subscribe-1)));
		}
		
        $tA   = $this->pagination($m);

        int_to_string($tA['data']);
        if( ! empty($tA['data'])){
            foreach ($tA['data'] as $k => $v){

            	$status = $v['status'] == 1 ? '禁用' : '启用';
            	
            	$url = U('Member/changeStatus/status/1/id/'.$v['user_id']);
            	if($v['status'] == 1){
            		$url = U('Member/changeStatus/status/2/id/'.$v['user_id']);
            	}
            	
            	$btn = '<div class="btn-group">
									<a href="'.U('member/info/id/'.$v['uid']).'" class="btn btn-default btn-xs">
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
											<a href="'.U('member/edit/id/'.$v['uid']).'" class="">
												 编辑
											</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="'.U('member/delete/id/'.$v['uid']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['nickname'].'？">
												 删除
											</a>
										</li>
									</ul>-->
								</div>';

//                 $tA['aaData'][$k][] = '<input type="checkbox" name="checkList">';
                $tA['aaData'][$k][] = $v['uid'];
                $tA['aaData'][$k][] = '<img src="'.$v['headimgurl'].'" style="max-width: 33px;position: absolute;margin-top: -7px;">';
                $tA['aaData'][$k][] = $v['nickname'];
                //$tA['aaData'][$k][] = $v['openid'];
                $tA['aaData'][$k][] = $this->_getSex((empty($v['sex'])?0:$v['sex']));
                $tA['aaData'][$k][] = $v['country'].$v['province'].$v['city'];
                $tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['subscribe_time']);
                $tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
                $tA['aaData'][$k][] = $this->_getStatus((empty($v['subscribe'])?0:$v['subscribe']), true,array('1'=>'已关注','0'=>'未关注'));
                $tA['aaData'][$k][] = $btn;
            }
        }

        unset($tA['data']);
        echo json_encode($tA);
    }

    public function delete($id){
        $m = new MemberModel();
        $query = $m->delMember($id);
        if (!$query){
        	$this->error('删除失败');
        }
        $this->success('删除成功');
    }
    
    
    /**
     * 获取用户列表
     */
    public function GetScList()
    {
    	$m = M('user_collection');
    	
		$m->alias('a')
		->field('a.id,
				a.collection_id,
				a.typeid,
				a.user_id,
				a.addtime,
				IFNULL(b.title, IFNULL(c.title, d.title)) as title,e.nickname');
		
		$m->join('hbang_answer b on a.collection_id = b.id AND a.typeid = 1','LEFT');
		$m->join('hbang_review c on a.collection_id = c.id AND a.typeid = 2','LEFT');
		$m->join('hbang_doctor d on a.collection_id = d.id AND a.typeid = 3','LEFT');
		$m->join('wechat_user e on a.user_id = e.uid','LEFT');
    	$tA   = $this->pagination($m);
    	//print_r($tA);

    	int_to_string($tA['data']);
    	if( ! empty($tA['data'])){
    		foreach ($tA['data'] as $k => $v){
    
    			$status = $v['status'] == 1 ? '禁用' : '启用';
    			 
    			$url = U('Member/changeStatus/status/1/id/'.$v['user_id']);
    			if($v['status'] == 1){
    				$url = U('Member/changeStatus/status/2/id/'.$v['user_id']);
    			}
    			 
    			$btn = '<div class="btn-group">
									<a href="'.U('member/info/id/'.$v['uid']).'" class="btn btn-default btn-xs">
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
											<a href="'.U('member/edit/id/'.$v['uid']).'" class="">
												 编辑
											</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="'.U('member/delete/id/'.$v['uid']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['nickname'].'？">
												 删除
											</a>
										</li>
									</ul>-->
								</div>';
    
    			//                 $tA['aaData'][$k][] = '<input type="checkbox" name="checkList">';
    			$tA['aaData'][$k][] = $v['id'];
    			$tA['aaData'][$k][] = $v['title'];
    			$tA['aaData'][$k][] = $v['nickname'];
    			$tA['aaData'][$k][] = $this->_getType($v['typeid']);
    			$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
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
    protected function _getType($key = null, $show = false,$config = array()){
    
    	$config = array(
    			'1' => '有问邦解答',
    			'2' => '往期精彩回顾',
    			'3' => '邦邦好医声',
    	);
    
    	if($key !== null){
    
    		if(isset($config[$key]) && ! $show){
    			return $config[$key];
    		}
    
    		if(isset($config[$key]) && $show){
    
    			if($key == 0){
    				return '<span class="label label-danger">'.$config[$key].'</span>';
    			}else if($key == 1){
    				return '<span class="label label-success">'.$config[$key].'</span>';
    			}
    		}
    		return '';
    	}
    
    	return $config;
    }
}