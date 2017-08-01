<?php
namespace Admin\Controller;
use Admin\Model\QuestionModel;

class ActiveController extends AdminController{
    public function index(){
    	//列出备份文件列表
    	$title = '活动管理';
    	
    	$this->assign('__plugins', 'uniform,datatable,select2');
    	$this->assign('__sidebar', 'Active/index');
    	//渲染模板
    	$this->assign('meta_title', $title);
    	$this->assign('meta_title_top', $title_top);
    	$this->display();
    }
    
    
    /**
     * 获取章节列表
     */
    public function getList(){
    	$queType = I('get.que_type');
    	$que_score = I('get.que_score');
    	$title = I('get.que_title');
    
    	$m =M((new QuestionModel())->tbCacheQuestionPackage);
    
    	if($queType){
    		$m->where(array('type'=>$queType));
    	}
    
    	if($que_score){
    		$m->where(array('que_score'=>$que_score));
    	}
    
    	if($title){
    		$m->where(array('title'=>array('like','%'.$title.'%')));
    	}
    
    	$m->order('id asc');
    	$m->where(array('status'=>array('egt',0)));
    	$tA   = $this->pagination($m);
    
    	int_to_string($tA['data']);
    	if( ! empty($tA['data'])){
    			
    		foreach ($tA['data'] as $k => $v){
    
    			$btn = '<div class="btn-group">
									<a href="'.U(CONTROLLER_NAME.'/info/id/'.$v['id']).'" class="btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 详情
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.U(CONTROLLER_NAME.'/getPackageInfo/id/'.$v['id']).'" class="edit">
												 编辑
											</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="'.U(CONTROLLER_NAME.'/deletePackage/id/'.$v['id']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['title'].'？">
												 删除
											</a>
										</li>
									</ul>
								</div>';
    
    			$tA['aaData'][$k][] = '<input type="checkbox" class="checkable" name="checkList" value="'.$v['id'].'">';
    			$tA['aaData'][$k][] = $v['title'];
    			$tA['aaData'][$k][] = $this->_PackageType($v['type'],true);
    			$tA['aaData'][$k][] = $v['total_score'];
    			$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
    			$tA['aaData'][$k][] = $btn;
    		}
    	}
    	unset($tA['data']);
    	echo json_encode($tA);
    }
}