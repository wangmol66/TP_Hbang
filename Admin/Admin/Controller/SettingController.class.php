<?php
namespace Admin\Controller;
use Admin\Model\SettingModel;
class SettingController extends AdminController {
    public function index(){
    }
    
    public function lunbo(){
    	
    	//加载静态插件
    	$this->assign('__plugins', 'datatable,dropify');
    	$this->assign('__sidebar', 'Setting/lunbo');
    	$this->assign('title','大咖会客室');
    	$this->assign('meta_title','直播轮播图');
    	$this->display();
    }
    
    public function getLunbo(){
    	$id = I('get.id');
    	$m = M(SettingModel::$tbShows);
    	
    	$tA = $m->where(array('id'=>$id))->find();
    	
    	echo json_encode($tA);
    }
    	
    public function lunboList(){
		
    	$m = M(SettingModel::$tbShows);
    	$m->order('sort asc');
    	$tA   = $this->pagination($m);
    
    	int_to_string($tA['data']);
    	if( ! empty($tA['data'])){
    		foreach ($tA['data'] as $k => $v){
    	
    			$status = $v['status'] == 1 ? '禁用' : '启用';
    	
    			$url = U('User/changeStatus/method/resumeUser/id/'.$v['uid']);
    			if($v['status'] == 1){
    				$url = U('User/changeStatus/method/forbidUser/id/'.$v['uid']);
    			}
    	
    			$btn = '<div class="btn-group">
									<a href="'.U('Setting/sortLunbo/id/'.$v['id']).'" class="btn btn-default btn-xs ajax-request-btn-no">
										<i class="fa fa-lock"></i> 上移
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.U('Setting/getLunbo/id/'.$v['id']).'" class="edit">
												 编辑
											</a>
										</li>
										<li>
											<a href="'.U('Setting/deleteLunbo/id/'.$v['id']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['nickname'].'？">
												 删除
											</a>
										</li>
									</ul>
								</div>';
    	
    			$tA['aaData'][$k][] = $v['id'];
    			$tA['aaData'][$k][] = '<img src="'.$v['show_url'].'?r='.rand(0,99).'" style="max-width:300px;">';
    			$tA['aaData'][$k][] = $v['url'];
    			$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
    			$tA['aaData'][$k][] = $btn;
    		}
    	}
    	
    	unset($tA['data']);
    	echo json_encode($tA);
    }
    
    /**
     * 删除轮播图
     */
    public function deleteLunbo(){
    	$id = I('get.id');
    	
    	$tA = M(SettingModel::$tbShows)->where(array('id'=>$id))->find();
    	
    	
    	
    	$query = M(SettingModel::$tbShows)->where(array('id'=>$id))->delete();
    	
    	if ($query === false){
    		$this->error('删除失败');
    	}
    	
    	unlink($tA['show_url']);
    	$this->success('删除成功');
    }
    
    public function sortLunbo(){
    	$id = I('get.id');
    	
    	$tA = M(SettingModel::$tbShows)->where(array('id'=>$id))->find();
    	if($tA['sort']){
    		M(SettingModel::$tbShows)->where(array('sort'=>($tA['sort']-1)))->setInc('sort');
	    	M(SettingModel::$tbShows)->where(array('id'=>$id))->setDec('sort');
    		
    	}else {
    		$this->error('已经是最顶上了');
    	}
    	 
    	$this->success('上移成功');
    }
    /**
     * 保存 和编辑轮播图
     */
    public function saveLunbo(){
    	$id = I('post.id');
    	$url = I('post.url');
    	
    	if(empty($_FILES['show_url']) && !$id){
    		$this->error('没有图片');
    	}
    	
    	$m = M(SettingModel::$tbShows);
    	

    	
    	$m->startTrans();
    	
    	$data = array(
    			'url'=>$url,
    	);
    	
    	if ($id){
    		$query = $m->where(array('id'=>$id))->save($data);
    		
    		if ($query === false){
    			$m->rollback();
    			$this->error('保存失败');
    		}
    	}else {
    		$data['addtime'] = time();
    		$data['sort'] = $m->count();
    		
    		$tId = $m->add($data);
    		if (!$tId){
    			$m->rollback();
    			$this->error('保存失败');
    		}
    	}
    	
    	$tId = $id?:$tId;
    	
    	if (!empty($_FILES['show_url'])){
    		/*检测图片*/
    		$tPath = $this->_uploadPicPath($_FILES['show_url'],CONTROLLER_NAME,$tId);
    		if(!$tPath['status']){
    			$m->rollback();
    			$this->error('上传失败');
    		}
    		//更新图片
    		$query = $m->where(array('id'=>$tId))->save(array('show_url'=>$tPath['data']));
    		if ($query === false){
    			$m->rollback();
    			unlink($tPath['data']);
    			$this->error('保存失败');
    		}
    	}
    	
    	$m->commit();
    	$this->success('保存成功');
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}