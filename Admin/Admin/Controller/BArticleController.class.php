<?php

//+------------------------------------------------------------------
//|  邦邦后台管理  邦邦首页
//+-------------------------------------------------------------------
//|  Slike <787193801@qq.com> 2016年10月24日 11:44:02
//+-------------------------------------------------------------------

namespace Admin\Controller;

class BArticleController extends AdminController {
    const cName = 'BArticle';//当前类名
    public $tableName ='bang_article'; //定义自己的表名
    public $field = 'article_id';

    public function index(){
        $meta_title = '文章列表';
        $meta_title_top = '文章列表';
        
        $colname = $this->getColumnAll();
        //加载静态插件
        $this->assign('__plugins', 'datatable,select2');
        $this->assign('__sidebar', 'BArticle/index');
        $this->assign('meta_title', $meta_title);
        $this->assign('meta_title_top', $meta_title_top);
        $this->assign('colname', $colname);
        $this->display();
    }

    /**
     * 获取章节列表
     */
    public function getList(){
//        $lesson_id = trim(I('get.lid'));
        $title = trim(I('title'));
        $content = trim(I('content'));
        $colid = trim(I('col_id'));
        $status = trim(I('status'));
        
        $option = array(
            'order' => 'sort desc',
        );
        if($title){
            $option['where']['title'] = array('LIKE', '%'.$title.'%');
        }
        
        if (!empty($content)){
            $option['where']['content'] = array('LIKE', '%'.$content.'%');
        }
        if (!empty($colid)){
        	$option['where']['column_id'] = array('LIKE', '%,'.$colid.',%');
        }
        if (!empty($status)){
        	$option['where']['status'] = ($status-1);
        }
        
        $tA   = $this->pagination($this->tableName, $option);
//        print_r($tA);
        int_to_string($tA['data']);
        if( ! empty($tA['data'])){
            foreach ($tA['data'] as $k => $v){

                $status = $v['status'] == 1 ? '禁用' : '启用';
                $url = U(self::cName.'/editStatus/method/resume/id/'.$v[$this->field]);
                if($v['status'] == 1){
                    $url = U(self::cName.'/editStatus/method/forbid/id/'.$v[$this->field]);
                }

                $tag        =   $status.'“'.$v['sec_title'];
                $editUrl    =   U(self::cName.'/editGet/id/'.$v[$this->field]);
                $delUrl     =   U(self::cName.'/delete/id/'.$v[$this->field]);

                $btn = '<a href="'.$url.'" alert-message="确认是否“'.$tag.'”？" class="btn btn-default btn-xs ajax-request-btn"><i class="fa fa-lock"></i> '.$status.'</a>';
                $edit='<a href="'.$editUrl.'" class="btn btn-default btn-xs edit-goods"><i class="fa fa-edit"></i> 编辑</a>';
                $delete = '<a href="'.$delUrl.'" alert-message="确认是否删除该条评价？" class="btn btn-default btn-xs ajax-request-btn"><i class="fa fa-times"></i>删除</a>';

                $tA['aaData'][$k][] = $k+1;
                $tA['aaData'][$k][] = '<a href="'.U('BAshow/index?id='.$v[$this->field]).'">'.$v['title'].'</a>';
                $tA['aaData'][$k][] = $v['user_name'];
                $tA['aaData'][$k][] = $v['content'];
                $tA['aaData'][$k][] = $v['page_view'];
                $tA['aaData'][$k][] = $this->getColumn($v['column_id']);
                $tA['aaData'][$k][] = $v['sort'];
                $tA['aaData'][$k][] = date('Y/m/d',strtotime($v['create_time']));
                $tA['aaData'][$k][] = $this->_getStatus($v['status'],true);
                $tA['aaData'][$k][] = $btn.$edit.$delete;
            }
        }
        unset($tA['data']);
        echo json_encode($tA);

    }
	/**
	 * 获取所有的分类
	 */
    public function getColumnAll(){
    	$col = M('bang_column')->select();
    	return $col;
    }
    
    public function getColumn($id){
    	$res=M('bang_column')->where(array('column_id'=>array('in',$id)))->select();
    	$name = '';
    	foreach ($res as $v){
    		if($name){
    			$name .= ',';
    		}
    		$name .= $v['col_name'];
    	}
    	return $name;
    }
    
    public function add(){
//        print_r($_FILES);
        $user_name=session('user_auth');
        
        $data=array(
            'title'=> I('post.title'),
            'user_name'=> $user_name['username'],
            'content'=> I('post.content'),
        	'column_id'=>','.implode(',',I('post.column_id')).',',
            'page_view'=> I('post.page_view'),
            'sort'=> I('post.sort'),
        );

        //$address_id=I('post.exchange_id');
        $m=M($this->tableName);

        $res=$m->add($data);

        if (!empty($_FILES['article_pic'])){
        	/*检测图片*/
        	$tPath = $this->_uploadPicPath($_FILES['article_pic'],CONTROLLER_NAME.'/'.$res,$res);
        	if(!$tPath['status']){
        		$m->rollback();
        		$this->error('上传失败');
        	}
        	//更新图片
        	$query = $m->where(array('article_id'=>$res))->save(array('info_url'=>$tPath['data']));
        	if ($query === false){
        		$m->rollback();
        		unlink($tPath['data']);
        		$this->error('保存失败');
        	}
        }
        
        if (!empty($_FILES['article_show'])){
        	/*检测图片*/
        	$tPath = $this->_uploadPicPath($_FILES['article_show'],CONTROLLER_NAME.'/'.$res,$res);
        	if(!$tPath['status']){
        		$m->rollback();
        		$this->error('上传失败');
        	}
        	//更新图片
        	$query = $m->where(array('article_id'=>$res))->save(array('show_url'=>$tPath['data']));
        	if ($query === false){
        		$m->rollback();
        		unlink($tPath['data']);
        		$this->error('保存失败');
        	}
        }
        
        if($res){
            $m->commit();
            $this->success('保存成功');
        }else{
            $m->rollback();
            $this->error('保存失败');
        }
    }
    /*
     * 删除
     */
    public function delete($id){
        $res=$this->_del($id,$this->field);
        if($res){
            M('bang_article_page')->where(array($this->field=>$id))->delete();
        }else{
            $this->error("删除失败");
        }


    }

    public function getUC(){
        $res=array();
        $res['col']=$this->_getChild(0,'bang_column','column_pid','column_id','col_name',false,'nodes');
        print_r(json_encode($res));
    }

    public function editGet($id){
        $res=$this->_editGet($id,$this->field);
        $res['nickname']=$this->_getUser($res['user_id']);
        $cl=$this->_getChild(0,'bang_column','column_pid','column_id','col_name',false,'nodes');
        $res['col']=$cl;
        $vc = explode(',',$res['column_id']);
      
        foreach ($vc as $k=>$v){
        	if(!$v){
        		unset($vc[$k]);
        	}
        }
        $res['column_id'] = array_values($vc);
        print_r(json_encode($res));
    }
    /**
     * 编辑保存
     */
    public function edit(){

        $m=M($this->tableName);
        ##检索老照片
        if(!empty($_FILES['article_pic'])){
            $odinfo=$m->field(true)->find(I('post.article_id'));
            $pic=$this->_getPhotoPath($odinfo['info_url']);
            $this->_deletePic($pic['img_id']); //通过路径获取老照片，删除之后 从新上传新的

            $id1=$this->_uploadPic($_FILES['article_pic'],'Article',1);
            $p1=$this->_getPhoto($id1);

            if(!$id1){
                $this->error("封面图片上传失败");
            }
        }
        if(!empty($_FILES['article_show'])){
            $info_show=$m->field(true)->find(I('post.article_id'));
            $pic_show=$this->_getPhotoPath($info_show['show_url']);
            $this->_deletePic($pic_show['img_id']); //通过路径获取老照片，删除之后 从新上传新的

            $id2=$this->_uploadPic($_FILES['article_show'],'Article',2);
            $p2=$this->_getPhoto($id2);

            if(!$id2){
                $this->error("文章图片上传失败");
            }
        }
        $data=array(
            'article_id'=> I('post.article_id'),
            'title'=> I('post.title'),
            'content'=> I('post.content'),
            'sort'=> I('post.sort'),
        	'column_id'=>','.implode(',',I('post.column_id')).',',
//            'page_view'=> I('post.page_view'),
        );

        ##如果照片有，则更新地址
        if(!empty($p1['path'])){
            $data['info_url']=$p1['path'];
        }
        ##如果照片有，则更新地址
        if(!empty($p2['path'])){
            $data['show_url']=$p2['path'];
        }
        //$address_id=I('post.exchange_id');


        $res=$m->save($data);

        //print_r($data);
        //print_r($address_id);
        if($res){
            $m->commit();
            $this->success('保存成功');
        }else{
            $m->rollback();
            $this->error('保存失败');
        }
    }


    public function editStatus($id){
        $this->_changeStatus($id);
    }
}
