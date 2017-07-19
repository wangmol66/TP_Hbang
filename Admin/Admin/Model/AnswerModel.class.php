<?php
namespace Admin\Model;
use Think\Model;
class AnswerModel extends Model {
	public $tableName = 'hbang_answer';
	public $tbAnswerReply = 'hbang_answer_reply';
	
	/**
	 * 获取邦邦解答列表
	 */
	public function getAnswerById($answerId){
	
		//获取数据
		$tA = $this->where(array('status'=>array('egt',0),'id'=>$answerId))->find();
	
		if(!$tA){
			return array();
		}
	
		/*获取用户信息*/
		$um = new MemberModel();
	
		$User = $um->getUserByIds(array($tA['user_id']));//获取用户信息
	
		$tA['author'] = $User[$tA['user_id']]['nickname'];
		$tA['head_url'] = $User[$tA['user_id']]['headimgurl'];
		$tA['addtime_1'] = date('Y-m-d H:i:s',$tA['addtime']);
		$tA['images_1'] = json_decode($tA['images'],true);
	
		return $tA;
	}
}