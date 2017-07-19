<?php 
	
	$res = file_get_contents('http://dm.deepinfo.cn/hbang/index.php?s=/Follow/run.html');
	
	//每5分钟执行一次
	$res = file_get_contents('http://dm.deepinfo.cn/hbang/index.php?s=/Follow/helper_run.html');
	print_r($res);

	/**
	 * 设置定时任务时添加命令
	 * D:\SOFT_PHP_PACKAGE\php5.4\php.exe -q D:\wwwroot\demo\wwwroot\hbang\Follow\run.php //PHP命令 执行PHP文件
	 */
?>