<?php

namespace Admin\Slike;
use Admin\Controller\AdminController;

class NesTableController extends AdminController  {
	public $className        = '';
	public $tableName        = 'user_position';
	public $fieldName        = 'pos_name';
	public $parentsField     = 'position_pid';
	public $mainField        = 'position_id';
	public $fatherField      = '';
	public $sort             = 'sort';
	public $ceng             = 'ceng';
	public $postion          = 'postion';
	public $tag              = '';
	public $icon             = '';
	public $maxLevel         = 10;
	public $maxCeng          = 10;

	public $ispostion 		 = TRUE; //是否有定位
	public $isDisplayId 	 = FALSE; //是否有定位


	/**
	 * 增加节点
	 * @param $id
	 * @param $name
	 */
	public function add($id,$name,$section_id=0){
		
		
		$data=array(
				$this->fieldName=> $name,
				$this->parentsField=> $id,
				$this->fatherField=>$section_id,
		);


		//$address_id=I('post.exchange_id');
		$m=M($this->tableName);
		$tid=$m->add($data);
		
		if($_FILES['icon']){
			$res = $this->_uploadPicPath($_FILES['icon'],CONTROLLER_NAME,$tid);
			if($res['status']){
				$m->where(array($this->mainField=>$tid))->save(array('icon'=>$res['data']));
			}
		}
		
		if ($this->ispostion){
			if($id>0){
				$postion = $this->getPostion($id);
				$ceng = $this->getCeng($id);
				M($this->tableName)->where(array($this->mainField=>$tid))->save(array($this->postion=>'|'.$tid.$postion,$this->ceng=>$ceng+1));
			}else{
				M($this->tableName)->where(array($this->mainField=>$tid))->save(array($this->postion=>'|'.$tid.'|',$this->ceng=>1));
			}
		}

		if($tid){
			$this->success('保存成功');
		}else{
			$this->error('保存失败');
		}
	}

	/**
	 * 获取定位信息
	 */
	public function getPostion($id){
		$tD = M($this->tableName)->where(array($this->mainField=>$id))->find();
		return $tD[$this->postion];
	}
	
	/**
	 * 获取层级信息
	 */
	public function getCeng($id){
		$tD = M($this->tableName)->where(array($this->mainField=>$id))->find();
		return $tD[$this->ceng];
	}
	
	/**
	 * 删除
	 */
	public function delete($id){
		if(!$id){
			$this->error("数据错误");
		}
		$m=M($this->tableName);
		##删除父节点
		$res=$m->where(array($this->mainField=>$id))->delete();
		##删除子节点
		$this->delChild($id);
		if($res){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	/**
	 * 删除子节点
	 * @param $id
	 */
	public function delChild($id){
		$res=M($this->tableName)->where(array($this->parentsField=>$id))->select();
		M($this->tableName)->where(array($this->parentsField=>$id))->delete();
		foreach ($res as $key => $value){
			$this->delChild($value[$this->mainField]);
		}
	}

	/**
	 * 编辑保存
	 * @param $mid
	 * @param $name
	 * @param bool $tRes
	 */
	public function edit($mid,$name,$tRes=false){
		if(!$mid){
			$this->error("数据错误");
		}

		$data=array(
				$this->fieldName=> $name,
				$this->mainField=> $mid,
		);

		$m=M($this->tableName);
		$res=$m->save($data);

		if($_FILES['icon']){
			$res = $this->_uploadPicPath($_FILES['icon'],CONTROLLER_NAME,$mid);
			if($res['status']){
				$m->where(array($this->mainField=>$mid))->save(array('icon'=>$res['data']));
			}
		}
		
		if($res){
			$this->success('保存成功');
		}else{
			if(!$tRes){
				$this->error('保存失败');
			}else{
				$this->success('保存成功');
			}
		}
	}

	/**
	 * 修改数据
	 * @param $data
	 * @param $id
	 * @return mixed
	 */
	public function save($data,$id){
		return M($this->tableName)->where(array($this->mainField=>$id))->save($data);
	}
	/**
	 * 获取数据
	 */
	public function getList(){
		 
		//是否有上级ID 来查询列表
		$pid = I('get.pid');
		 
		if($pid){
			$sec['data']=$this->getChild($pid);
		}else{
			$sec['data']=$this->getChild();
		}

		##添加要传递的数据
		$sec['max']=$this->maxLevel; //可拖动的层级
		$sec['ceng']=$this->maxCeng; //可拖动的层级
		//print_r($sec);
		$sec['data']=empty($sec['data'])?array():$sec['data'];
		echo json_encode($sec);
	}

	/**
	 * 获取子节点
	 * @return mixed
	 */
	public function getChild($id = 0){
		$M = M($this->tableName);
		if(!empty($id)){
			$M->where(array('section_id'=>$id));
		}
		 
		$res=$M->field($this->mainField.' as id, '.$this->parentsField.' as pid, '.$this->fieldName.' as name '.(empty($this->tag)?'':','.$this->tag.' as tag').(empty($this->icon)?'':','.$this->icon.' as icon'))->order($this->parentsField.' asc,'.$this->sort.' asc,'.$this->mainField.' desc')->select();
		foreach ($res as $k=>$v){
			$res[$k]['delurl']=U($this->className.'/delete/id/'.$v['id']);
			if($this->isDisplayId){
				$res[$k]['name'].='  [ID:'.$v['id'].']';
			}
		}
		return $res;
	}

	/**
	 * 编辑分类
	 */
	public function getCategoryInfo($id=0){

		if( ! $id) $this->error('参数错误');
		$model = D($this->tableName);
		$field = '*,'.$this->mainField.' as position_id,'.$this->fieldName.' as pos_name ';
		if ($this->fatherField){
			$field .=','.$this->fatherField.' as sec_id';
		}

		$info = $model->field($field)
		->where(array($this->mainField => $id))->find();
		if( ! $info)$this->error('分类不存在');

		echo json_encode($info);
	}
	/**
	 * 分类排序
	 */
	public function categorySort($str=array()){
		$bool=false;
		$cModel = D($this->tableName);

		if( ! is_array($str) || ! $str) $this->error('参数错误');
		$data = $this->_categorySort($str);

		if(!$data) $this->success('保存成功');
		$cModel->startTrans();

		foreach ($data as $k => $v){
			//print_r($v);
			$postion = $this->getPostion($v['pid']);
			if($v['pid']>0){
				$postion='|'.$v['id'].$postion;
			}else{
				$postion ='|'.$v['id'].'|';
			}
			$ceng = $this->getCeng($v['pid']);
			$query = $cModel->where(array($this->mainField => $v['id']))->save(array($this->sort => $v['sort'],$this->parentsField => $v['pid'],$this->postion=>$postion,$this->ceng=>$ceng+1));
			if($query){
				$bool=true;
			}
		}
		if(!$bool){
			$cModel->rollback();
			$this->success('尚未修改');
		}
		$cModel->commit();
		$this->success('保存成功');
	}

	/**
	 * 整理排序数据
	 */
	protected function _categorySort($data, $pid = 0){
		$temp = array();
		foreach ($data as $k => $v){
			$temp[] = array('id' => $v['id'], 'sort' => $k + 1, 'pid' => $pid);
			if( ! empty($v['children'])){
				$temp = array_merge($temp, $this->_categorySort($v['children'], $v['id']));
			}
		}

		return $temp;
	}
}