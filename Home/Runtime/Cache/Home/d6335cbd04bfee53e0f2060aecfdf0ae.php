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
		<style type="text/css">
		.market-text p{
			font-family:'Arial';
		}
		</style>
	</head>
	<body>
		<div class="market">
			<div class="market-title">
				<div class="tit-img fl">
					<img src="/hbang/Public/Home/about/img/png/pic7.png"/>
				</div>
				<h2><?php echo ($info["title"]); ?></h2>
				<p><?php echo (date("Y-m-d",$info["addtime"])); ?></p>
				<h6></h6>
			</div>
			<div class="market-text">
				<?php echo ($info["content"]); ?>
			</div>
		</div>
	</body>
</html>