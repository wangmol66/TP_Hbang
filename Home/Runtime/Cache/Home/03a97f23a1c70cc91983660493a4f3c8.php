<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/css/swiper.min.css" />
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/css/base.css" />
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/css/style.css" />
		<script type="text/javascript" data-main="/hbang/Public/Home/about/js/cont" src="/hbang/Public/Home/about/js/require.js"></script>
	</head>
	<body>
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php if(is_array($show)): foreach($show as $k=>$vo): ?><div class="swiper-slide <?php if($k == 1): ?>swiper-slide-active<?php endif; ?>">
						<a href=""><img src="<?php echo ($vo["show_path"]); ?>" width="100%" height="100%" /></a>
					</div><?php endforeach; endif; ?>
			</div>
			<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
		</div>
		<div class="classify-box">
			<ul class="classify">
				<li>
					<a href="<?php echo U('jieshao');?>">
						<i class="icon"><img src="/hbang/Public/Home/about/img/png/pic1.png"/></i>
						<h2>企业管理</h2>	
					</a>
				</li>
				<li>
					<a href="<?php echo U('lainxi');?>">
						<i class="icon"><img src="/hbang/Public/Home/about/img/png/pic2.png"/></i>
						<h2>联系我们</h2>
					</a>
				</li>
				<li>
					<a href="<?php echo U('chanpin');?>">
						<i class="icon"><img src="/hbang/Public/Home/about/img/png/pic3.png"/></i>
						<h2>华邦产品</h2>
					</a>
				</li>
				<li>
					<a href="<?php echo U('dajishi');?>">
						<i class="icon"><img src="/hbang/Public/Home/about/img/png/pic4.png"/></i>
						<h2>企业大事记</h2>
					</a>
				</li>
				<li>
					<a href="<?php echo U('yanfa');?>">
						<i class="icon"><img src="/hbang/Public/Home/about/img/png/pic5.png"/></i>
						<h2>关于研发</h2>
					</a>
				</li>
				<li>
					<a href="<?php echo U('xinxi');?>">
						<i class="icon"><img src="/hbang/Public/Home/about/img/png/pic6.png"/></i>
						<h2>集团信息</h2>
					</a>
				</li>
				<h6></h6>
			</ul>
		</div>
		<div class="copyright">
			<p>华邦生命健康股份有限公司</p>
			<p>版权所有 渝ICP备05003852号</p>
		</div>
	</body>
</html>