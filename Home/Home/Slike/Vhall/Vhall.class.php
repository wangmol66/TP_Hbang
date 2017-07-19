<?php 

namespace Home\Slike\Vhall;

class Vhall{
	
	const WEBINAR_CREATE 	= 'webinar/create ';   	//创建活动
	const WEBINAR_LIST 		= 'webinar/list';   	//获取活动列表
	const WEBINAR_FETCH     = 'webinar/fetch';   	//获取活动信息
	
	private $url = 'http://e.vhall.com/api/vhallapi/v2/';
	/**
	 * 帐号
	 */
	const USER_ID = '18782958633';
	
	/**
	 * 获取活动列表
	 * @param number $limit	 	获取条数
	 * @param string $userId	直播帐号  微吼用户id，支持传入子账号id，仅在需要获取单个子账号的活动时传入
	 * @param number $type		直播帐号  获取类型 1为个人所有活动,2为子账号的所有活动；
	 * @param number $status	直播状态 1:直播进行中,2:预约中,3:结束,4:已结束且有默认回放 不传递此参数则为所有活动,（如需组合查询,可将该值写成json字符串的形式。如status为[1,2]代表同时获取活动状态,活动状态
	 * @param number $pos		数字,设置从第几条数据开始获取，如果是第一条数据（pos=0）
	 * @return array
	 */
	public function getWebinarList($limit = 5, $userId = '', $type = 0, $status = 0, $pos = 0){
		
		$param = array(
				'auth_type'=>1,
				'account'=>'v17016031',
				'password'=>'scfzb2017',
				'pos'=>$pos,
				'limit'=>$limit,
		);
		
		//查询子账号帐号ID 
		//type:1为个人所有活动,2为子账号的所有活动；
		if($userId){
			$param['type'] 		= $type;
			$param['user_id'] 	= $userId;
		}
		
		//查询直播状态 1:直播进行中,2:预约中,3:结束,4:已结束且有默认回放
		if($status){
			$param['status'] = $status;
		}
		
		return $this->POST($param,self::WEBINAR_LIST);
	}
	
	/**
	 * 获取活动信息
	 * @param number $webinar_id
	 * @param string $fields
	 * @return mixed
	 */
	public function getWebinarFetch($webinar_id = 0,$fields = ''){
		
		$param = array(
				'auth_type'=>1,
				'account'=>'v17016031',
				'password'=>'scfzb2017',
				'webinar_id'=>$webinar_id,
				'fields'=>$fields,
		);
		
		return $this->POST($param,self::WEBINAR_FETCH);
	}
	
	/**
	 * 执行POST请求的方法
	 * @param unknown $post_data
	 */
	public function POST($post_data,$func){

		$data = http_build_query($post_data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL, $this->url.$func);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_TIMEOUT, 6);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;//操作成功，返回{'code':200,'data':'123456789'}
	}
}



