<?php
namespace Admin\Controller;
use Think\Controller;
class AboutController extends AdminController {
    public function index(){
    	//加载静态插件
    	$this->assign('__plugins', 'uniform,select2,datatable');
    	$this->assign('__sidebar', 'About/index');
    	$this->assign('meta_title', '关于我们');
    	$this->display();
    }
    
    public function edit(){
    	$tA = M('about')->where(array('id'=>I('id')))->find();
    	//加载静态插件
    	$this->assign('__plugins', 'uniform,select2,ueditor,datatable');
    	$this->assign('__sidebar', 'About/index');
    	$this->assign('title', '编辑');
    	$this->assign('info', $tA);
    	$this->display();
    }
    
    public function save(){
    	$id = I('post.id');
    	$title = I('post.title');
    	$content = I('post.content');
    	
    	if(!$id){
    		$this->error('id不存在');
    	}
    	
    	$query = M('about')->where(array('id'=>$id))->save(array('title'=>$title,'content'=>$content,'addtime'=>time()));
    	
    	if($query === false){
    		$this->error('更新失败');
    	}
    	
    	$this->success('更新成功',U('index'));
    	
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
    
    	$m = M('about');
    	$tA   = $this->pagination($m);
    
    	int_to_string($tA['data']);
    	if( ! empty($tA['data'])){
    
    		foreach ($tA['data'] as $k => $v){
    
    			$btn = '<div class="clearfix">
									<a href="'.U(CONTROLLER_NAME.'/edit/id/'.$v['id']).'" class="btn default green-stripe btn-xs">
										编辑
									</a>
									<a target="_blank" href="http://'.$_SERVER['HTTP_HOST'].__ROOT__.'/index.php?s=/about/jieshao/id/'.$v['id'].'.html" class="btn default purple-stripe btn-xs">
										浏览
									</a>
								</div>';
    
    			$tA['aaData'][$k][] = $v['title'];
    			$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
    			$tA['aaData'][$k][] = $btn;
    		}
    	}
    
    	unset($tA['data']);
    	echo json_encode($tA);
    }
}