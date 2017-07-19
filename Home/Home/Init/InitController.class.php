<?php
namespace Home\Init;
use Think\Controller;
use Home\Slike\Wechat\Weixin;
use Home\Model\UserModel;
class InitController extends Controller {
	
   
   function __construct(){
   		parent::__construct();
   		if(ACTION_NAME == 'about'){
   			return 0;
   		}
   		$this->setUser();
   }
   
   /**
    * 通过微信授权获取用户的信息
    * @author Rable
    */
   public function setUser(){
   		$wx = new Weixin();
   		$m = new UserModel();
   		
	   	if (!$_SESSION['user']){
	   		$openId = $wx->get_openid();
	   		$user = $wx->get_user_info($openId);
	   		
	   		$uid = $m->isUser($user);
	   		if (!$uid){
	   			//$this->error('错误');
	   		}
	   	}else {
	   		//goto goon;
	   		$user = $wx->get_user_info($_SESSION['wechat']);//更新用户头像
	   		//print_r($user);
	   		$data = array(
	   				'nickname'=>$user['nickname'],
	   				'subscribe'=>$user['subscribe'],
	   				'headimgurl'=>$user['headimgurl'],
	   		);
	   		
	   		$m->where(array('openid'=>$_SESSION['wechat']))->save($data);
	   	}
	   	
	   	//goon:
	   	
	   	$tA = $m->where(array('openid'=>$_SESSION['wechat']))->find();
	   	defined('UID') or define('UID', $tA['uid']);
   }
   
   /**
    * 检查图片是否为空
    * @param array $data
    * @param string $field
    * @return string|unknown
    */
   public function ImgEmpty($data = array(),$field = 'img'){
   	
   		foreach ($data as $k=>$v){
   			$data[$k][$field] = empty($v[$field])?__ROOT__ . '/Public/Slike/images/null1.png':$v[$field];
   			$data[$k]['is_thumb'] = empty($v[$field])?0:1;
   		}
   		//print_r($data);
   		return $data;
   }
   
   
   /**
    * 收藏
    * @param unknown $userId	用户ID
    * @param unknown $id		收藏ID
    * @param number $type		类型 1-收藏邦邦解答 2-收藏 往期回顾 3-邦邦医生
    */
   public function collection($userId,$id,$type = 1){
   		$m = M((new UserModel())->tbCollection);
   		
   		$tA = $m->where(array('collection_id'=>$id,'user_id'=>$userId,'typeid'=>$type))->find();
   		
   		if($tA){
   			$query = $m->where(array('collection_id'=>$id,'user_id'=>$userId,'typeid'=>$type))->delete();
   			if(!$query){
   				$this->error('取消失败');
   			}
   			$this->success('取消成功');
   		}else {
   			
   			$query = $m->add(array('collection_id'=>$id,'user_id'=>$userId,'typeid'=>$type,'addtime'=>time()));
   			
   			if(!$query){
   				$this->error('收藏失败');
   			}
   			$this->success('收藏成功');
   		}
   }
   
   
   
}












