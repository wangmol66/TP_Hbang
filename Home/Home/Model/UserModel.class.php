<?php
namespace Home\Model;
use Think\Model;
class UserModel extends Model {

	protected $tableName = 'wechat_user';
	public $tbCollection = 'user_collection';
	
	public function isUser($info = array()){
		
		if(!$info['openid']){
			return 0;
		}
		$_SESSION['user']['subscribe'] = $info['subscribe']; //设置session
		$_SESSION['user']['nickname'] = $info['nickname']; //设置session
		$_SESSION['user']['headimgurl'] = $info['headimgurl']; //设置session
		
		$tA = $this->where(array('openid'=>$info['openid']))->find();
		if ($tA){
			return $tA['uid'];
		}else {
			$info['addtime'] = time();
			$uid = $this->add($info);
			if (!$uid){
				return 0;
			}
			
			
			return $uid;
		}
	}
	
	
	/**
	 * 获取用户信息 通过ids
	 * @param array $Uids
	 */
	public function getUserByIds($Uids = array()){
		
		$tUA = $this->where(array('uid'=>array('in',$Uids)))->select();
		
		$User = array();
		foreach ($tUA as $k=>$v){
			$User[$v['uid']] = $v;//信息以用户ID做为键
			$User[$v['uid']]['nickname'] = empty($v['nickname'])?'匿名':$v['nickname'];//信息以用户ID做为键
		}
		
		return $User;
	}
	
	
	/**
	 * 检查是否有收藏
	 * @param integer $answerId		收藏ID
	 * @param integer $typeid		类型ID 1-收藏邦邦解答 2-收藏 往期回顾 3-邦邦医生
	 * @return integer	存在-1  不存在-0
	 */
	public function isCollection($answerId,$typeid = 1){
		//是否被收藏
		$um = M($this->tbCollection);
		
		$tA = $um->where(array('collection_id'=>$answerId,'user_id'=>UID,'typeid'=>$typeid))->find();
		if (!$tA){
			return 0;
		}
		return 1;
	}
	
	/**
	 * 获取收藏记录
	 * @param number $typeid 1-收藏邦邦解答 2-收藏 往期回顾 3-邦邦医生
	 * @return mixed
	 */
	public function getCollection($typeid = 1){
		
		//是否被收藏
		$um = M($this->tbCollection);
		
		//对象数组
		$Model = array(
				'',
				(new AnswerModel()),
				(new ReviewModel()),
				(new DoctorModel())
		); 
		
		if(!UID){return array();}
		
		$tA = $um->where(array('user_id'=>UID,'typeid'=>$typeid))->order('addtime desc')->select();
		if (!$tA){
			return array();
		}
		
		//获取ID
		$collId = GetIdsArray($tA, 'collection_id');
		
		$tArray = $Model[$typeid]->where(array('id'=>array('in',$collId)))->select();
		
		$tInfo = PutIdsArray($tArray, 'id');
		
		foreach ($tA as $k=>$v){
			$tA[$k]['i_id'] = $tInfo[$v['collection_id']]['id'];
			$tA[$k]['title'] = $tInfo[$v['collection_id']]['title'];
			$tA[$k]['content'] = $tInfo[$v['collection_id']]['content'];
			$tA[$k]['good'] = $tInfo[$v['collection_id']]['good'];
			$tA[$k]['reply'] = $tInfo[$v['collection_id']]['reply'];
			$tA[$k]['view'] = $tInfo[$v['collection_id']]['view'];
			$tA[$k]['addtime_1'] = date('Y-m-d H:i:s',$tInfo[$v['collection_id']]['addtime']);
			$tA[$k]['images'] = json_decode($tInfo[$v['collection_id']]['images'],true)[0];
			$tA[$k]['show_url'] = $tInfo[$v['collection_id']]['show_url'];
			$tA[$k]['status'] = $tInfo[$v['collection_id']]['status'];
		}
		
		return $tA;
	}
	
	
	
	
}











