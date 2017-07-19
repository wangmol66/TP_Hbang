<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
		<title></title>
		<link rel="stylesheet" href="/hbang/Public/Home/css/base.css" />
		
		
		<style type="text/css">
			*{padding: 0; margin: 0;}
.clear{clear: both;}
body{background: #FFFFFF;}
	html,body{position: relative; max-width: 720px;margin: 0 auto;}
			.user-box{background:url(/hbang/Public/Home/img/b1.png) no-repeat top; background-size: 100%;}
			.user-box .img-box{width: 5rem;height: 5rem;background: url(/hbang/Public/Home/img/pic1.png) no-repeat bottom left;margin: 0 auto; background-size: 100%; padding-top: 3rem;
			 display: -webkit-box;
			  display: -ms-flexbox;
			  display: -webkit-flex;
			  display: flex;
			  -webkit-box-pack: center;
			  -ms-flex-pack: center;
			  -webkit-justify-content: center;
			  justify-content: center;
			  -webkit-box-align: center;
			  -ms-flex-align: center;
			  -webkit-align-items: center;
			  align-items: center;
			  
			}

@media only screen and (min-width: 400px){
	.user-box{height: 14rem;}
	.menu-list li{height: 3.5rem;}
	.user-box .touxiang-box{width: 4rem;height: 4rem;border-radius: 100%; overflow: hidden;margin: 0 auto;display: block;}
			.touxiang-box img{height: 100%;}
			.user-box p{text-align: center;font-size: 1em;margin-top: 0.5em;color: #fff;}
			.menu-list li{ border-bottom: 1px solid #e6e6e6;margin-top: 10px;}
			.menu-list li{position: relative;}
			.menu-list li a{text-decoration: none; color: #676767;	}
			.menu-list li a i{display: block;width:28px;height:28px;position: absolute; left: 20px; top: 14px;}
			.menu-list li a p{padding-left: 3.5em;font-size:0.9em;    line-height: 3.6em; }
			.menu-list li a p img{position: absolute;right: 10px;top: 50%;margin-top: -0.9em;width: 0.7em;}
			
			.footer{height: 4em;width: 100%; border-top: 1px solid #e6e6e6; position: fixed; bottom: 0px;}
			.ftt{width: 26%; height: 7em; float: left;}
			.ftt a{display: block; color: #9f9f9f; text-decoration: none;font-size: 12px; height: 7em;}
			.ftt a i{display: block; margin: 5px auto;margin-top: 10px; width: 20px; height: 20px;}
			.ftt a p{margin: 0 auto;text-align:center; height: 2em; line-height: 2em;font-size: 12px;}
			.boot1{width: 27%;}
			.boot2{width: 27%;}
			.boot3{width: 17%;}
			.boot3 p{color:#00bb9d;}
}
@media only screen and (min-width: 360px) and (max-width: 399px) {
	.user-box{height: 12rem;}
	.menu-list li{height: 3.5rem;}
	.user-box .touxiang-box{width: 4rem;height: 4rem;border-radius: 100%; overflow: hidden;margin: 0 auto;display: block;}
			.touxiang-box img{height: 100%;}
			.user-box p{text-align: center;font-size: 1em;margin-top: 0.5em;color: #fff;}
			.menu-list li{ border-bottom: 1px solid #e6e6e6;margin-top: 10px;}
			.menu-list li{position: relative;}
			.menu-list li a{text-decoration: none; color: #676767;	}
			.menu-list li a i{display: block;width:28px;height:28px;position: absolute; left: 20px; top: 14px;}
			.menu-list li a p{padding-left: 3.5em;font-size:0.9em;    line-height: 3.6em; }
			.menu-list li a p img{position: absolute;right: 10px;top: 50%;margin-top: -0.9em;width: 0.7em;}
			
			.footer{height: 4em;width: 100%; border-top: 1px solid #e6e6e6; position: fixed; bottom: 0px;}
			.ftt{width: 26%; height: 7em; float: left;}
			.ftt a{display: block; color: #9f9f9f; text-decoration: none; height: 7em;}
			.ftt a i{display: block; margin: 5px auto;margin-top: 10px; width: 20px; height: 20px;}
			.ftt a p{margin: 0 auto;text-align:center; height: 2em; line-height: 2em;font-size: 12px;}
			.boot1{width: 27%;}
			.boot2{width: 27%;}
			.boot3{width: 17%;}
			.boot3 p{color:#00bb9d;}
}
@media only screen and (min-width: 320px) and (max-width: 359px) {
	.user-box{height: 11rem;}
	.menu-list li{height: 2.5rem;}
	.user-box .touxiang-box{width: 4rem;height: 4rem;border-radius: 100%; overflow: hidden;margin: 0 auto;display: block;}
			.touxiang-box img{height: 100%;}
			.user-box p{text-align: center;font-size: 1em;margin-top: 0.5em;color: #fff;}
			.menu-list li{ border-bottom: 1px solid #e6e6e6;margin-top: 10px;}
			.menu-list li{position: relative;}
			.menu-list li a{text-decoration: none; color: #676767;	}
			.menu-list li a i{display: block;width:28px;height:28px;position: absolute; left: 20px; top: 10px;}
			.menu-list li a p{padding-left: 3.5em;font-size:0.9em;    line-height: 2.5em; }
			.menu-list li a p img{position: absolute;right: 10px;top: 50%;margin-top: -0.9em;width: 0.7em;}
			
			.footer{height: 4em;width: 100%; border-top: 1px solid #e6e6e6; position: fixed; bottom: 0px;}
			.ftt{width: 26%; height: 7em; float: left;}
			.ftt a{display: block; color: #9f9f9f; text-decoration: none;font-size: 12px; height: 7em;}
			.ftt a i{display: block; margin: 5px auto;margin-top: 10px; width: 20px; height: 20px;}
			.ftt a p{margin: 0 auto;text-align:center; height: 2em; line-height: 2em;font-size: 12px;}
			.boot1{width: 27%;}
			.boot2{width: 27%;}
			.boot3{width: 17%;}
			.boot3 p{color:#00bb9d;}
}
			
		</style>
	</head>
	<body>
		<div class="user-box">
			
			<div class="img-box">
				<a href="" class="touxiang-box"><img src="<?php echo ($_SESSION['user']['headimgurl']); ?>" alt="" /></a>
			</div>
			<p><?php echo ($_SESSION['user']['nickname']); ?></p>
		</div>
		<ul class="menu-list">
			<li>
				<a href="<?php echo U('FollowMe/index');?>">
					<i><img src="/hbang/Public/Home/img/1-i.png" width="20" height="20"/></i><p>我的关注<img src="/hbang/Public/Home/img/jiantou.png"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo U('Views/index');?>">
					<i><img src="/hbang/Public/Home/img/2-i.png" width="20" height="20"/></i><p>浏览记录<img src="/hbang/Public/Home/img/jiantou.png"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo U('Talk/index');?>">
					<i><img src="/hbang/Public/Home/img/3-i.png" width="20" height="20"/></i><p>我的提问<img src="/hbang/Public/Home/img/jiantou.png"></p>
				</a>
			</li>
			<li>
				<a href="<?php echo U('Notice/index');?>">
					<i><img src="/hbang/Public/Home/img/4-i.png" width="20" height="20"/></i><p>消息通知<img src="/hbang/Public/Home/img/jiantou.png"></p>
				</a>
			</li>
		</ul>
		
		<?php if($_GET['type'] == ' '): ?><div class="footer">
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
		<?php elseif($_GET['type'] == 'doctor'): ?>
			<style>
.ftt {
    width: 50%;
    height: 7em;
    float: left;
}
#noc{
	color: #00bb9d;
}
</style>
<div class="footer">
			<div class="ftt wid50">
				<a href="<?php echo U('Doctor/index');?>">
				<?php if(CONTROLLER_NAME == 'Doctor'): ?><i><img src="/hbang/Public/Home/img/foot1.png" width="20" height="20"/></i>
					<p class="ftp1">邦邦好医声</p>
				<?php else: ?>
					<i><img src="/hbang/Public/Home/img/pic31.png" width="20" height="20"/></i>
					<p>邦邦好医声</p><?php endif; ?>
				</a>
			</div>
			
	
			<div class="ftt wid50">
				<a href="<?php echo U('user/index/type/doctor');?>">
					<?php if(CONTROLLER_NAME == 'User'): ?><i><img src="/hbang/Public/Home/img/i2-4.png" width="20" height="20"/></i>
						<p id="noc">我的</p>
					<?php else: ?>
						<i><img src="/hbang/Public/Home/img/rentou.png" width="20" height="20"/></i>
						<p>我的</p><?php endif; ?>
				</a>
			</div>
</div>
		<?php elseif($_GET['type'] == 'news'): ?>
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
		<?php else: ?>
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
		</div><?php endif; ?>
	</body>
</html>