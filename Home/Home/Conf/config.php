<?php
return array(
	//'配置项'=>'配置值'
	
		'URL_MODEL'            => 3, //URL模式
		/* 模板相关配置 */
		'TMPL_PARSE_STRING' => array(
				'__STATIC__' => __ROOT__ . '/Public/static',
				'__HOME__'      => __ROOT__ . '/Public/Home',
				'__SLIKE__' => __ROOT__ .'/Public/Slike',
				'__TITLE__'  => '华邦直播',
		),
		
		/* 模块相关配置 */
		'AUTOLOAD_NAMESPACE' => array(
				'Youzl' =>	'Youzl',
		),
		
		/* 数据库设置 */
		'DB_TYPE'               =>  'Mysql',     // 数据库类型
		'DB_HOST'               =>  'localhost', // 服务器地址
		'DB_NAME'               =>  'hbang',          // 数据库名
		'DB_USER'               =>  'hbang',      // 用户名
		'DB_PWD'                =>  'r5T4u6q3',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  '',    // 数据库表前缀
		'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
);