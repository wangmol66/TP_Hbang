<?php
namespace Admin\Controller;
use Admin\Model\ReviewLunboModel;
use Admin\Model\ReviewModel;

class ReviewLunboController extends AdminController {
	public function index(){
		//加载静态插件
		$this->assign('__plugins', 'uniform,select2,datatable');
		$this->assign('__sidebar', 'ReviewLunbo/index');
		$this->assign('meta_title', '轮播');
		$this->display();
	}
	
	/**
	 * 新增
	 */
	public function add(){
		$m = new ReviewModel();
		$tA = $m->select();
		//加载静态插件
		$this->assign('__plugins', 'uniform,fileinput,ueditor,select2');
		$this->assign('__sidebar', 'ReviewLunbo/index');
		$this->assign('title', '添加轮播');
		$this->assign('list', $tA);
		$this->display();
	
	}
	
	
	/**
	 * 新增
	 */
	public function edit(){
		$id = I('get.id');
		$mm = new ReviewModel();
		$m = M($mm->tbReivewLunbo);
			
		$tList = $mm->select();
		
		$tA = $m->where(array('id'=>$id))->find();
// 		print_r($tA);
		$tA['cover_img'] = 'data:image/png;base64,'.base64_encode(@file_get_contents(strstr($tA['show_url'], '?',true)));
			
		//加载静态插件
		$this->assign('__plugins', 'uniform,fileinput,ueditor,select2');
		$this->assign('__sidebar', 'ReviewLunbo/index');
		$this->assign('title', '编辑文章');
		$this->assign('info', $tA);
		$this->assign('list', $tList);
		$this->display();
	
	}
	
	
	/**
	 * 保存信息
	 */
	public function save(){
		$id = I('post.id');
		$oid = I('post.review_id');
		$model = M((new ReviewModel())->tbReivewLunbo);
			
		if (empty($_FILES['cover_img']) && !$id){
			$this->error('封面图不存在');
		}
			
		//开启事务
		$model->startTrans();
		
		$count = $model->count();
		/*添加数据*/
		$tData = array(
				'oid'=>$oid,
		);
			
		//如果ID不存在 则添加
		if (!$id){
			$tData['addtime'] = time();
			$tData['srot'] = $count+1;
			//添加
			$tId = $model->add($tData);
			if (!$tId){
				$model->rollback();
				$this->error('保存失败');
			}
		}else{
			//更新
			$query = $model->where(array('id'=>$id))->save($tData);
				
			if ($query === false){
				$model->rollback();
				$this->error('保存失败');
			}
		}
			
		$tId = $id?:$tId;
			
		if (!empty($_FILES['cover_img'])){
			/*检测图片*/
			$tPath = $this->_uploadPicPath($_FILES['cover_img'],CONTROLLER_NAME,$tId);
			if(!$tPath['status']){
				$model->rollback();
				$this->error('上传失败');
			}
			//更新图片
			$query = $model->where(array('id'=>$tId))->save(array('show_url'=>$tPath['data'].'?r='.rand(0,99999)));
			if ($query === false){
				$model->rollback();
				unlink($tPath['data']);
				$this->error('保存失败');
			}
		}
		$model->commit();
		$this->success('保存成功',U('index'));
	}
	
	/**
	 * 获取列表
	 */
	public function getList(){
		$title = trim(I('title'));
		$status = trim(I('status'));
	
		$m = M((new ReviewModel())->tbReivewLunbo);
	
		if($status){
			$m->where(array('status'=>($status-1)));
		}else{
			$m->where(array('status'=>array('egt',0)));
		}
		$m->order('sort asc');
		$tA   = $this->pagination($m);
	
		int_to_string($tA['data']);
		if( ! empty($tA['data'])){
			foreach ($tA['data'] as $k => $v){
	
				$btn = '<div class="btn-group">
									<a href="'.U(CONTROLLER_NAME.'/edit/id/'.$v['id']).'" class="btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 编辑
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.U(CONTROLLER_NAME.'/sort/id/'.$v['id']).'" class="ajax-request-btn" alert-message="确认是否上移'.$v['title'].'？">上移</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="'.U(CONTROLLER_NAME.'/delete/id/'.$v['id']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['title'].'？">
												 删除
											</a>
										</li>
									</ul>
								</div>';
	
				$tA['aaData'][$k][] = '<input type="checkbox" name="checkList" class="checkable" value="'.$v['id'].'">';
				$tA['aaData'][$k][] = '<img src="'.$v['show_url'].'" width="300">';
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
				$tA['aaData'][$k][] = $btn;
			}
		}
	
		unset($tA['data']);
		echo json_encode($tA);
	}
	
	
	/**
	 * 排序移动
	 */
	public function sort(){
		$id = I('get.id');
		$m = M((new ReviewModel())->tbReivewLunbo);
			
		$tA = $m->where(array('id'=>$id))->find();
		
		$sort = $tA['sort'];
		if($sort == 1){
			$this->error("已经是第一张了");
		}
		$query1 = $m->where(array('sort'=>$sort-1))->setInc('sort');
		
		$query2 = $m->where(array('id'=>$id))->setDec('sort');
		
		if($query1 === false || $query2 === false){
			$this->error("上移失败");
		}
		
		$this->success('上移成功');
	}
	
	/**
	 * 真正删除图片 和数据
	 */
	public function delete(){
		$id = I('get.id');
		$m = M((new ReviewModel())->tbReivewLunbo);
			
		$tA = $m->where(array('id'=>$id))->find();
		
		if(unlink(strstr($tA['show_url'], '?',true))){
			$query = $m->where(array('id'=>$id))->delete();
			if($query === false){
				$this->error("删除失败");
			}
			
			$this->success('删除成功');
		}else {
			$this->error("图片删除失败");
		}
	}
	
	/**
	 * 真正删除图片 和数据
	 */
	public function checked(){
		$val = I('post.val');
		$type = I('post.type');
		$m = M((new ReviewModel())->tbReivewLunbo);
			
		if($type == 1){
			$tA = $m->where(array('id'=>array('in',$val)))->select();
			
			foreach ($tA as $k=>$v){
				unlink(strstr($v['show_url'], '?',true));
			}
			
			
			$query = $m->where(array('id'=>array('in',$val)))->delete();
			if($query === false){
				$this->error("删除失败");
			}
				
			$this->success('删除成功');
		}
		
		$this->error('暂无操作');
	}
}