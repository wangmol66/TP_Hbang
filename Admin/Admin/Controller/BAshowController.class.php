<?php

//+------------------------------------------------------------------
//|  邦邦后台管理  邦邦首页
//+-------------------------------------------------------------------
//|  Slike <787193801@qq.com> 2016年10月24日 11:44:02
//+-------------------------------------------------------------------

namespace Admin\Controller;

class BAshowController extends AdminController {
    const cName = 'BAshow';//当前类名
    public $tableName ='bang_article_page'; //定义自己的表名
    public $field = 'page_id';

    public function index(){
        $meta_title = '邦邦段落';
        $meta_title_top = '邦邦文章';
        $id=I('get.id');
        //加载静态插件
        $this->assign('__plugins', 'datatable,ueditor');
        $this->assign('__sidebar', 'BArticle/index');
        $this->assign('meta_title', $meta_title);
        $this->assign('meta_title_top', $meta_title_top);
        $this->assign('id', $id);
        //print_r("<script>console.log('模块访问');</script>");
        $this->display();
    }

    public function addShows(){
        $meta_title = '添加段落';
        $meta_title_top = '邦邦文章';
        $id=I('get.id');
        //加载静态插件
        $this->assign('__plugins', 'datatable');
        $this->assign('__sidebar', 'BArticle/index');
        $this->assign('meta_title', $meta_title);
        $this->assign('meta_title_top', $meta_title_top);
        $this->assign('id', $id);
        //print_r("<script>console.log('模块访问');</script>");
        $this->display();
    }
    /**
     * 获取章节列表
     */
    public function getList(){
        $article_id = trim(I('get.id'));
        $name = trim(I('name'));
        $option = array(
            'order' => $this->field.' asc',
            'where'=> 'article_id='.$article_id,
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
                $editUrl    =   U(self::cName.'/editGet/id/'.$v[$this->field]);
                $delUrl     =   U(self::cName.'/delete/id/'.$v[$this->field]);

                $btn = '<a href="'.$url.'" alert-message="确认是否“'.$tag.'”？" class="btn btn-default btn-xs ajax-request-btn"><i class="fa fa-lock"></i> '.$status.'</a>';
                $edit='<a href="'.$editUrl.'" class="btn btn-default btn-xs edit-goods"><i class="fa fa-edit"></i> 编辑</a>';
                $delete = '<a href="'.$delUrl.'" alert-message="确认是否删除该条评价？" class="btn btn-default btn-xs ajax-request-btn"><i class="fa fa-times"></i>删除</a>';

                $tA['aaData'][$k][] = $k+1;
                $tA['aaData'][$k][] = $v['page_name'];
                $tA['aaData'][$k][] = $v['page_content'];
                $tA['aaData'][$k][] = $v['page_sequence'];
                $tA['aaData'][$k][] = $this->getArticle($v['article_id']);
                $tA['aaData'][$k][] = date('Y/m/d',strtotime($v['create_time']));
                $tA['aaData'][$k][] = $this->_getStatus($v['status'],true);
                $tA['aaData'][$k][] = $btn.$edit.$delete;
            }
        }
        unset($tA['data']);
        echo json_encode($tA);

    }

    public function getArticle($id){
        $res=M('bang_article')->where(array('article_id'=>$id))->find();
        return $res['title'];
    }

    /**
     * 上传单图
     * @param $file
     * @return array|void
     */
    protected function _uploadPic($file,$id=null){
        //print_r($file);

        $Pic=M('shop_images');
        $Pic->startTrans();
        $picPath=array();//图片路径
        $data=array(); //数据数组
        $filepath='Uploads/Page/'.date('Ymd',time());

        ##检查图片上传地址是否存在
        if(!file_exists('Uploads/Page')){
            //$this->error($filepath.'不存在');
            mkdir('Uploads/Page',0777);
            //return;
        }

        ##检查图片上传地址是否存在
        if(!file_exists($filepath)){
            //$this->error($filepath.'不存在');
            mkdir($filepath,0777);
            //return;
        }
        ##循环图片内部错误判断
        if($file['error']>0){
            $this->error('上传失败！文件错误');
        }
        ##循环图片类型
        if(strcasecmp($file['type'],'image/gif')!=0 && strcasecmp($file['type'],'image/jpeg')!=0 && strcasecmp($file['type'],'image/png')!=0){
            $this->error('请上传gif,jpg,png等图片格式！当前文件格式:'.$file['type']);
        }

        ##循环图片类型
        if($file['size']>800000){
            $this->error('图片大小必须小于800kb,当前图片大小:'.($file['size']/1000).'kb');
        }

        $name=date('Ymdhis',time()).$id;
        $filename='/'.$name.'.png';

        if(move_uploaded_file($file['tmp_name'],$filepath.$filename)){
            $picPath=$filepath.$filename;             //将图片路径存入其中
            $pid=$Pic->add(array('path'=>$filepath.$filename,'create_time'=>date('Y-m-d H:i:s',time()))); //插入数据库，返回图片ID
        }else{
            unlink($picPath);
            $Pic->rollback();
            $this->error('图片上传失败!请重新编辑再试');
        }

        return $pid;
    }

    /**
     * 删除图片
     * @param $photo_id
     * @return bool
     */
    protected function _deletePic($photo_id){
        ##找到老图片，删除图片，和记录
        if(empty($photo_id)){
            return true;
        }
        $m=M('shop_images');
        $tup=$m->where(array('img_id'=>$photo_id))->find();
        if(unlink($tup['path'])){
            $res=$m->where(array('img_id'=>$photo_id))->delete(); //删除老图片记录
            if ($res){
                return true;
            }
        }

        return false;
    }

    public function uploadPic(){
//        $file=$_FILES['file'];
        $id=$this->_uploadPic($_FILES['file']);
        if($id){
            M('')->commit();
            $img=M('shop_images')->where(array('img_id'=>$id))->find();
            $data['link']=$img['path'];
            $data['id']=$img['img_id'];
            print_r(json_encode($data));
        }else{
            $this->_deletePic($id);
        }
//        print_r($file);
    }

    public function deletePic()
    {
        $id=I('post.id');
        $res=$this->_deletePic($id);

        print_r($res);
    }
    public function add(){

        $data=array(
            'article_id'=> I('post.article_id'),
            'page_name'=> I('post.page_name'),
            'page_content'=> I('post.page_content'),
            'page_sequence'=> I('post.page_sequence'),
        );
        if(empty($data['page_name'])){
            $this->error('数据错误');
        }
        //$address_id=I('post.exchange_id');
        $m=M($this->tableName);

        $res=$m->add($data);

        //print_r($data);
        //print_r($address_id);
        if($res){
            $this->success('保存成功');
        }else{
            $this->error('保存失败');
        }
    }
    /*
     * 删除
     */
    public function delete($id){
    	$info = $this->_editGet($id, $this->field);
    	$url = $this->getContentPath($info['page_content']);
    	foreach ($url as $v){
    		unlink($v);
    	}
        $this->_del($id,$this->field);
    }

    public function getUC(){
        $res=array();
        $res['col']=$this->_getChild(0,'bang_column','column_pid','column_id','col_name',false,'nodes');

        print_r(json_encode($res));
    }

    public function editGet($id){
        $res=$this->_editGet($id,$this->field);
        print_r(json_encode($res));
    }
    /**
     * 编辑保存
     */
    public function edit(){
        $data=array(
            'page_id'=> I('post.page_id'),
            'page_name'=> I('post.page_name'),
            'page_content'=> I('post.page_content'),
            'page_sequence'=> I('post.page_sequence'),
        );

        //$address_id=I('post.exchange_id');
        $m=M($this->tableName);

        $res=$m->save($data);

        //print_r($data);
        //print_r($address_id);
        if($res){
            $this->success('保存成功');
        }else{
            $this->error('保存失败');
        }
    }


    public function editStatus($id){
        $this->_changeStatus($id);
    }
    
    /**
     * ueditor上传文件
     */
    public function upload(){
    	$this->ueditorUpload();
    }
}
