<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Think\Controller;
/**
 * 后台公共核心类
 * @author slike <787193801@qq.com>
 */
class SlikebaseController extends Controller {

	public $tableName =''; //定义自己的表名
	public $field = '';
	public $status = 'status';

	/**
	 * 改变状态 公共方法
	 * @param $id
	 */
	protected function _changeStatus($id,$status = NULL){
		if (!is_null($status)){
			$this->status = $status;
		}
		 
		if(!$id) $this->error('参数错误');
		$model = M($this->tableName);
		$tI = $model->where(array($this->field => $id))->find();
		if(!$tI){
			$this->error('该数据不存在');
		}
		$val=$tI[$this->status]?0:1;
		$query = $model->where(array($this->field => $id))->save(array($this->status => $val));

		if(!$query){
			$this->error('保存失败');
		}
		$this->success('保存成功');
	}

	/**
	 * 编辑时 获取数据
	 * @param $id
	 * @param $field
	 * @param int $getModel 1-单条  2-多条
	 * @return mixed|null
	 */
	protected function _editGet($id,$field,$getModel = 1){
		$model=M($this->tableName); //实例化模型
		$res = null;

		switch ($getModel)
		{
			case 1:
				$res=$model->where(array($field=>$id))->find();
				break;
			case 2:
				$res=$model->where(array($field=>$id))->select();
				break;
			default:
				break;
		}

		if(!$res)
			$this->error('数据不存在');

			return $res;
	}

	/**
	 * 插入积分获取记录
	 * @param $user_id
	 * @param $answer_id
	 * @param $integral
	 */
	public function insertIntegral($user_id,$answer_id,$integral){
		M('user_integral_log_info')->add(array(
				'answer_id'     =>$answer_id,
				'integral'      =>$integral,
				'type'          =>1,
				'user_id'       =>$user_id,
				'exchange_id'   =>0,
		));
	}
	/**
	 * 给用户增加积分
	 * @param $uid
	 * @param $integral
	 * @return bool
	 */
	public function _setUserIntegral($uid,$integral)
	{
		return M('user')->where(array('user_id'=>$uid,))->setInc('integral',$integral);
	}
	/**
	 * 删除
	 */
	protected function _del($id,$field){
		$res=M($this->tableName)->where(array($field=>$id))->delete();
		if($res){
			$this->success('删除成功');
		}
		$this->error('删除失败');
	}

	protected function getMsg(){
		echo "你获取到了我这个隐藏的方法！哈哈哈";
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	protected function _getCity($id){
		$res=M('user_city')->where(array('city_id'=>$id))->find();
		return $res['city_name'];
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	protected function _getRegion($id){
		$res=M('user_region')->where(array('region_id'=>$id))->find();
		return $res['region_name'];
	}

	/**
	 * 获取部门列表
	 * @param null $sec_id
	 */
	protected function _getSection($sec_id=null){
		if( ! $sec_id) $this->error('部门不存在');
		$info = M('bang_section')->where(array('section_id' => $sec_id))->find();
		//if( ! $info) $this->error('用户不存在');
		return $info['sec_name'];
	}

	/**
	 * 根据父ID 查询所有的子ID
	 * @param int $id
	 * @param string $table
	 * @param $parent
	 * @param $childer
	 * @param string $name
	 * @param int $type
	 * @param string $fiedl
	 * @param null $sort
	 * @return array
	 */
	public function _getChilds($id=0,$table='',$parent,$childer,$name='',$type=1,$fiedl='nodes',$sort=null){
		$data=array();
		$sid='';
		$section=M($table)->where(array($parent=>$id))->order('sort asc')->select();

		//print_r(M()->getLastSql());
		##是否为 0
		foreach ($section as $key=>$val) {
			$sid.=$val[$childer].',';
			$child = $this->_getChilds($val[$childer], $table, $parent, $childer, $name, $type, $fiedl);
			//print_r($child);
			if(!empty($child)){
				$sid.=$child;
			}
		}
		return $sid;
	}
	/**
	 * 获取子节点[递归]
	 * @param int $id
	 * @param string $table
	 * @param $parent
	 * @param $childer
	 * @param string $name
	 * @param bool $type
	 * @return mixed
	 */
	protected function _getChild($id=0,$table='',$parent,$childer,$name='',$type=0,$fiedl='nodes',$sort=null){
		$data=array();
		$section=M($table)->where(array($parent=>$id))->order('sort asc')->select();
		##是否为 0
		foreach ($section as $key=>$val){
			if($type){
				##组装数据
				$data[$key]['text']=$val[$name];
				$data[$key]['val']=$val[$childer];

				if($type>1){
					$data[$key]['val']=0;
				}
			}
			$child=$this->_getChild($val[$childer],$table,$parent,$childer,$name,$type,$fiedl);

			if(!is_null($child)){
				$section[$key]['child']=$child;
				if($type){
					$data[$key][$fiedl]=$child;
				}
			}

			##模式为2 检测用户
			if($type==2){
				$user=M('user')->field('nickname as text,user_id as val')->where(array($childer=>$val[$childer]))->select();

				if(!is_null($user)){
					$data[$key]['text'].="[".count($user)."]";
					foreach ($user as $ke=>$v){

						$v['text'].='[ID:'.$v['val'].']';
						$v['icon']="fa fa-user-md icon-success";

						array_push($data[$key][$fiedl],$v);
					}
				}

			}elseif($type==3){
				##模式为3 检测课程栏目
				$user=M('learn_lesson_lib')->field('title as text,lesson_id as val')->where(array($childer=>$val

						[$childer],'lesson_type'=>1))->select();

						if(!is_null($user)){
							$data[$key]['text'].="[".count($user)."]";
							foreach ($user as $ke=>$v){

								$v['text'].='[ID:'.$v['val'].']';
								$v['icon']="fa fa-file-text-o";

								array_push($data[$key][$fiedl],$v);
							}
						}

			}

		}
		if($type){
			return $data;//返回组装数据
		}
		else{
			return $section;//返回组装数据
		}
	}

	/**
	 * 获取子节点[分类组合]
	 * @param int $id
	 * @param string $table
	 * @param $parent
	 * @param $childer
	 * @param string $name
	 * @param bool $type
	 * @return mixed
	 */
	protected function _getTypeChild($table='',$childer,$name='',$type=0,$fiedl='nodes',$sort='sort'){
		$data=array();
		$section=M($table)->order($sort.' asc')->select();
		##是否为 0
		foreach ($section as $key=>$val){
			if($type){
				##组装数据
				$data[$key]['text']=$val[$name];
				$data[$key]['val']=$val[$childer];

				if($type>1){
					$data[$key]['val']=0;
				}
			}

			##模式为2 检测用户
			if($type==2){

				##模式为2 检测课程栏目
				$user=M('learn_exam_paper_lib')->field('paper_name as text,paper_id as val')->where(array

						($childer=>$val[$childer]))->select();

						if(!is_array($data[$key][$fiedl])){
							$data[$key][$fiedl]=array();
						}
						if(!is_null($user)){
							$data[$key]['text'].="[".count($user)."]";
							foreach ($user as $ke=>$v){

								$v['text'].='[ID:'.$v['val'].']';
								$v['icon']="fa fa-file-text-o";

								array_push($data[$key][$fiedl],$v);
							}
						}

			}

		}
		if($type){
			return $data;//返回组装数据
		}
		else{
			return $section;//返回组装数据
		}
	}

	/**
	 * 获取状态
	 *
	 * @param	integer	$key
	 * @return	mixed
	 */
	protected function _getSex($key = null){

		$config = array(
				1 => '男',
				2 => '女',
		);

		if($key !== null){
			return isset($config[$key]) ? $config[$key] : '';
		}

		return $config;
	}
	/**
	 * 获取职位
	 *
	 * @param	integer	$key
	 * @return	mixed
	 */
	protected function _getPosition($key = null){
		$res=M('user_position')->where(array('position_id'=>$key))->find();
		return $res['pos_name'];
	}
	/**
	 * 是否是管理员
	 * @param null $key
	 * @return array|mixed|string
	 */
	protected function _getAdmin($key = null){

		$config = array(
				1 => '是',
				0 => '否',
		);

		if($key !== null){
			return isset($config[$key]) ? $config[$key] : '';
		}

		return $config;
	}

	/**
	 * 获取状态
	 *
	 * @param	integer	$key
	 * @param	boolean	$show	是否显示
	 * @return	mixed
	 */
	protected function _getDefault($key = null, $show = false){

		$config = array(
				0 => '未默认',
				1 => '默认',
		);

		if($key !== null){

			if(isset($config[$key]) && ! $show){
				return $config[$key];
			}

			if(isset($config[$key]) && $show){

				if($key == 0){
					return '<span class="label label-danger">'.$config[$key].'</span>';
				}else if($key == 1){
					return '<span class="label label-success">'.$config[$key].'</span>';
				}
			}
			return '';
		}

		return $config;
	}


	/**
	 * 获取状态
	 *
	 * @param	integer	$key
	 * @param	boolean	$show	是否显示
	 * @return	mixed
	 */
	protected function _getStatus($key = null, $show = false,$config = array()){

		if (!$config){
			$config = array(
					0 => '禁用',
					1 => '启用',
			);
		}

		if($key !== null){

			if(isset($config[$key]) && ! $show){
				return $config[$key];
			}

			if(isset($config[$key]) && $show){

				if($key == 0){
					return '<span class="label label-danger">'.$config[$key].'</span>';
				}else if($key == 1){
					return '<span class="label label-success">'.$config[$key].'</span>';
				}
			}
			return '';
		}

		return $config;
	}

	protected function _upload($file,$path='photo',$kb=800,$id=null){

		##图片路径
		$filepath='Uploads/'.$path.'/'.date('Ymd',time());

		##检查图片上传地址是否存在
		if(!file_exists('Uploads/'.$path)){
			//$this->error($filepath.'不存在');
			mkdir('Uploads/'.$path,0777);
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
			E('上传失败！文件错误');
		}
		##循环图片类型
		if(strcasecmp($file['type'],'image/gif')!=0 && strcasecmp($file['type'],'image/jpeg')!=0 && strcasecmp

				($file['type'],'image/png')!=0){
					E('请上传gif,jpg,png等图片格式！当前文件格式:'.$file['type']);
		}

		##循环图片类型
		if($file['size']>$kb*1000){
			E('图片大小必须小于'.$kb.'kb,当前图片大小:'.($file['size']/1000).'kb');
		}

		$name=date('Ymdhis',time()).$id;
		$filename='/'.$name.'.png';

		if(move_uploaded_file($file['tmp_name'],$filepath.$filename)){
			$picPath=$filepath.$filename;             //将图片路径存入其中
			return $picPath;
		}else{
			E('图片上传失败!请重新编辑再试');
		}

		return false;
	}

	/**
	 * 删除图片 地址
	 * @param $path
	 * @return bool
	 */
	public function _delPic($path)
	{
		return unlink($path);
	}
	/**
	 * 上传单图
	 * @param $file
	 * @return array|void
	 */
	protected function _uploadPic($file,$path='Shop',$id=null){
		//print_r($file);

		$Pic=M('shop_images');
		$Pic->startTrans();
		$picPath=array();//图片路径
		$data=array(); //数据数组
		$filepath='Uploads/'.$path.'/'.date('Ymd',time());

		##检查图片上传地址是否存在
		if(!file_exists('Uploads/'.$path)){
			//$this->error($filepath.'不存在');
			mkdir('Uploads/'.$path,0777);
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
		if(strcasecmp($file['type'],'image/gif')!=0 && strcasecmp($file['type'],'image/jpeg')!=0 && strcasecmp

				($file['type'],'image/png')!=0){
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
	 * 上传图片 返回地址
	 * @param $file
	 * @param $path
	 * @param $kb
	 * @param $id
	 * @return mixed
	 */
	public function _uploadPicPath($file,$path='photo',$filename='',$id='',$kb=1000)
	{
		$error=array(
				'status'    =>0,        //状态 1-成功
				'data'      =>'',       //数据
				'original'      =>$file['name'],       //数据
				'size'      =>$file['size'],       //数据
				'title'      =>$file['name'],       //数据
				'type'      =>$file['type'],       //数据
		);
		##图片路径
		$filepath='uploads/'.$path;//.'/'.date('Ymd',time())

		##检查图片上传地址是否存在
		if(!file_exists('uploads/'.$path)){
			mkdir('uploads/'.$path,0777,true);
		}

		##检查图片上传地址是否存在
		if(!file_exists($filepath)){
			mkdir($filepath,0777,true);
		}
		##循环图片内部错误判断
		if($file['error']>0){
			$error['data'] = '上传失败！文件错误';
			return $error;
		}

		##循环图片类型
		if(strcasecmp($file['type'],'image/gif')!=0 && strcasecmp($file['type'],'image/jpeg')!=0 && strcasecmp

				($file['type'],'image/png')!=0){
					$error['data'] = '请上传gif,jpg,png等图片格式！当前文件格式:'.$file['type'];
					return $error;
		}

		##循环图片类型
		if($file['size']>$kb*1000){
			$error['data'] = '图片大小必须小于'.$kb.'kb,当前图片大小:'.($file['size']/1000).'kb';
			return $error;
		}
		if(!$filename){
			$name=date('Ymdhis',time()).$id;
			$filename='/'.$name.'.jpg';
		}else{
			$filename='/'.$filename.$id.'.jpg';
		}

		if(move_uploaded_file($file['tmp_name'],$filepath.$filename)){
			$picPath=$filepath.$filename;             //将图片路径存入其中
			$error['status'] = 1;
			$error['data']   = $picPath;
			return $error;
		}else{
			$error['data'] = '图片上传失败!请重新编辑再试';
			return $error;
		}
	}

	/**
	 * 上传图片 返回地址
	 * @param $file
	 * @param $path
	 * @param $kb
	 * @param $id
	 * @return mixed
	 */
	public function _uploadPicBase64($Base64,$path='photo',$filename='',$id='',$kb=1000)
	{
		$error=array(
				'status'    =>0,        //状态 1-成功
				'data'      =>'',       //数据
		);
		##图片路径
		$filepath='uploads/'.$path;//.'/'.date('Ymd',time())

		##检查图片上传地址是否存在
		if(!file_exists('uploads/'.$path)){
			mkdir('uploads/'.$path,0777,true);
		}

		##检查图片上传地址是否存在
		if(!file_exists($filepath)){
			mkdir($filepath,0777);
		}
		 
		$type = stristr(substr(stristr($Base64, '/'),1),';',true);
		$tData = substr(stristr($Base64,','),1);

		##循环图片类型
		if(strcasecmp($type,'gif')!=0 && strcasecmp($type,'jpeg')!=0 && strcasecmp($type,'png')!=0){
			$error['data'] = '请上传gif,jpg,png等图片格式！当前文件格式:'.$type;
			return $error;
		}

		 
		if(!$filename){
			$name=date('Ymdhis',time()).$id;
			$filename='/'.$name.'.jpg';
		}else{
			$filename='/'.$filename.$id.'.'.$type;
		}
		 
		file_put_contents($filepath.$filename, base64_decode($tData));
		 
		if(file_exists($filepath.$filename)){
			$picPath=$filepath.$filename;             //将图片路径存入其中
			$error['status'] = 1;
			$error['data']   = $picPath;
			return $error;
		}else{
			$error['data'] = '图片上传失败!请重新编辑再试';
			return $error;
		}
	}

	/**
	 * 删除图片
	 * @param $photo_id
	 * @return bool
	 */
	protected function _deletePic($photo_id,$table='shop_images',$filed='img_id',$path='path'){
		##找到老图片，删除图片，和记录
		if(empty($photo_id)){
			return true;
		}
		$m=M($table);
		$tup=$m->where(array($filed=>$photo_id))->find();
		if(unlink($tup[$path]) || !file_exists($tup[$path])){
			$res=$m->where(array($filed=>$photo_id))->delete(); //删除老图片记录
			if ($res){
				return true;
			}
		}

		return false;
	}

	/**
	 * 获取文章中的 图片地址
	 * @param unknown $str	字符串
	 * @param string $startTag	开始标签
	 * @param string $endTag	结束标签
	 * @return string[]
	 */
	public function getContentPath($str,$startTag = 'src="',$endTag ='"'){

		$url = array();
		do {
			$str = stristr($str,$startTag);
			$str = stristr($str,$endTag);
			$str = substr($str,1);
			 
			$url[] = stristr($str,$endTag,true); //获取一个地址
			 
			if(strpos($str,$startTag) === FALSE){
				$bool = FALSE;
			}else{
				$bool = TRUE;
			}
		}while ($bool);

		return $url;
	}


	/**
	 * 获取图片信息
	 * @param null $id
	 * @param string $table
	 * @param string $field
	 * @return mixed
	 */
	protected function _getPhoto($id=null,$table='shop_images',$field='img_id'){
		$m=M($table);
		$res=$m->where(array($field=>$id))->find();
		return $res;
	}

	/**
	 * 获取图片信息
	 * @param null $path
	 * @param string $table
	 * @param string $field
	 * @return mixed
	 */
	protected function _getPhotoPath($path=null,$table='shop_images',$field='path'){
		$m=M($table);
		$res=$m->where(array($field=>$path))->find();
		return $res;
	}
	/**
	 * 获取用户昵称
	 * @param $id
	 * @return string
	 */
	protected function _getUser($id){
		$res=M('wechat_user')->where(array('user_id'=>$id))->find();
		if(empty($res)){
			return '暂无昵称' ;
		}
		return $res['nickname'];
	}


	/**
	 * 给用户添加任务
	 * @param int $lesson_id
	 * @param int $user_id
	 * @return bool
	 */
	protected function Set_User_Task($lesson_id=0,$user_id=0){
		$bool=true;
		if($lesson_id){
			$lesson=M('learn_lesson_lib')->field('lesson_end_time,lesson_type')->where(array('lesson_id'=>

					$lesson_id))->find();


					$data=array(
							'user_id'=>$user_id,
							'lesson_id'=>$lesson_id,
							'task_type'=>$lesson['lesson_type'],//考试？
							'speed'=>'0',//
							'task_start_time'=>date('Y-m-d H:i:s',time()),//
							'task_finish_time'=>$lesson['lesson_end_time'],//
					);
					$res=M('user_task')->add($data);
					if(!$res){
						$bool=false;
					}

		}

		return $bool;
	}


	public function ueditorUpload($path = CONTROLLER_NAME,$size = 20480000){
		 
		$action = $_REQUEST['action'];
		
		$config = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("Public/Slike/Ueditor/php/config.json")), true);
		//print_r($config);
// 		$config = array(
// 				'imagePath'=>$path,
// 				'imageFieldName'=>'upfile',
// 				'imageMaxSize'=>$size,
// 				'imageAllowFiles'=>array('.png','.jpg','.jpeg','.gif','.bmp'),
// 				'imageActionName'=>'uploadimage',
// 				'imageUrlPrefix'=>'',
// 		);
		$config['imageActionName'] = 'uploadimage';
		 
		switch ($action){
			case 'config':
				echo json_encode($config);
				break;
			case 'uploadimage':
				 
				$res = $this->_uploadPicPath($_FILES['upfile'],CONTROLLER_NAME.'/content',time());
				$res = array(
						"state" => 'SUCCESS',          //上传状态，上传成功时必须返回"SUCCESS"
						"url" => $res['data'],

						//返回的地址
						"title" => $res['title'],          //新文件名
						"original" => $res['original'],       //原始文件名
						"type" => '.jpg',            		//文件类型
						"size" => $res['size'],           //文件大小
				);
				echo json_encode($res);
				break;
			default:
				include "/Public/Slike/Ueditor/php/Uploader.class.php";
				
				$tconfig = array(
						"pathFormat" => __ROOT__.'/uploads/file/'.date('Ymd').'/'.time().rand(0,9999),
						"maxSize" => $config['fileMaxSize'],
						"allowFiles" => $config['fileAllowFiles']
				);
				
				/* 生成上传实例对象并完成上传 */
				$up = new \Uploader('upfile', $tconfig, "upload");
				
				/* 返回数据 */
				echo json_encode($up->getFileInfo());
				break;
		}
		
	}











}











