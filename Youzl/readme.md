# Youzl PHP Class

柚子萝类库 用于扩展和封装大多数系统的类库，各个类库中相互协作完成系统
	Thinkphp 使用方式：
	
	/* 注册命名空间 */
	'AUTOLOAD_NAMESPACE' => array(
			'Youzl' =>	'Youzl',
	),

# 版本1.0 
初始化整体包的结构

目录结构
Youzl
	 |--Wechat 		[微信包sdk]  
	 |--PHPqrcode	[生成二维码sdk]()
	 
	 
## 更新日志
	5/23
	添加了 PHPqrcode 生成二维码sdk
	新增了YouzlPHP::vendor('PHPqrcode/phpqrcode'); 静态加载插件方法 扩展第三方包使用