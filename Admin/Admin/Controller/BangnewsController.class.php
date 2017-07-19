<?php
namespace Admin\Controller;
use Think\Controller;
class BangnewsController extends AdminController {
    public function index(){
    	//加载静态插件
    	$this->assign('__plugins', 'uniform,select2,datatable');
    	$this->assign('__sidebar', 'Bangnews/index');
    	$this->assign('meta_title', '新闻列表');
    	$this->display();
    }
    
    public function add(){
    	//加载静态插件
    	$this->assign('__plugins', 'fileinput,uniform,select2,ueditor,datatable');
    	$this->assign('__sidebar', 'Bangnews/index');
    	$this->assign('title', '新增');
    	$this->display();
    }
    
    public function edit(){
    	$tA = M('about_bang_news')->where(array('id'=>I('id')))->find();
    	
    	$tA['cover_img'] = 'data:image/png;base64,'.base64_encode(@file_get_contents($tA['show_url']));
    	
    	//加载静态插件
    	$this->assign('__plugins', 'fileinput,uniform,select2,ueditor,datatable');
    	$this->assign('__sidebar', 'Bangnews/index');
    	$this->assign('title', '编辑');
    	$this->assign('info', $tA);
    	$this->display();
    }
    
    public function info(){
    	$tA = M('about_bang_news')->where(array('id'=>I('id')))->find();
    	
    	$tA['cover_img'] = 'data:image/png;base64,'.base64_encode(@file_get_contents($tA['show_url']));
    	$tA['type_name'] = $this->type($tA['type']);
    	//加载静态插件
    	$this->assign('__plugins', 'fileinput,uniform,select2,ueditor,datatable');
    	$this->assign('__sidebar', 'Bangnews/index');
    	$this->assign('title', '新闻详情');
    	$this->assign('info', $tA);
    	$this->display();
    }
    
    
    /**
     * 保存
     */
    public function save(){
    	$id = I('post.id');
    	$title = I('post.title');
    	$type= I('post.type');
    	$remark= I('post.remark');
    	$content = I('post.content');
    	
    	$model = M('about_bang_news');
    	
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
    			'remark'=>$remark,
    			'type'=>$type,
    			'show_urls'=>json_encode($path),
    	);
    	
    	//如果ID不存在 则添加
    	if (!$id){
    		
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
     * 获取问题列表
     */
    public function getList()
    {
    	$author = trim(I('author'));
    	$title = trim(I('title'));
    	$address = trim(I('address'));
    	$status = trim(I('status'));
    
    	$m = M('about_bang_news');
    	$tA   = $this->pagination($m);
    
    	int_to_string($tA['data']);
    	if( ! empty($tA['data'])){
    
    		foreach ($tA['data'] as $k => $v){
    
    			$btn = '<div class="clearfix">
									<a href="'.U(CONTROLLER_NAME.'/edit/id/'.$v['id']).'" class="btn default green-stripe btn-xs">
										编辑
									</a>
									<a href="'.U(CONTROLLER_NAME.'/info/id/'.$v['id']).'" class="btn default blue-stripe btn-xs">
										查看
									</a>
									<a href="'.U(CONTROLLER_NAME.'/delete/id/'.$v['id']).'" alert-message="确认是否删除'.$v['title'].'？" class="ajax-request-btn btn default red-stripe btn-xs">
										刪除
									</a>
								</div>';
    
    			$tA['aaData'][$k][] = '<img style="width: 100%;" src="'.$v['show_url'].'?r='.rand(1,999).'">';
    			$tA['aaData'][$k][] = '<span style="white-space: pre-line;">'.$v['title'].'</span>';
    			$tA['aaData'][$k][] = '<span style="white-space: pre-line;">'.$v['remark'].'</span>';
    			$tA['aaData'][$k][] = $this->type($v['type']);
    			$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
    			$tA['aaData'][$k][] = $btn;
    		}
    	}
    
    	unset($tA['data']);
    	echo json_encode($tA);
    }
    
    /**
     * 获取分类名
     * @param string $key
     * @return string|string[]
     */
    public function type($key = ''){
    	$config = array(
    			'1'=>'企业大记事',
    			'2'=>'研发新闻',
    			'3'=>'集团信息',
    	);
    	
    	if($key){
    		if(isset($config[$key])){
    			return $config[$key];
    		}
    	}
    	
    	return $config;
    }
    
    /**
     * ueditor上传文件
     */
    public function upload(){
    	$this->ueditorUpload();
    }
    
    
    public function delete(){
    	$id = I('get.id');
    	
    	$tA = M('about_bang_news')->where(array('id'=>$id))->find();
    	
    	unlink($tA['show_url']);
    	
    	$images = json_decode($tA['show_urls'],true);
    	if(is_array($images)){
    		foreach ($images as $k=>$v){
    			unlink($v);
    		}
    	}
    	
    	$query = M('about_bang_news')->where(array('id'=>$id))->delete();
    	
    	if($query === false){
    		$this->error('刪除失败');
    	}
    	
    	$this->success('删除成功');
    }
}