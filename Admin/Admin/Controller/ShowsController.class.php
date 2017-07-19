<?php
namespace Admin\Controller;
class ShowsController extends AdminController {

    const cName = 'Shows';//当前类名
    public $tableName        = 'bang_showpic';
    public $field            = 'show_id';

    /**
     *  轮播图片
     */
    public function lunbo(){
        $meta_title = '轮播图片';
        $meta_title_top = '首页轮播';
        //加载静态插件
        $this->assign('__plugins', 'select2,datatable');
        $this->assign('__sidebar', 'Shows/lunbo');
        $this->assign('meta_title', $meta_title);
        $this->assign('meta_title_top', $meta_title_top);
        //print_r("<script>console.log('模块访问');</script>");
        $this->display();
    }

    /**
     * 获取章节列表
     */
    public function getList(){

        $name = trim(I('name'));
        $option = array(
            'order' => 'sort asc',
        );
        if($name){
            $option['where']['title'] = array('LIKE', '%'.$name.'%');
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
                $sortAdd    =   U(self::cName.'/sortAdd/id/'.$v[$this->field]);
                $sortDel    =   U(self::cName.'/sortDel/id/'.$v[$this->field]);
                $delUrl     =   U(self::cName.'/delete/id/'.$v[$this->field]);

                $btn = '<a href="'.$url.'" alert-message="确认是否“'.$tag.'”？" class="btn btn-default btn-xs ajax-request-btn"><i class="fa fa-lock"></i> '.$status.'</a>';
                $sortAdd='<a href="'.$sortAdd.'" alert-message="确定要向上移动" class="btn btn-default btn-xs sortadd"><i class="fa fa-edit"></i> 上移</a>';
                $delete = '<a href="'.$delUrl.'" alert-message="确认是否删除该条评价？" class="btn btn-default btn-xs ajax-request-btn"><i class="fa fa-times"></i>删除</a>';

                $tA['aaData'][$k][] = $k+1;
                $tA['aaData'][$k][] = $v['sort'];
                $tA['aaData'][$k][] = '<img src="'.$v['show_path'].'" width="370" height="180"/>';
                $tA['aaData'][$k][] = $v['url'];
                $tA['aaData'][$k][] = $this->_getStatus($v['status'],true);
                $tA['aaData'][$k][] = $btn.$sortAdd.$delete;
            }
        }
        unset($tA['data']);
        echo json_encode($tA);

    }
	/**
	 * 获取所有的邦邦文章
	 */
    public function getAllArticle(){
    	$art = M('bang_article')->select();
    	echo json_encode($art);
    }

    public function editStatus($id)
    {
        $this->_changeStatus($id);
    }

    public function add()
    {
        
		$url=I('post.url');
		
        if(!$url){
        	$this->error("请选择跳转的文章");
        }
        
        $url='http://'.$_SERVER["HTTP_HOST"].__ROOT__.'/index.php?s=/About/shows/id/'.$url;
 
        $m=M($this->tableName);
        $m->startTrans();
        
        $num=count($m->select());

        $data=array(
            'show_path'=> $p['path'],
            'url'	   => $url,
            'sort'    =>$num+1
        );

        $res=$m->add($data);
        
        if (!empty($_FILES['showpic'])){
        	/*检测图片*/
        	$tPath = $this->_uploadPicPath($_FILES['showpic'],CONTROLLER_NAME.'/'.$res,$res);
        	if(!$tPath['status']){
        		$m->rollback();
        		$this->error('上传失败');
        	}
        	//更新图片
        	$query = $m->where(array('show_id'=>$res))->save(array('show_path'=>$tPath['data']));
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

    public function delete($id)
    {
        $m=M($this->tableName);
        $p=$m->field(true)->find($id);
        $p=$this->_getPhotoPath($p['show_path'],$this->tableName,'show_path');
        $res=$this->_deletePic($p['show_id'],$this->tableName,$this->field,'show_path');
        if($res){
            $this->success("删除成功");
        }
        $this->error("删除失败");
    }

    public function sortAdd($id)
    {
        $m=M($this->tableName);

        $data=$m->where(array($this->field=>$id))->find();
        if($data){
            switch ($data['sort']){
                case 1:
                    $this->error("您已经是第一了");
                    break;
                case 2:
                    $m->where(array('sort'=>1))->save(array('sort'=>2));
                    $m->where(array($this->field=>$id))->save(array('sort'=>1));
                    break;
                default:
                    $m->where(array('sort'=>$data['sort']-1))->save(array('sort'=>$data['sort']));
                    $m->where(array($this->field=>$id))->save(array('sort'=>$data['sort']-1));
                    break;
            }
            $this->success("你已经移动了");
        }
    }

}