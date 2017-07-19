<?php
namespace Home\Model;
use Think\Model;
class DoctorModel extends Model {
	public $tableName 			= 'hbang_doctor';			//往期回顾
	public $tbDoctorReply 		= 'hbang_doctor_reply';		//回复列表
	public $tbDoctorUserLog 	= 'hbang_doctor_user_log';	//用户操作记录
	public $tbDoctorCategory 	= 'hbang_doctor_category';	//用户操作记录
	
	
	/**
	 * 获取该用户的文章操作记录
	 * @param array $answerId
	 * @param int $userId
	 * @param int $type    1-浏览记录  2-文章点赞记录  3-给回复点赞记录
	 */
	public function getUserLog($answerId,$userId,$type = 2){
		$m = M($this->tbDoctorUserLog);
	
		$tA = $m->where(array('review_id'=>array('in',$answerId),'user_id'=>$userId,'type_id'=>$type))->select();
	
		$tLog = array();
		foreach ($tA as $k => $v){
			$tLog[$v['review_id']] = $v;
		}
	
		return $tLog;
	}
	
	
	/**
	 * 获取回复列表
	 * @param unknown $reviewId
	 */
	public function getReplyList($reviewId){
		$model = M($this->tbDoctorReply);
		$reply = $model->where(array('review_id'=>$reviewId))->select();
	
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
	
		/*获取点赞记录*/
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
	 * 邦邦解答 行为
	 * @param unknown $userId	用户ID
	 * @param unknown $answerId	文章ID
	 * @param number $type	类型 1-浏览 2-点赞
	 * @return boolean
	 */
	public function reviewAction($userId,$reviewId,$type = 1){
	
		$m = M($this->tbDoctorUserLog);
	
		$time = date('Y/m/d');//时间
	
		if($type == 1){
			$tA = $m->where(array('time'=>$time,'user_id'=>$userId,'review_id'=>$reviewId,'type_id'=>1))->find();
		}else if($type == 2){
			$tA = $m->where(array('user_id'=>$userId,'review_id'=>$reviewId,'type_id'=>2))->find();
		}else if($type == 3){
			$tA = $m->where(array('user_id'=>$userId,'review_id'=>$reviewId,'type_id'=>3))->find();
		}
	
		if(!$tA){
	
			$data = array(
					'review_id'=>$reviewId,
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
				$this->where(array('id'=>$reviewId))->setInc('view');
			}elseif ($type == 2){
				$this->where(array('id'=>$reviewId))->setInc('good');
			}elseif ($type == 3){
				M($this->tbDoctorReply)->where(array('rid'=>$reviewId))->setInc('good');
			}
	
			return true;//操作成功
		}
	
		return false;//操作失败
	}
	
	/**
	 * 更新回复数量
	 */
	public function updateReviewReply($id){
		$m = M($this->tbDoctorReply);
	
		$reply = $m->where(array('review_id'=>$id,'prid'=>0))->count();
	
		$query = $this->where(array('id'=>$id))->save(array('reply'=>$reply));
		if ($query === false){
			return false;
		}
		return true;
	}
	
	/**
	 * 获取邦解答记录
	 */
	public function getDoctorLog($userId,$typeId = 0){
		$m = M($this->tbDoctorUserLog);
	
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
		->join($this->tableName.' b ON a.review_id=b.id','LEFT')
		->order('a.addtime desc')
		->group('a.type_id,a.review_id')
		->select();
	
		foreach ($tA as $k=>$v){
			
			$tA[$k]['img'] = json_decode($v['images'],true);
			$tA[$k]['addtime_1'] = date('Y-m-d H:i:s',$v['addtime_a']);
			$tA[$k]['status'] = empty($v['status'])?'0':'1';
			
			if(!$v['id_b']){
				unset($tA[$k]);
			}
		}
	
		return $tA;
	}
}