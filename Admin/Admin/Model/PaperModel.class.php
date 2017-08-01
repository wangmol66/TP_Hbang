<?php
namespace Admin\Model;
use Think\Model;
class PaperModel extends Model {

	public $tableName = 'cache_question_lib';
	public $tbCacheQuestion ='cache_question_lib';
	public $tbCacheOption ='cache_option_lib';
	public $tbCachePaperQuestion ='cache_paper_question_lib';
	
	public $PType = array('1'=>'考试');

	/**
	 * 获取考卷信息
	 * @param number $id
	 */
	public function getPaperInfoById($id = 0){
		
		$tA = $this->where(array('paper_id'=>$id))->find();
		
		return $tA;
	}
	
	/**
	 * 获取考卷信息
	 * @param number $id
	 */
	public function getPaperInfoByIds($ids = array()){
	
		$tA = $this->where(array('paper_id'=>array('in',$ids)))->select();
		
		$tData = array();
		foreach ($tA as $k=>$v){
			$tData[$v['paper_id']] = $v;
		}
	
		return $tData;
	}
	
	/**
	 * 获取考卷信息 通过名称搜索
	 * @param string $likeName
	 */
	public function getPaperByLikeName($likeName = ''){
		
		 
		$tA = $this->where(array('pap_name'=>array('like','%'.$likeName.'%'),'status'=>1))->select();
		//echo $m->getLastSql();
		$tData = array();
		 
		foreach ($tA as $k=>$v){
			$tData[$k]['id'] = $v['paper_id'];
			$tData[$k]['text'] = $v['pap_name'];
		}
		 
		return $tData;
	}
	
	/**
	 * 保存考卷信息
	 * @param integer $data
	 * @param number $id
	 */
	public function savePaper($data,$id = 0){
		$m = M($this->tableName);
		
		if($id>0){
			$query = $m->where(array('paper_id'=>$id))->save($data);
			if ($query === false){
				return false;
			}
			return true;
		}else {
			$tid = $m->add($data);
			return $tid;
		}
	}
	
	/**
	 * 获取该考卷发布了那些人
	 * @param number $paperId
	 */
	public function getPaperUserList($paperId = 0){
		$m = M($this->tableName);
		
		$um = new MemberModel();
		$tA = $um->getMemberExamModelLogByPaperId($paperId);
		
		$tData = array();
		foreach ($tA as $k=>$v){
			$tData[$k]['name'] = $v['nickname'];
			$tData[$k]['name'] = $v['nickname'];
			$tData[$k]['addtime'] = date('Y/m/d H:i:s',$v['create_time']);
		}
		
		return $tData;
	}
	
}