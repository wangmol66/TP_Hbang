<?php
namespace Home\Model;
use Think\Model;
use Home\Slike\WechatTempleat\WxTempleat;
use Home\Slike\WechatTempleat\WxCreateTempleat;
class HelperModel extends Model {

	protected $tableName = 'hbang_helper';
	public $tbHelperJoin = 'hbang_helper_join';
	
	/**
	 * 抽奖
	 * @param unknown $helperId
	 */
	public function LuckDraw($helperId){
		
		$this->startTrans();//开启事务
		
		//获取信息
		$tA = $this->where(array('id'=>$helperId))->find();
		//是否已经抽奖
		if($tA['is_luckdraw']){
			$this->rollback();
			return array('status'=>0,'msg'=>'该会议已经抽过奖了');
		}
		
		$m = M($this->tbHelperJoin);
		//抽取中间人 随机
		$where = array();
		$where['helper_id'] = $helperId; //该会议的ID
		$where['status'] = 2; //答题且答对的人
		$tPrize = $m->where($where)->limit(0,$tA['prize'])->order('rand()')->select();
		
		//是否有中奖人
		if(!$tPrize){
			$this->rollback();
			return array('status'=>0,'msg'=>'没有抽出中奖人');
		}
		
		//获取中间的答案
		$pid = array();
		foreach ($tPrize as $k=>$v){
			if(!in_array($v['id'], $pid)){
				$pid[] = $v['id'];
			}
		}
		
		$prizeSize = count($pid); //中奖个数
		
		//中奖状态
		$query = $m->where(array('id'=>array('in',$pid)))->save(array('is_prize'=>1));
		if($query === false || $query<=0){
			$this->rollback();
			return array('status'=>0,'msg'=>'更改中奖状态时错误');
		}
		
		$query = $this->where(array('id'=>$helperId))->save(array('winners'=>$prizeSize,'is_luckdraw'=>1));//修改中奖人数，以及中奖状态
		if($query === false || $query<=0){
			$this->rollback();
			return array('status'=>0,'msg'=>'设置中奖人时错误');
		}
		
		//获取中奖人信息
		$um = new UserModel();
		$where = array();
		$where['a.id'] = array('in',$pid);
		
		$tJoin = $m->where($where)
		->alias('a')
		->join($um->getTableName().' b on a.user_id=b.uid','LEFT')
		->select();
		
		foreach ($tJoin as $k=>$v){
			//发布结果通知
			$this->prizeNotice($v['openid'],$tA['title'],$tA['address'],$tA['addtime']);
		}
		
		$this->commit();
		return array('status'=>1,'msg'=>'成功抽出'.$prizeSize.'人中奖');
	}
	
	/**
	 * 中奖通知
	 */
	public function prizeNotice($openId,$title,$address,$time){
		$we = new WxTempleat();
		$t = new WxCreateTempleat();
		
		
		$t->SetOpenid($openId);
		$t->SetUrl('#');
		$t->SetParam('first', '恭喜您,成功答对题,并且中奖。');
		$t->SetParam('keyword1', $title);
		$t->SetParam('keyword2', $address);
		$t->SetParam('keyword3', date('Y-m-d H:i',$time));
		$t->SetParam('remark', '请前往线下领取奖品');
		
		$t->SetTemplateId('fqbjcyOmnsS3Hd36083yomcx7JL0pFSN9UWT-62cyY8');
		
		$template = $t->GetTemplate();
		
		$we->sendMsgTemplate($template);
	}
	
	
}

















