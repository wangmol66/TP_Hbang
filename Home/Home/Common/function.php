<?php 


##华邦制药微信公众号
defined("APPID")                or define("APPID",'wx4055e75bfc543199'); //微信管理员 LS__0626  华邦 罗双 微信号 2627369377@qq.com 密码:
defined("APPSECRET")            or define("APPSECRET",'5376f3fefc786dea3b8fc063e453b68a');



/**
 * 过去多久时间
 */
function LONG_AFTER(time $time){
	
	$long = time()-$time;
	
	if($long<60){
		
		return '刚刚';
		
	}else if($long<(60*60)){
		
		return floor($long/60).'分钟前';
		
	}else if($long<(60*60*24)){
		
		return floor($long/3600).'小时前';
		
	}else if($long>=(60*60*24) && $long<(60*60*24*28)){
	
		return floor($long/(3600*24)).'天前';
	}else{
	
		return date('Y-m-d H:i:s',$time);
	}
}

/**
 * 获取数组IDS
 * @param array $array			目标数组
 * @param string $idField		关键字段
 */
function GetIdsArray($array,$idField){
	$tId = array();
	foreach ($array as $k=>$v){
		if (!in_array($v[$idField], $tId)){
			$tId[] = $v[$idField];
		}
	}
	
	return $tId;
}

/**
 * 获取数组IDS
 * @param array $array			目标数组
 * @param string $idField		关键字段
 */
function PutIdsArray($array,$idField){
	$tId = array();
	foreach ($array as $k=>$v){
		$tId[$v[$idField]] = $v;
	}
	return $tId;
}
?>