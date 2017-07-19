<?php
namespace Home\Model;
use Think\Model;
class AnswerModel extends Model {
	public $tableName 				= 'hbang_answer';
	public $tbAnswerReply 			= 'hbang_answer_reply';
	public $tbAnswerUserLog 		= 'hbang_answer_user_log';  //问题 用户的操作记录
	
	private $where = ''; //条件
	
	/**
	 * 设置where
	 * @param unknown $where
	 * @return \Home\Model\AnswerModel
	 */
	public function setWhere($where){
		$this->where = $where;
		return $this;
	}
	
	/**
	 * 清除
	 */
	public function clean(){
		$this->where = '';
	}
	
	
	/**
	 * 获取邦邦解答列表
	 */
	public function getAnswerList($order = 'id asc',$limit = '0,1000',$func = NULL){
		$option = array('status'=>1);
		
		if(!is_null($func)){
			$option = $func($option);
		}
		
		//获取数据
		$tA = $this->where($option)->limit($limit)->order($order)->select();
		
		$tUid = array(); //用户ID
		$tAid = array(); //文章ID
		foreach ($tA as $k=>$v){
			if(!in_array($v['user_id'], $tUid)){
				$tUid[] = $v['user_id'];
			}
			if(!in_array($v['id'], $tAid)){
				$tAid[] = $v['id'];
			}
		}
		
		if(!$tUid){
			return array();
		}
		
		/*获取用户信息*/
		$um = new UserModel();
		
		$User = $um->getUserByIds($tUid);//获取用户信息
		
		/*获取点赞记录*/
		$log = $this->getUserLog($tAid, UID);

		foreach ($tA as $k=>$v){
			$tA[$k]['author'] = $User[$v['user_id']]['nickname'];
			$tA[$k]['head_url'] = $User[$v['user_id']]['headimgurl'];
			$tA[$k]['addtime_1'] = date('Y-m-d H:i:s',$v['addtime']);
			$tA[$k]['addtime_2'] = LONG_AFTER($v['addtime']);
			$tA[$k]['images_1'] = json_decode($v['images'],true);
			$tA[$k]['dianzan'] = empty($log[$v['id']])?'0':'1';
			
		}
		
		return $tA;
	}
	
	
	/**
	 * 获取该用户的文章操作记录
	 * @param array $answerId
	 * @param int $userId
	 * @param int $type    1-浏览记录  2-文章点赞记录  3-给回复点赞记录
	 */
	public function getUserLog($answerId,$userId,$type = 2){
		$m = M($this->tbAnswerUserLog);
		
		$tA = $m->where(array('answer_id'=>array('in',$answerId),'user_id'=>$userId,'type_id'=>$type))->select();
		
		$tLog = array();
		foreach ($tA as $k => $v){
			$tLog[$v['answer_id']] = $v;
		}
		
		return $tLog;
	}
	
	/**
	 * 获取邦邦解答列表
	 */
	public function getAnswerById($answerId){
	
		//获取数据
		$tA = $this->where(array('status'=>1,'id'=>$answerId))->find();
	
		if(!$tA){
			return array();
		}
	
		/*获取用户信息*/
		$um = new UserModel();
	
		$User = $um->getUserByIds(array($tA['user_id']));//获取用户信息
		
		/*获取该文章是否点赞*/
		$log = $this->getUserLog(array($tA['id']), UID);
		
		$tA['author'] = $User[$tA['user_id']]['nickname'];
		$tA['head_url'] = $User[$tA['user_id']]['headimgurl'];
		$tA['addtime_1'] = date('Y-m-d H:i:s',$tA['addtime']);
		$tA['addtime_2'] = LONG_AFTER($tA['addtime']);
		$tA['images_1'] = json_decode($tA['images'],true);
		$tA['dianzan'] = empty($log[$tA['id']])?'0':'1';
	
		return $tA;
	}
	
	/**
	 * 获取该文章的权威回复
	 * @param unknown $answerId
	 */
	public function getAuthority($answerId){
		$m = M($this->tbAnswerReply);
		
		$tA = $m->where(array('answer_id'=>$answerId,'authority'=>1))->find();
		
		if(!$tA){
			return array();
		}
		
		$um = new UserModel();
		$tUser = $um->where(array('uid'=>$tA['user_id']))->find();

		$tA['nickname'] = $tUser['nickname'];
		$tA['headimgurl'] = $tUser['headimgurl'];
		$tA['addtime_1'] = date('Y-m-d H:i:s',$tA['addtime']);
		$tA['addtime_2'] = LONG_AFTER($tA['addtime']);
		return $tA;
	}
	
	/**
	 * 邦邦解答 行为
	 * @param unknown $userId	用户ID
	 * @param unknown $answerId	文章ID
	 * @param number $type	类型 1-浏览 2-点赞
	 * @return boolean
	 */
	public function answerAction($userId,$answerId,$type = 1){
		
		$m = M($this->tbAnswerUserLog);
		
		$time = date('Y/m/d');//时间
		
		if($type == 1){
			$tA = $m->where(array('time'=>$time,'user_id'=>$userId,'answer_id'=>$answerId,'type_id'=>1))->find();
		}else if($type == 2){
			$tA = $m->where(array('user_id'=>$userId,'answer_id'=>$answerId,'type_id'=>2))->find();
		}else if($type == 3){
			$tA = $m->where(array('user_id'=>$userId,'answer_id'=>$answerId,'type_id'=>3))->find();
		}
		
		
		if(!$tA){
			
			$data = array(
					'answer_id'=>$answerId,
					'type_id'=>$type,
					'user_id'=>$userId,
					'time'=>$time,
					'addtime'=>time(),
			);
			
			$tId = $m->add($data);
			if(!$tId){
				return false;//操作失败
			}
			
			if($type == 1){
				$this->where(array('id'=>$answerId))->setInc('view');
			}elseif ($type == 2){
				$this->where(array('id'=>$answerId))->setInc('good');
			}elseif ($type == 3){
				M($this->tbAnswerReply)->where(array('rid'=>$answerId))->setInc('good');
			}
			
			return true;//操作成功
		}
		
		return false;//操作失败
	}
	
	/**
	 * 根据条件模糊查询
	 * @param unknown $like
	 * @return mixed|boolean|string|NULL|unknown|object
	 */
	public function getAnswerByLikeName($like,$order = 'id asc'){
		
		$this->getAnswerList();
		$tA = $this->where(array())->order($order)->select();
		
		return $tA;
	}
	
	
	/**
	 * 获取回复列表
	 * @param unknown $reviewId
	 */
	public function getReplyList($answerId){
		$model = M($this->tbAnswerReply);
		$reply = $model->where(array('answer_id'=>$answerId))->select();
	
		if(!$reply){
			return array();
		}
	
		//获取用户信息
		$uId = array();
		$rId = array();
		foreach ($reply as $k=>$v){
			if(!in_array($v['user_id'], $uId)){
				$uId[] = $v['user_id'];
			}
			if(!in_array($v['rid'], $rId)){
				$rId[] = $v['rid'];
			}
		}
	
		$um = new UserModel();
		$tUser = $um->getUserByIds($uId);
		
		/*检测那些回复点赞*/
		$log = $this->getUserLog($rId, UID,3);
	
		//数据
		foreach ($reply as $k=>$v){
			$reply[$k]['nickname'] = $tUser[$v['user_id']]['nickname'];
			$reply[$k]['headimgurl'] = $tUser[$v['user_id']]['headimgurl'];
			$reply[$k]['addtime_1'] = date('Y-m-d H:i:s',$v['addtime']);
			$reply[$k]['addtime_2'] =LONG_AFTER($v['addtime']);
			$reply[$k]['dianzan'] =empty($log[$v['rid']])?'0':'1';
		}
	
		$tData = getchildReply(0,$reply,'rid','prid','child');//来自Youzl方法
	
		return $tData;
	}
	
	
	/**
	 * 更新回复数量
	 */
	public function updateReviewReply($id){
		$m = M($this->tbAnswerReply);
	
		$reply = $m->where(array('answer_id'=>$id,'prid'=>0))->count();
	
		$query = $this->where(array('id'=>$id))->save(array('reply'=>$reply));
		if ($query === false){
			return false;
		}
		return true;
	}
	
	/**
	 * 获取邦解答记录
	 */
	public function getAnswerLog($userId,$typeId = 0){
		$m = M($this->tbAnswerUserLog);
		
		if(!$userId){
			return array();
		}
		
		if( $typeId > 0 ){
			$m->where(array('a.type_id'=>$typeId));
		}
		
		//获取数据
		$tA = $m->alias('a')
		->field('a.*,b.*,b.id as id_b,a.addtime as addtime_a,b.status')
		->where(array('a.user_id'=>$userId))
		->join($this->tableName.' b ON a.answer_id=b.id','LEFT')
		->order('a.addtime desc')
		->group('a.type_id,a.answer_id')
		->select();
		
		foreach ($tA as $k=>$v){
			$tA[$k]['img'] = json_decode($v['images'],true);
			$tA[$k]['addtime_1'] = date('Y-m-d H:i:s',$v['addtime_a']);
			$tA[$k]['status'] = empty($v['status'])?'0':'1';
			if(!$v['id_b']){
				unset($tA[$k]);
			}
		}
		//print_r($tA);
		return $tA;
	}
	
	/**
	 * 获取我发布的
	 */
	public function getMyAnswerList($userId){
		
		$tA = $this->where(array('user_id'=>$userId))->order('addtime desc')->select();
		
		foreach ($tA as $k=>$v){
			$tA[$k]['img'] = json_decode($v['images'],true);
			$tA[$k]['addtime_1'] = date('Y-m-d H:i:s',$v['addtime']);
		}
		
		//print_r($tA);
		return $tA;
	}
	
	/**
	 * 获取我回复的帖子
	 * @param unknown $userId
	 */
	public function getMyReplyList($userId){
		$m = M($this->tbAnswerReply);
		$tA = $m->alias('a')
		->field('a.*,b.*,a.addtime as addtime_a,b.user_id as user_id_b')
		->where(array('a.user_id'=>$userId))
		->join($this->tableName.' b ON a.answer_id = b.id','LEFT')
		->order('a.addtime desc')
		->group('a.user_id,a.answer_id')
		->select();
		
		$Uids = array();
		foreach ($tA as $k=>$v){
			if(!in_array($v['user_id_b'], $Uid)){
				$Uids[] = $v['user_id_b'];
			}
		}
		
		//获取用户信息
		$um = new UserModel();
		$tUser = $um->getUserByIds($Uids);
		
		foreach ($tA as $k=>$v){
			$tA[$k]['headimgurl'] = $tUser[$v['user_id_b']]['headimgurl'];
			$tA[$k]['nickname'] = $tUser[$v['user_id_b']]['nickname'];
			$tA[$k]['img'] = json_decode($v['images'],true);
			$tA[$k]['addtime_1'] = date('Y-m-d H:i:s',$v['addtime']);
			$tA[$k]['addtime_2'] = LONG_AFTER($v['addtime']);
		}
		//print_r($tA);
		return $tA;
	}
}






