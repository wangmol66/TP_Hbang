<?php
namespace Admin\Controller;
use Admin\Model\NewsModel;

class NewsController extends AdminController {
	public function index(){
		//加载静态插件
		$this->assign('__plugins', 'uniform,select2,datatable');
		$this->assign('__sidebar', 'News/index');
		$this->assign('meta_title', '邦看讯');
		$this->display();
	}
	
	/**
	 * 新增
	 */
	public function add(){
			
		//加载静态插件
		$this->assign('__plugins', 'uniform,fileinput,ueditor,select2');
		$this->assign('__sidebar', 'News/index');
		$this->assign('title', '添加讯息');
		$this->display();
	
	}
	
	/**
	 * 新增
	 */
	public function edit(){
		$id = I('get.id');
		$m = new NewsModel();
			
		$tA = $m->where(array('id'=>$id))->find();
			
		$tA['cover_img'] = 'data:image/png;base64,'.base64_encode(@file_get_contents($tA['show_url']));
			
		//加载静态插件
		$this->assign('__plugins', 'uniform,fileinput,ueditor,select2');
		$this->assign('__sidebar', 'News/index');
		$this->assign('title', '编辑讯息');
		$this->assign('info', $tA);
		$this->display();
	
	}
	
	/**
	 *	信息
	 */
	public function info()
	{
		$id = I('get.id');
		$m = new NewsModel();
			
		$tA = $m->where(array('id'=>$id))->find();
	
		//         print_r($tA);
		//加载静态插件
		$this->assign('__plugins', 'uniform,select2,datatable');
		$this->assign('__sidebar', 'News/index');
		$this->assign('title', '讯息详情');
		$this->assign('info', $tA);
		$this->display();
	}
	
	
	/**
	 * 保存信息
	 */
	public function save(){
		$id = I('post.id');
		$title = I('post.title');
		$month = I('post.month');
		$content = I('post.content');
			
		$model = new NewsModel();
	
		if(!$title || !$content){
			$this->error('数据错误');
		}
			
		if (empty($_FILES['cover_img']) && !$id){
			$this->error('封面图不存在');
		}
			
		//开启事务
		$model->startTrans();
	
		//获取内容中的图片地址
		$path = $this->getContentPath($content);
	
		if($id){
			//编辑
			$tA = $model->where(array('id'=>$id))->find();
			$show = json_decode($tA['images'],true);
				
			foreach ($show as $k=>$v){
				if(!in_array($v, $path)){
					unlink($v);
				}
			}
		}
	
		/*添加数据*/
		$tData = array(
				'title'=>$title,
				'month'=>$month,
				'content'=>$content,
				'images'=>json_encode($path),
		);
			
		//如果ID不存在 则添加
		if (!$id){
				
			$tData['year'] = date('Y');
			$tData['status'] = 0;
			$tData['addtime'] = time();
				
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
			$tPath = $this->_uploadPicPath($_FILES['cover_img'],CONTROLLER_NAME.'/'.$tId,$tId);
			if(!$tPath['status']){
				$model->rollback();
				$this->error('上传失败');
			}
			//更新图片
			$query = $model->where(array('id'=>$tId))->save(array('show_url'=>$tPath['data']));
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
	
		$m = new NewsModel();
	
		if($title){
			$m->where(array('title'=>array('like',"%".$title."%")));
		}
	
		if($status){
			$m->where(array('status'=>($status-1)));
		}else{
			$m->where(array('status'=>array('egt',0)));
		}
	
		$tA   = $this->pagination($m);
	
		int_to_string($tA['data']);
		if( ! empty($tA['data'])){
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
										<li>
											<a href="'.$url.'" class="ajax-request-btn" alert-message="确认是否'.$status.$v['title'].'？">'.$status.'</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="'.U(CONTROLLER_NAME.'/edit/id/'.$v['id']).'" class="">
												 编辑
											</a>
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
				$tA['aaData'][$k][] = '<img src="'.$v['show_url'].'" width="30">';
				$tA['aaData'][$k][] = $v['title'];
				$tA['aaData'][$k][] = $v['year'];
				$tA['aaData'][$k][] = $v['month'];
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
				$tA['aaData'][$k][] = $this->_getStatus($v['status'],true,array('0'=>'隐藏','1'=>'显示'));
				$tA['aaData'][$k][] = $btn;
			}
		}
	
		unset($tA['data']);
		echo json_encode($tA);
	}
	
	/**
	 * 更改状态
	 * @param unknown $id
	 */
	public function changeStatus($id){
		$m = new NewsModel();
	
		$tA = $m->where(array('id'=>$id))->find();
		$status = $tA['status']==1?0:1;
	
		$query = $m->where(array('id'=>$id))->save(array('status'=>$status));
		if($query === false){
			$this->error("保存失败");
		}
		$this->success("保存成功");
	}
	
	/**
	 * 删除
	 * {@inheritDoc}
	 * @see \Admin\Controller\AdminController::delete()
	 */
	public function delete($id){
		$m = new NewsModel();
	
		$query = $m->where(array('id'=>$id))->save(array('status'=>-1));
		if($query === false){
			$this->error("保存失败");
		}
		$this->success("保存成功");
	}
	
	/**
	 * 删除
	 * {@inheritDoc}
	 * @see \Admin\Controller\AdminController::delete()
	 */
	public function checked($val,$type){
		
		if ($type == 1){
			$m = new NewsModel();
			$query = $m->where(array('id'=>array('in',$val)))->save(array('status'=>-1));
			if($query === false){
				$this->error("保存失败");
			}
			$this->success("保存成功");
		}
	}
}