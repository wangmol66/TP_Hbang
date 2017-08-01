<?php
namespace Admin\Model;
use Think\Model;
/**
 * 考卷、题库、等模块
 * @author Administrator
 *
 */
class QuestionModel extends Model {

	protected $tableName = 'cache_question_lib';
	public $tbTestOptionLib = 'cache_option_lib';
	public $tbCacheQuestionPackage = 'cache_question_package'; //题库包
	
	
	/**
	 * 获取选项列表
	 * @param integer $ids	ids
	 * @return array 
	 */
	public function getOptionByIds($ids){
		$m = M($this->tbTestOptionLib);
		
		$tA = $m->where(array('question_id'=>array('in',$ids)))->select();
		
		$tData = array();
		foreach ($tA as $k=>$v){
			$tData[$v['question_id']][] = $v;
		}
		
		return $tData;
	}
	
	/**
	 * 获取选项信息  通过ID
	 * @param integer $id 选项ID
	 * @return array 选项数组
	 */
	public function getOptionInfoById($id){
		$m = M($this->tbTestOptionLib);
		
		$tA = $m->where(array('question_id'=>$id))->select();
		
		return $tA;
	}
	
	/**
	 * 保存选项信息 
	 * @param array $data	数据Array
	 * @param number $id	选项id(有则视为更新)
	 * @param string $all	是否dataList
	 * @return mixed
	 */
	public function saveOption($data = array(),$id = 0,$all = false){
		
		$m = M($this->tbTestOptionLib);
		
		if($id>0){
			$query = $m->where(array('option_id'=>$id))->save($data);
			return $query;
		}elseif($all){
			$tId = $m->addAll($data);
			return $tId;
		}else{
			$tId = $m->add($data);
			return $tId;
		}
	}
	
	/**
	 * 删除指定选项
	 * @param number $id	选项ID
	 * @return mixed|boolean|unknown
	 */
	public function deleteOption($id = 0){
		$m = M($this->tbTestOptionLib);
		$query = $m->where(array('option_id'=>$id))->delete();
		return $query;
	}
	/**
	 * 获取考题信息 通过id
	 * @param integer $id 考题ID
	 * @return array  考题信息
	 */
	public function getQuestionInfoById($id = 0){
		$m = M($this->tableName);
		$tA = $m->where(array('question_id'=>$id))->find();
		
		return $tA;
	}
	
	/**
	 * 保存考题信息
	 * @param array $data	数组数据
	 * @param number $id	考题ID(有则视为更新)
	 * @return mixed
	 */
	public function saveQuestion($data = array(),$id = 0){
		$m = M($this->tableName);
		
		if($id>0){
			$query = $m->where(array('question_id'=>$id))->save($data);
			return $query;
		}else{
			$tId = $m->add($data);
			return $tId;
		}
	}
}