<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Model\QuestionModel;
use Admin\Model\PaperModel;
class QuestionController extends AdminController {
	const cName = 'Question';//当前类名
	public $tableName = 'cache_question_lib'; //定义自己的表名
	public $field = 'question_id';
	
	
	/**
	 * 数据库备份/还原列表
	 * @param  String
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function index()
	{
		//列出备份文件列表
		$title = '题包列表';
		$title_top = '题库管理';
	
		$this->assign('__plugins', 'uniform,datatable,select2');
		$this->assign('__sidebar', 'Question/index');
		//渲染模板
		$this->assign('meta_title', $title);
		$this->assign('meta_title_top', $title_top);
		$this->assign('exa_type',array('课后练习'=>'课后练习','考试'=>'考试'));
		$this->display();
	}
	
	
	/**
	 * 获取章节列表
	 */
	public function getList(){
		$queType = I('get.que_type');
		$que_score = I('get.que_score');
		$title = I('get.que_title');
	
		$m =M((new QuestionModel())->tbCacheQuestionPackage);
	
		if($queType){
			$m->where(array('type'=>$queType));
		}
	
		if($que_score){
			$m->where(array('que_score'=>$que_score));
		}
	
		if($title){
			$m->where(array('title'=>array('like','%'.$title.'%')));
		}
	
		$m->order('id asc');
		$m->where(array('status'=>array('egt',0)));
		$tA   = $this->pagination($m);
	
		int_to_string($tA['data']);
		if( ! empty($tA['data'])){
			
			foreach ($tA['data'] as $k => $v){
	
				$btn = '<div class="btn-group">
									<a href="'.U(CONTROLLER_NAME.'/info/id/'.$v['id']).'" class="btn btn-default btn-xs">
										<i class="fa fa-eye"></i> 详情
									</a>
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
									<ul role="menu" class="dropdown-menu pull-right">
										<li>
											<a href="'.U(CONTROLLER_NAME.'/getPackageInfo/id/'.$v['id']).'" class="edit">
												 编辑
											</a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="'.U(CONTROLLER_NAME.'/deletePackage/id/'.$v['id']).'" class="ajax-request-btn" alert-message="确认是否删除'.$v['title'].'？">
												 删除
											</a>
										</li>
									</ul>
								</div>';
				
				$tA['aaData'][$k][] = '<input type="checkbox" class="checkable" name="checkList" value="'.$v['id'].'">';
				$tA['aaData'][$k][] = $v['title'];
				$tA['aaData'][$k][] = $this->_PackageType($v['type'],true);
				$tA['aaData'][$k][] = $v['total_score'];
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['addtime']);
				$tA['aaData'][$k][] = $btn;
			}
		}
		unset($tA['data']);
		echo json_encode($tA);
	}
	
	/**
	 * 数据库备份/还原列表
	 * @param  String
	 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
	 */
	public function info()
	{
		//列出备份文件列表
		$title = '题库列表';
		$title_top = '课程管理';
	
		$this->assign('__plugins', 'uniform,datatable,select2');
		$this->assign('__sidebar', 'Question/index');
		//渲染模板
		$this->assign('meta_title', $title);
		$this->assign('meta_title_top', $title_top);
		$this->assign('exa_type',array('课后练习'=>'课后练习','考试'=>'考试'));
		$this->display();
	}
	
	/**
	 * 获取章节列表
	 */
	public function getQuestionList(){
		$queType = I('get.que_type');
		$que_score = I('get.que_score');
		$que_title = I('get.que_title');
		
		$packageId = I('get.package_id');//包ID
		
		$m = new QuestionModel();
		
		if($queType){
			$m->where(array('que_type'=>$queType));
		}
		
		if($que_score){
			$m->where(array('que_score'=>$que_score));
		}
		
		if($que_title){
			$m->where(array('que_title'=>array('like','%'.$que_title.'%')));
		}
		
		$m->where(array('package_id'=>$packageId));
		
		$m->order('question_id asc');
		$m->where(array('status'=>array('egt',0)));
		$tA   = $this->pagination($m);
		
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
	
				$tA['aaData'][$k][] = '<input type="checkbox" class="checkable" name="checkList" value="'.$v[$this->field].'">';
				//                $tA['aaData'][$k][] = $v['exa_title'];
				//                $tA['aaData'][$k][] = $v['exam_sequence'];
				$tA['aaData'][$k][] = $this->_examType($v['que_type'],true);
				$tA['aaData'][$k][] = $v['que_title'];
				$tA['aaData'][$k][] = $v['que_score'];
				$tA['aaData'][$k][] = $this->getOptionStr($v['option']);
				$tA['aaData'][$k][] = $this->getAnswerStr($v['option']);
				$tA['aaData'][$k][] = $v['explain'];
				$tA['aaData'][$k][] = date('Y-m-d H:i:s',$v['create_time']);
				$tA['aaData'][$k][] = $delete.$edit;
			}
		}
		unset($tA['data']);
		echo json_encode($tA);
	}
	
	/**
	 * 获取包信息
	 */
	public function getPackageInfo(){
		$id = I('get.id');
		$m = M((new QuestionModel())->tbCacheQuestionPackage);
		
		$tA = $m->where(array('id'=>$id))->find();
		
		echo json_encode($tA);
	}
	
	
	/**
	 * 保存题包
	 */
	public function savePackage(){
		$id = I('post.id');
		$title = I('post.title');
		//$type = I('post.type');
		
		$data = array(
				'title'=>$title,
				'type'=>0,
		);
		
		$m = M((new QuestionModel())->tbCacheQuestionPackage);
		$m->startTrans();//开启事务
		
		if(!$id){
			$data['total_score'] = 0;
			$data['status'] = 1;
			$data['addtime'] = time();
			
			$tId = $m->add($data);
			if (!$tId){
				$m->rollback();
				$this->error('保存失败');
			}
		}else{
			$query = $m->where(array('id'=>$id))->save($data);
			if($query === false){
				$m->rollback();
				$this->error('保存失败');
			}
		}
		
		$m->commit();
		$this->success('保存成功');
	}
	
	/**
	 * 删除题包
	 */
	public function deletePackage(){
		$id = I('get.id');
		
		$m = M((new QuestionModel())->tbCacheQuestionPackage);
		
		$query = $m->where(array('id'=>$id))->save(array('status'=>-1));
		if ($query === false){
			$this->error('删除失败');
		}
		
		$this->success('删除成功');
	}
	
	/**
	 * 批量删除
	 */
	public function checkedPackage(){
	
		$packageId = I('post.val');
		$type = I('post.type');
			
		$m = M((new QuestionModel())->tbCacheQuestionPackage);
			
		if($type == 1){
			$query = $m->where(array('id'=>array('in',$packageId)))->save(array('status'=>-1));
			if(!$query){
				$this->error('删除失败');
			}
			$this->success('删除成功');
		}
	
		$this->success('操作成功');
	}
	
	
	/**
	 * 添加考题
	 */
	public function save(){
		
		$m = new QuestionModel();
		$question_id = I('post.question_id'); //有则视为更新
		$package_id = I('post.package_id');//添加到题包
		
		$tag=array('A','B','C','D','E','F','G','H','I','J');
		$PAN=array('A','B');
		$ch=array();

		$data=array(
				'que_title'=>I('post.que_title'),
				'que_score'=>0,
				'explain'=>'',
				'que_type'=>I('post.que_type'),
		);
	
		/**
		 *获取添加的选项卡
		 */
		switch ($data['que_type']){  //1
			case 1:
				$da=I('post.danx');
				if(empty($da)){
					$this->error("选项不能为空");
				}
				$da_true=I('post.answer_danx');
				if(empty($da_true)){
					$this->error("必须有一个正确答案");
				}
				/* 循环一下题*/
				foreach ($da as $key =>$value){
					if(!$value)$this->error("选项信息不能为空");
					$ch[$key]=array(
							'tag'=>$tag[$key],
							'title'=>$value,
							'is_true'=>0,
							//'content'=>$value,
// 							'sort'=>$key+1,
// 							'create_time'=>time(),
					);
	
				}
				/*** 循环一下答案*/
				foreach ($da_true as $key =>$value){
					$ch[$value-1]['is_true']=1;
				}
				if(count($da_true)>1){
					$data['que_type']=2;
				}
				break;
			case 3:
				$da=I('post.pand');
				if(empty($da)){
					$this->error("选项不能为空");
				}
				$da_true=I('post.answer_pand');
				if(empty($da_true)){
					$this->error("必须有一个正确答案");
				}
				/* 循环一下题*/
				foreach ($da as $key =>$value){
					if(!$value)$this->error("选项信息不能为空");
					$ch[$key]=array(
							'tag'=>$PAN[$key],
							'title'=>$value,
							'is_true'=>0,
							//'content'=>$value,
// 							'sort'=>$key+1,
// 							'create_time'=>time(),
					);
				}
				/*** 循环一下答案*/
				foreach ($da_true as $key =>$value){
					$ch[$value-1]['is_true']=1;
				}
				break;
			case 4:
				break;
		}
	
		$data['option'] = json_encode($ch);
		
		//开启事务
		$m->startTrans();       
		if($question_id){
			$tId = $m->saveQuestion($data,$question_id);
			if ($query === false){
				$m->rollback();
				$this->error('保存考题失败(001)');
			}
		}else{
			$data['package_id'] = $package_id;
			$data['status'] = 1;
			$data['create_time'] = time();
			$tId = $m->saveQuestion($data);
			if (!$tId){
				$m->rollback();
				$this->error('保存考题失败');
			}
		}
		

		
		/* //非综合题
		if($data['que_type'] != 4){
			//选项设置考题ID
			foreach ($ch as $k => $v){
				$ch[$k]['question_id']=$question_id?:$tId;
			}
			//如果为更新
			if($question_id){

				//获取选项数组
				$tOption = $m->getOptionInfoById($question_id);

				//循环新的选项数组
				foreach ($ch as $k=>$v){
					//如果老的选项存在
					if($tOption[$k]['option_id']){
						$tAoid = $m->saveOption($v,$tOption[$k]['option_id']);//更新
						if(!$tAoid){
							$m->rollback();
							$this->error('保存选项失败');
						}
						//删除该数组
						unset($tOption[$k]);
					}else{
						$tAoid = $m->saveOption($v);
						if(!$tAoid){
							$m->rollback();
							$this->error('保存选项失败');
						}
					}
				}

				//检测多余的选项删除
				foreach ($tOption as $k=>$v){
					$m->deleteOption($v['option_id']);
				}
				
			}else{

				$tAoid = $m->saveOption($ch,0,true);
				if(!$tAoid){
					$m->rollback();
					$this->error('保存选项失败');
				}
			}
		} */
		//更新分数
		$res = $this->updatePackageScore($package_id);
		$m->commit();
		$this->success("添加成功");
	}
	
	/**
	 * Ajax 获取信息
	 */
	public function getInfo()
	{
		//$res['dataTag']=M('bang_section')->where(array('sec_tag'=>1))->select();
		//$res['diff']=$this->getDifficulty();
		//print_r(json_encode($res));
	}

	/**
	 * Ajax 获取信息
	 * @param unknown $id
	 */
	public function editGet($id){
		$m= new QuestionModel();
		$tQues = $m->getQuestionInfoById($id);
		$tQues['option'] = json_decode($tQues['option'],true);
		print_r(json_encode($tQues));
	}
	
	/**
	 * 获取状态
	 *
	 * @param	integer	$key
	 * @param	boolean	$show	是否显示
	 * @return	mixed
	 */
	protected function _PackageType($key = null, $show = false){
	
	
		$config = array(
				0 => '活动题包',
				1 => '考试',
				2 => '练习',
				3 => '测试题包',
		);
	
		if($key !== null){
	
			if(isset($config[$key]) && ! $show){
				return $config[$key];
			}
	
			if(isset($config[$key]) && $show){
	
				if($key == 1){
					return '<span class="label label-info">'.$config[$key].'</span>';
				}else if($key == 2){
					return '<span class="label label-success">'.$config[$key].'</span>';
				}
				else if($key == 3){
					return '<span class="label label-warning">'.$config[$key].'</span>';
				}else if($key == 4){
					return '<span class="label label-danger">'.$config[$key].'</span>';
				}else{
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
	protected function _examType($key = null, $show = false){
		
	
		$config = array(
				1 => '单选',
				2 => '多选',
				3 => '判断',
				4 => '综合',
		);
	
		if($key !== null){
	
			if(isset($config[$key]) && ! $show){
				return $config[$key];
			}
	
			if(isset($config[$key]) && $show){
	
				if($key == 1){
					return '<span class="label label-info">'.$config[$key].'</span>';
				}else if($key == 2){
					return '<span class="label label-success">'.$config[$key].'</span>';
				}
				else if($key == 3){
					return '<span class="label label-warning">'.$config[$key].'</span>';
				}else if($key == 4){
					return '<span class="label label-danger">'.$config[$key].'</span>';
				}
			}
			return '';
		}
	
		return $config;
	}

	/**
	 * 获取选项字符串
	 * @param array $option
	 * @return string
	 */
	public function getOptionStr($option = array()){
		$option = json_decode($option,true);
		$str = '';
		foreach ($option as $key =>$value){
			$str.=$value['tag'].'.'.$value['title'].'<br>';
		}
		
		return $str;
	}
	
	/**
	 * 正确答案字符串
	 * @param array $option
	 * @return string
	 */
	public function getAnswerStr($option = array()){
		$option = json_decode($option,true);
		$str='';
		foreach ($option as $key =>$value){
			if($value['is_true']){
				$str.=$value['tag'].'<br>';
			}
		}
		return $str;
	}
	
	/**
	 * 假删除
	 * {@inheritDoc}
	 * @see \Admin\Controller\AdminController::delete()
	 */
	public function delete($id){
		$m = new PaperModel();
		$m->startTrans();//开启事务
		
		$tA = M($m->tbCacheQuestion)->where(array('question_id'=>$id))->find();
		
		$query = M($m->tbCacheQuestion)->where(array('question_id'=>$id))->save(array('status'=>-1));
		if ($query === false){
			$m->rollback();
			$this->error('删除失败');
		}
		
		//更新
		//更新分数
		$res = $this->updatePackageScore($tA['package_id']);
		if(!$res){
			$m->rollback();
			$this->error('分数更新失败');
		}
		
		$m->commit();
		$this->success('删除成功');
	}
	
	public function checked(){
		
		$questionId = I('post.val');
		$type = I('post.type');
		 
		$m = new QuestionModel();
		 
		if($type == 1){
			$query = $m->where(array('question_id'=>array('in',$questionId)))->save(array('status'=>-1));
			if(!$query){
				$this->error('删除失败');
			}
			$this->success('删除成功');
		}
		
		$this->success('操作成功');
	}
	
	/**
	 * 导入题库
	 */
	public function impUser(){
		
		$packageId = I('post.package_id');//包名
		
		if(empty($_FILES['import'])){
			$this->error('请添加Excel文件');
		}
		
		if(!in_array($_FILES['import']['type'],array('application/vnd.ms-excel','application/octet-stream'))){
			$this->error('文件类型未知');
		}
		
		$data = getImport('import');
		
		/**
		 * 处理数据
		 */
		$pm = new PaperModel();
		$qm = new QuestionModel();
		$question = array();
		$option = array();
		$question_id=$qm->max('question_id')+1; //开始的ID
		
		$score = 0;//总分
		
		foreach ($data as $k=>$v){
			if($k == 1){
				//跳过第一行，
				continue;
			}
			
			if(empty($v[0])){
				//结束
				break;
			}
			//添加考题信息
			$question[$k] = array(
					'question_id'=>$question_id,
					'que_title'=>$v[1],
					'que_score'=>$v[3],
					'explain'=>$v[4],
					'que_type'=>$this->getQuestType($v[0]),
					'create_time'=>time(),
					'package_id'=>$packageId, //所属包
					'status'=>1,
			);
			$score +=$v[3];
			//添加选项
			$n = 5;
			$ascii = 65; //A的 ascii码
			$i = 0; //数组的下标
			$option = array();
			while (!empty($v[$n]) && $n<11){
				$tag = chr($ascii);//转化为A 然后递增
				
				$option[] = array(
						'tag'=>$tag,			//标签
						'title'=>$v[$n],		//该答案的描述
						'is_true'=>(stripos($v[2],$tag)!==false)?1:0,	//寻找到标签，则为真
				);
				
				$n++; //题行增加
				$ascii++;//Ascii码增加
			}
			$question[$k]['option'] = json_encode($option);
			$question_id++;  //考题的ID自增
		}
		
		//增加到数据库
		$qm->startTrans();
		
		$tid = $qm->addAll(array_values($question));
		if(!$tid){
			$qm->rollback();
			$this->error('导入失败');
		}
		
// 		$tid = M($pm->tbCacheOption)->addAll($option);
// 		if(!$tid){
// 			$qm->rollback();
// 			$this->error('导入失败');
// 		}
		
// 		//更新分数
// 		$res = $this->updatePackageScore($packageId);
// 		if(!$res){
// 			$qm->rollback();
// 			$this->error('分数更新失败');
// 		}
		
		$qm->commit();
		$this->success('导入成功');
	}
	
	/**
	 * 更新包的分数
	 * @param unknown $packageId
	 * @return boolean
	 */
	public function updatePackageScore($packageId){
		//更新包的分数
		$m = new QuestionModel();
		$que_score = $m->where(array('package_id'=>$packageId,'status'=>1))->SUM('que_score');
		$que_score = $que_score?:'0';
		$mm = M((new QuestionModel())->tbCacheQuestionPackage);
		$query = $mm->where(array('id'=>$packageId))->save(array('total_score'=>$que_score));
		if($query === false){
			return false;
		}
		return true;
	}
	
	/**
	 * 题库对应的类型转化
	 * @param unknown $key
	 * @return number
	 */
	public function getQuestType($key){
	
		if(!in_array(trim($key), array("单选题","多选题","判断题"))){
			$this->error('题型错误['.$key.']');
		}
		
		switch ($key){
			case '单选题':
				return 1;
				break;
			case '多选题':
				return 2;
				break;
			case '判断题':
				return 3;
				break;
		}
	}
	
	/**
	 * 下载模板
	 */
	function expUser(){//导出Excel
		downloadExcel();
	}
}