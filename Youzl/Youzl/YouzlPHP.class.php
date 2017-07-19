<?php
namespace Youzl\Youzl;
require_once dirname(__FILE__).'/../Conf/config.php';//加载函数库
require_once dirname(__FILE__).'/../Function/function.php';//加载函数库

/**
 * 核心处理库
 * @author Youzl
 *
 */
class YouzlPHP{
	function __construct(){
		
	}
	
	//加载Youzl 包内第三方插件
	static public function vendor($class,$baseUrl = '/Youzl/Youzl/',$ext = '.php'){
		require ($baseUrl.$class.".php");
	}
}