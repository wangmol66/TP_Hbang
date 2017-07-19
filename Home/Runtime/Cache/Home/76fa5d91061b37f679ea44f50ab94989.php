<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
		<title></title>
		<link rel="stylesheet" href="/hbang/Public/Home/css/swiper.min.css" />
		<script type="text/javascript" src="/hbang/Public/Home/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="/hbang/Public/Home/js/swiper.min.js"></script>
		<link rel="stylesheet" href="/hbang/Public/Home/css/main.css" />
		
		<link rel="stylesheet" type="text/css" href="/hbang/Public/tongyong/style/tongyong.css">
		
		<style type="text/css">
		.warps-textCons {
			    text-align: center;
			    padding: 0em 0 1em 0;
			}
			.warps-textCons img {
			    width: 35%;
			}
			.warps-textCons h1 {
			    font-size: 0.9em;
			}
		</style>
	</head>
	<body>
		<div class="swiper-container swiper-container-horizontal">
			<div class="swiper-wrapper">
				<?php if(is_array($shows)): $i = 0; $__LIST__ = $shows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide swiper-slide-active" style="width: 414px;">
						<a href="<?php echo ($vo["url"]); ?>">
						<img src="<?php echo ($vo["show_url"]); ?>" style="height: 183.33px;width: 100%;"/>
						</a>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			<!-- 如果需要分页器 -->
			<div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
			<span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
			<span class="swiper-pagination-bullet"></span>
			<span class="swiper-pagination-bullet"></span>
			</div>

		</div>

		<div class="user-top1">
			<ul>
				<li class="l1">
					<a href="<?php echo U('recent/index');?>"><i><img src="/hbang/Public/Home/img/5.png" width="18" height="18"/></i>
						<p>近期直播</p>
					</a>
				</li>
				<li>
					<a href="<?php echo U('recent/past');?>"><i><img src="/hbang/Public/Home/img/4.png" width="18" height="18"/></i>
						<p>往期回顾</p>
					</a>
				</li>
			</ul>
		</div>
		<div class="floor2-i3">
			<h3>正在直播</h3>
			
		</div>
		
		<?php if(is_array($lists)): $k = 0; $__LIST__ = $lists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k; if(($k) == $total): ?><div class="floor4" onclick="location='http://e.vhall.com/<?php echo ($vo["webinar_id"]); ?>'">
					<div class="imgone">
						<?php if($vo["is_thumb"] == 1): ?><img src="<?php echo ($vo["thumb"]); ?>"  width="100%" style="max-height: 190px;width:337.5px;height:190px;"/>
						<?php else: ?>
							<div
								style="background: #f1f1f1; height: 200px; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">
								<img src="/hbang/Public/Home/img/22.png" style="width: 35%;" />
							</div><?php endif; ?>
						<div class="guanzhu">
							<a href=""><img src="/hbang/Public/Home/img/zhibo.png" width="14" height="14" /></a>
							<span>直播中</span>
						</div>
					</div>
					<div class="exp">
						<p class="bo1"><?php echo ($vo["subject"]); ?></p>
						<p class="bo2"><?php echo ($vo["desc"]); ?></p>
						<p class="bo3">直播时间：<?php echo ($vo["start_time"]); ?></p>
					</div>
				</div>
			<?php else: ?>
				<div class="floor3" onclick="location='http://e.vhall.com/<?php echo ($vo["webinar_id"]); ?>'">
					<div class="imgone">
						<?php if($vo["is_thumb"] == 1): ?><img src="<?php echo ($vo["thumb"]); ?>"  width="100%" style="max-height: 190px;width:337.5px;height:190px;"/>
						<?php else: ?>
							<div
								style="background: #f1f1f1; height: 200px; display: -webkit-box; display: -ms-flexbox; display: -webkit-flex; display: flex; -webkit-box-pack: center; -ms-flex-pack: center; -webkit-justify-content: center; justify-content: center; -webkit-box-align: center; -ms-flex-align: center; -webkit-align-items: center; align-items: center;">
								<img src="/hbang/Public/Home/img/22.png" style="width: 35%;" />
							</div><?php endif; ?>
						<div class="guanzhu">
							<a href=""><img src="/hbang/Public/Home/img/zhibo.png" width="14" height="14" /></a>
							<span>直播中</span>
						</div>
					</div>
					<div class="exp">
						<p class="bo1"><?php echo ($vo["subject"]); ?></p>
						<p class="bo2"><?php echo ($vo["desc"]); ?></p>
						<p class="bo3">直播时间：<?php echo ($vo["start_time"]); ?></p>
					</div>
				</div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
		<?php if(!$lists){?>
			<section>
			    <div id="body-container">
			        <div class="warps-textCons">
			            <img src="/hbang/Public/tongyong/images/png/11.png"/>
			            <h1>暂无相关直播</h1>
			        </div>
			    </div>
			</section>
		
		<?php }?>
		<!-- <div class="floor4">
			<div class="imgone">
				<a href=""><img src="/hbang/Public/Home/img/2.png" width="100%" /></a>
				<div class="guanzhu">
					<a href=""><img src="/hbang/Public/Home/img/zhibo.png" width="14" height="14" /></a>
					<span>直播中</span>
				</div>
				
			</div>
			<div class="exp">
				<p class="bo1">华邦直播首次开播，不容你错过</p>
				<p class="bo2">广播电视词典对直播界定为“广播电视节目的后期(haobc)合成、播出同时进行的播出方式”。按播出场合可分为现场直播和播音室或演播室直播等形式...</p>
				<p class="bo3">直播时间：2017-03-13 15:23:20</p>
			</div>

		</div> -->
		<div class="footer">
			<div class="ftt">
				<a href="<?php echo U('index/index');?>">
					<?php if(CONTROLLER_NAME == 'Index'): ?><i><img src="/hbang/Public/Home/img/foot1.png" width="20" height="20"/></i>
						<p class="ftp1">课程直播</p>
					<?php else: ?>
						<i><img src="/hbang/Public/Home/img/i2-1.png" width="20" height="20"/></i>
						<p>课程直播</p><?php endif; ?>
				</a>
			</div>
			<div class="ftt boot1">
				<a href="<?php echo U('answer/index');?>">
					<?php if(CONTROLLER_NAME == 'Answer'): ?><i><img src="/hbang/Public/Home/img/pic32.png" width="20" height="20"/></i>
						<p class="ftp1">有问"邦"解答</p>
					<?php else: ?>
						<i><img src="/hbang/Public/Home/img/foot2.png" width="20" height="20"/></i>
						<p>有问"邦"解答</p><?php endif; ?>
				</a>
			</div>
			<div class="ftt boot2">
				<a href="<?php echo U('review/index');?>">
					<?php if(CONTROLLER_NAME == 'Review'): ?><i><img src="/hbang/Public/Home/img/pic33.png" width="22" height="20"/></i>
						<p class="ftp1">往期精彩回顾</p>
					<?php else: ?>
						<i><img src="/hbang/Public/Home/img/foot3.png" width="22" height="20"/></i>
						<p>往期精彩回顾</p><?php endif; ?>
				</a>
			</div>
			<div class="ftt boot3">
				<a href="<?php echo U('user/index');?>">
					<?php if(CONTROLLER_NAME == 'User'): ?><i><img src="/hbang/Public/Home/img/i2-4.png" width="20" height="20"/></i>
						<p id="noc">我的</p>
					<?php else: ?>
						<i><img src="/hbang/Public/Home/img/rentou.png" width="20" height="20"/></i>
						<p id="noc">我的</p><?php endif; ?>
				</a>
			</div>
		</div>
		<script>
			var swiper = new Swiper('.swiper-container', {
				pagination: '.swiper-pagination',
				paginationClickable: true
			});
		</script>

	</body>

</html>