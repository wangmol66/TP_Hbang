<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/css/swiper.min.css" />
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/css/base.css" />
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/css/style.css" />
		<script type="text/javascript" data-main="/hbang/Public/Home/about/js/cont" src="/hbang/Public/Home/about/js/require.js"></script>
		<style>
			.content{
	/* 			height: 41px;
   				 overflow: hidden;
   	 			font-size: 0.5em; */
    	}
		</style>
	</head>
	<body>
		<?php if(is_array($info)): foreach($info as $key=>$vo): ?><div class="remember" onclick="location='<?php echo U('about/info/id/'.$vo['id']);?>'">
				<div class="remember-img fl">
					<img src="<?php echo ($vo["show_url"]); ?>"/>
				</div>
				<div class="remember-list">
					<div class="remember-text">
						<h2><?php echo ($vo["title"]); ?></h2>
						<span><?php echo (date("Y-m-d",$vo["addtime"])); ?></span>
						<div class="remember-text">
							<p><?php echo ($vo["remark"]); ?></p>
						</div>
					</div>
					<h6></h6>
				</div>
			</div><?php endforeach; endif; ?>
	</body>
</html>