<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
		<title></title>
		<link rel="stylesheet" href="/hbang/Public/Home/css/swiper.min.css" />
		<script type="text/javascript" src="/hbang/Public/Home/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="/hbang/Public/Home/js/swiper.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/css/base.css"/>
		<link rel="stylesheet" href="/hbang/Public/Home/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/css/animate.css"/>
		
		<link rel="stylesheet" type="text/css" href="/hbang/Public/tongyong/style/tongyong.css">
	</head>

	<body>

<div class="content">
		<?php if($list){?>
			<div class="huiyi">
				<div class="huiyi-top">
					<p>您一共发起了<?php echo count($list)?>场会议</p>
				</div>
			</div>
		<?php }?>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="huiyi-box" onclick="location='<?php echo U('Helper/info/id/'.$vo['id']);?>'">
				<div class="huiyi-box-l1">
					<div class="huiyi-box-flol">
						<i class="tu"><img src="/hbang/Public/Home/img/pic15.png"/></i>
						<div class="huiyi-box-wz">
							<h3><?php echo ($vo["title"]); ?></h3>
							<p><?php echo (date("Y-m-d H:i:s",$vo["addtime"])); ?></p>
						</div>
					</div>
					<div class="huiyi-box-flor">
						<span><?php echo ($vo['status'] == 1?'开会中':'已结束'); ?></span>
					</div>
					<h6></h6>
				</div>
				<div class="huiyi-box-l2">
					<p><?php echo ($vo["content"]); ?></p>
				</div>
				<div class="zhongjiang">
					<span><?php echo ($vo["winners"]); ?>人中奖</span>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>
				
		<?php if(!$list){?>
			<section>
			    <div id="body-container">
			        <div class="warps-textCons">
			            <img src="/hbang/Public/tongyong/images/png/11.png"/>
			            <h1>暂无相关信息</h1>
			        </div>
			    </div>
			</section>
		
		<?php }?>
				<div class="feiji">
					<a href="<?php echo U('Helper/add');?>"><img src="/hbang/Public/Home/img/pic14.png" /></a>
				</div>
</div>
		


		<style>
.footer .ftt.wid33 {
    width: 33.3%;
}
#noc{
	color: #00bb9d;
}
</style>

<div class="footer">
		<div class="ftt wid33">
			<a href="<?php echo U('News/index');?>">
				<?php if(CONTROLLER_NAME == 'News'): ?><i><img src="/hbang/Public/Home/img/foot1.png" width="20" height="20"/></i>
				<p class="ftp1">"邦"您看会讯</p>
				<?php else: ?>
				<i><img src="/hbang/Public/Home/img/i2-1.png" width="20" height="20"/></i>
				<p>"邦"您看会讯</p><?php endif; ?>
			</a>
		</div>
		
		<div class="ftt wid33">
			<a href="<?php echo U('Helper/index');?>">
				<?php if(CONTROLLER_NAME == 'Helper'): ?><i><img src="/hbang/Public/Home/img/pic35.png" width="20" height="20"/></i>
					<p class="ftp1">会议助手</p>
				<?php else: ?>
					<i><img src="/hbang/Public/Home/img/pic34.png" width="20" height="20"/></i>
					<p>会议助手</p><?php endif; ?>
			</a>
		</div>

		<div class="ftt wid33">
			<a href="<?php echo U('User/index/type/news');?>">
				<?php if(CONTROLLER_NAME == 'User'): ?><i><img src="/hbang/Public/Home/img/i2-4.png" width="20" height="20"/></i>
					<p id="noc">我的</p>
				<?php else: ?>
					<i><img src="/hbang/Public/Home/img/rentou.png" width="20" height="20"/></i>
					<p>我的</p><?php endif; ?>
			</a>
		</div>
</div>	
		<script>
			var swiper = new Swiper('.contorl-wz', {
				slidesPerView: 3,
				paginationClickable: true,
				 spaceBetween: 10
			});
			$(function(){
				$(".dianzan").click(function(){
					if($(this).hasClass("pulse")){
						$(this).removeClass("pulse");
					}else{
						$(this).addClass("animated pulse");
					}
				})
			})
		</script>

	</body>

</html>