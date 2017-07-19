<?php
namespace Admin\Controller;
use Admin\Model\ReviewModel;
use Admin\Model\MemberModel;

class ReviewController extends AdminController {
	public function index(){
		//加载静态插件
		$this->assign('__plugins', 'uniform,select2,datatable');
		$this->assign('__sidebar', 'Review/index');
		$this->assign('meta_title', '往期精彩回顾');
		$this->display();
	}
	
	/**
	 * 新增
	 */
	public function add(){
		$mm = new ReviewModel();
		$m = M($mm->tbReivewCategory);
		
		$tCategory = $m->select();
		
		//加载静态插件
		$this->assign('__plugins', 'uniform,fileinput,ueditor,select2');
		$this->assign('__sidebar', 'Review/index');
		$this->assign('title', '添加文章');
		$this->assign('types', $tCategory);
		$this->display();
	
	}
	
	/**
	 * 新增
	 */
	public function edit(){
		 $id = I('get.id');
		 $m = new ReviewModel();
		 
		 $tA = $m->where(array('id'=>$id))->find();
		 
		 $tA['cover_img'] = 'data:image/png;base64,'.base64_encode(@file_get_contents($tA['show_url']));
		 $tA['type_id'] = explode(',', $tA['type_id']);
		 $mm = M($m->tbReivewCategory);
		 
		 $tCategory = $mm->select();
		//加载静态插件
		$this->assign('__plugins', 'uniform,fileinput,ueditor,select2');
		$this->assign('__sidebar', 'Review/index');
		$this->assign('title', '编辑文章');
		$this->assign('info', $tA);
		$this->assign('types', $tCategory);
		$this->display();
	
	}
	
	/**
	 *	信息
	 */
	public function info()
	{
		$id = I('get.id');
		$m = new ReviewModel();
			
		$tA = $m->where(array('id'=>$id))->find();
		
		$type = M($m->tbReivewCategory)->where(array('type_id'=>$tA['type_id']))->find();
		$tA['type_name'] = $type['type_name'];
		//         print_r($tA);
		//加载静态插件
		$this->assign('__plugins', 'uniform,select2,datatable');
		$this->assign('__sidebar', 'Review/index');
		$this->assign('title', '文章详情');
		$this->assign('info', $tA);
		$this->display();
	}
	
	/**
	 * 保存信息
	 */
	public function save(){
		$id = I('post.id');
		$title = I('post.title');
		$content = I('post.content');
		$type_id= I('post.type_id');
		
		$model = new ReviewModel();
		
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
				'content'=>$content,
				'images'=>json_encode($path),
				'type_id'=>','.implode(',', $type_id).',',
		);
		 
		//如果ID不存在 则添加
		if (!$id){
			
			$tData['good'] = 0;
			$tData['view'] = 0;
			$tData['reply'] = 0;
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
	
		$m = new ReviewModel();
		
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
			//获取分类
			$tid = array();
			foreach ($tA['data'] as $k=>$v){
				foreach (explode(',', $v['type_id']) as $kk=>$vv){
					if ($vv && !in_array($vv, $tid)){
						$tid[] = $vv;
					}
				}
			}
			$tm = M($m->tbReivewCategory);
			$type = $tm->where(array('type_id'=>array('in',$tid)))->select();
			
			$tType  = array();
			foreach ($type as $k=>$v){
				$tType[$v['type_id']] = $v;
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
				$typeName = '';
				foreach (explode(',', $v['type_id']) as $kk=>$vv){
					if($vv){
						if ($typeName){
							$typeName.=',';
						}
						$typeName .=$tType[$vv]['type_name'];
					}
				}
				$tA['aaData'][$k][] = $typeName;
				$tA['aaData'][$k][] = $v['good'];
				$tA['aaData'][$k][] = $v['view'];
				$tA['aaData'][$k][] = $v['reply'];
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
				$tA['aaData'][$k][] = $this->_getStatus($v['status'],true,array('0'=>'隐藏','1'=>'显示'));
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
	
		$m = M((new ReviewModel())->tbReviewReply);
		$m->where(array('review_id'=>$id));
		
		if($status){
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
	
				$url = U(CONTROLLER_NAME.'/changeReply/id/'.$v['rid']);
				if($v['status'] == 1){
					$url = U(CONTROLLER_NAME.'/changeReply/id/'.$v['rid']);
				}
	
				$btn = '<div class="btn-group">
									<a href="'.U(CONTROLLER_NAME.'/deleteReply/id/'.$v['rid']).'" alert-message="确认是否删除'.$v['user_id']['nickname'].'？" class="ajax-request-btn btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 删除
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.$url.'" class="ajax-request-btn" alert-message="确认是否'.$status.$v['nickname'].'？">'.$status.'</a>
										</li>
										<!--<li class="divider">
										</li>
										<li>
											<a href="'.U('member/delete/id/'.$v['user_id']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['nickname'].'？">
												 删除
											</a>-->
										</li>
									</ul>
								</div>';
	
				$tA['aaData'][$k][] = '<input type="checkbox" name="checkList" class="checkable" value="'.$v['rid'].'">';
				$tA['aaData'][$k][] = $tUser[$v['user_id']]['nickname'];
				$tA['aaData'][$k][] = '<textarea style="height: 22px; padding: 2px; line-height: 1;" readonly="readonly" class="form-control remaks-item">'.$v['content'].'</textarea>';
				$tA['aaData'][$k][] = $v['good'];
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
				$tA['aaData'][$k][] = $this->_getStatus($v['status'], true,array('1'=>'显示','0'=>'隐藏'));
				$tA['aaData'][$k][] = $btn;
			}
		}
	
		unset($tA['data']);
		echo json_encode($tA);
	}
	
	/**
	 * 删除
	 * {@inheritDoc}
	 * @see \Admin\Controller\AdminController::delete()
	 */
	public function delete($id){
		$m = new ReviewModel();
		
		$query = $m->where(array('id'=>$id))->save(array('status'=>-1));
		if($query === false){
			$this->error("保存失败");
		}
		$this->success("保存成功");
	}
	
	/**
	 * 更改状态
	 * @param unknown $id
	 */
	public function changeStatus($id){
		$m = new ReviewModel();
		
		$tA = $m->where(array('id'=>$id))->find();
		$status = $tA['status']==1?0:1;
		
		$query = $m->where(array('id'=>$id))->save(array('status'=>$status));
		if($query === false){
			$this->error("保存失败");
		}
		$this->success("保存成功");
	}
	
	/**
	 * ueditor上传文件
	 */
	public function upload(){
		$this->ueditorUpload();
	}
	
	/**
	 * 改变回复状态
	 */
	public function changeReply(){
		$id = I('get.id');
		 
		$m = M((new ReviewModel())->tbReviewReply);
		 
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
		 
		$mm = new ReviewModel();
		$m = M($mm->tbReviewReply);
		$m->startTrans();
		 
		$query = $m->where(array('rid'=>$id))->save(array('status'=>-1));
		if ($query === false){
			$m->rollback();
			$this->error('保存失败');
		}
		 
		/* $query = $m->where(array('prid'=>$id))->delete();
		 
		if ($query === false){
			$m->rollback();
			$this->error('保存失败');
		} */
	
		$m->commit();
		$this->success('保存成功');
	}
	
	/**
	 * 批量删除
	 * @param unknown $val
	 * @param unknown $type
	 */
	public function checked($val,$type){
		
		if($type == 1){
			$m = new ReviewModel();
			$query = $m->where(array('id'=>array('in',$val)))->save(array('status'=>-1));
			if ($query === false){
				$this->error('删除失败');
			}
			
			$this->success('删除成功');
		}
	}
	
	/**
	 * 批量删除
	 * @param unknown $val
	 * @param unknown $type
	 */
	public function checkedReview($val,$type){
		
		if($type == 1){
			$m = M((new ReviewModel())->tbReviewReply);
			$query = $m->where(array('rid'=>array('in',$val)))->save(array('status'=>-1));
			if ($query === false){
				$this->error('删除失败');
			}
			
			$this->success('删除成功');
		}
	}
}