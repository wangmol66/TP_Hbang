<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width, minimum-scale=1, maximum-scale=1">
<title></title>
<link rel="stylesheet" href="/hbang/Public/Home/css/swiper.min.css" />
<script type="text/javascript" src="/hbang/Public/Home/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/hbang/Public/Home/js/swiper.min.js"></script>
<link rel="stylesheet" href="/hbang/Public/Home/css/main.css" />
<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/css/base.css" />

<link rel="stylesheet" type="text/css"
	href="/hbang/Public/tongyong/style/tongyong.css">
<style>
.row li .row-wz li h3 {
	height: auto;
	font-size: 0.9em;
}

.row-img img {
	width: auto;
	height: auto;
	max-width: 100%;
	max-height: 100%;
}
</style>

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



<style>
.lib-dw li a .tu.t1 {
	margin-bottom: -0.05em;
}

.lib-dw li a .tu.t2 {
	margin-bottom: -0.16em;
}

.lib-dw li a .tu1.t3 {
	margin-right: 0.2em;
}
</style>




<body>


	<div class="content">
		<form action="">
			<div class="search">
				<input type="text" name="" id="search_text" value=""
					placeholder="输入您想关注的话题进行搜索吧" />
				<div class="icon">
					<a href="javascript:" id="osubmit"><img
						src="/hbang/Public/Home/img/pic3.png" /></a>
				</div>
			</div>
		</form>

		<div class="swiper-container bigs">
			<div class="swiper-wrapper">
				<?php if(is_array($types)): $k = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="swiper-slide swiper-slide-active">
					<ul class="fenlei">
						<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Doctor/index/typeid/'.$voo['type_id']);?>">
								<i class="icone"><img src="<?php echo ($voo["icon"]); ?>" /></i> <span><?php echo ($voo["type_name"]); ?></span>
						</a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					</ul>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>

			<div
				class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets">
				<span
					class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
				<span class="swiper-pagination-bullet"></span> <span
					class="swiper-pagination-bullet"></span>
			</div>

		</div>



		<div class="floor2">
			<h3>最新发布</h3>

		</div>

		<div class="mid-box">
			<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul class="row">
				<li class="pr"
					onclick="location='<?php echo U('Doctor/info/id/'.$vo['id']);?>'">
					<div class="row-img">
						<img src="<?php echo ($vo["show_url"]); ?>" />
					</div>
					<ul class="row-wz">
						<li>
							<h3><?php echo ($vo["title"]); ?></h3>
						</li>
						<li><span><?php echo ($vo["addtime_1"]); ?></span></li>
						<li>
							<p></p>
						</li>
						<li>
							<ul class="lib-dw">
								<li><a href="javascript:"><i class="tu1 t3"></i><span><?php echo ($vo["good"]); ?></span></a>
								</li>
								<li><a href="javascript:"><i class="tu t1"><img
											src="/hbang/Public/Home/img/pic8.png" /></i><span><?php echo ($vo["view"]); ?></span></a></li>
								<li><a href="javascript:"><i class="tu t2"><img
											src="/hbang/Public/Home/img/pic7.png" /></i><span><?php echo ($vo["reply"]); ?></span></a></li>
								<h6></h6>
							</ul>
						</li>
					</ul>
					<h6></h6>
				</li>
			</ul><?php endforeach; endif; else: echo "" ;endif; ?>
			<?php if(!$info){?>
			<section>
				<div id="body-container">
					<div class="warps-textCons">
						<img src="/hbang/Public/tongyong/images/png/11.png" />
						<h1>暂无相关信息</h1>
					</div>
				</div>
			</section>
			<?php }?>
		</div>
	</div>





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
	<script>
			var swiper = new Swiper('.swiper-container', {
				pagination: '.swiper-pagination',
				paginationClickable: true
			});
			
			$(function(){
				$('#osubmit').click(function(){
					var content = $('#search_text').val();
					var typeid  = "<?php echo ($_GET['typeid']); ?>";
					
					$.post("<?php echo U('search');?>",{content:content,typeid:typeid},function(data){
						$(".mid-box").html('');
						//console.log(data);
						data = eval(data);
						var leng = data.length;
						//console.log(leng);
						for(var i = 0;i<leng;i++){
							var html = puthtml(data[i]);
							$(".mid-box").append(html);
						}
					})
				})
				
				
				function puthtml(data){
					var html = '<ul class="row">'
					 	html += '<li class="pr" onclick="location=\'<?php echo U('Doctor/info');?>&id='+data.id+'\'">'
						html += '<div class="row-img">'
						html += '<img src="'+data.show_url+'" />'
						html += '</div>'
						html += '<ul class="row-wz">'
						html += '	<li>'
						html += '		<h3>'+data.title+'</h3>'
						html += '	</li>'
						html += '	<li>'
						html += '		<span>'+data.addtime_1+'</span>'
						html += '	</li>'
						html += '	<li>'
						html += '		<p>'+data.title+'</p>'
						html += '	</li>'
						html += '	<li>'
						html += '		<ul class="lib-dw">'
						html += '			<li>'
						html += '				<a href="javascript:"><i class="tu"><img src="/hbang/Public/Home/img/pic6.png"/></i><span>'+data.good+'</span></a>'
						html += '			</li>'
						html += '			<li>'
						html += '				<a href="javascript:"><i class="tu"><img src="/hbang/Public/Home/img/pic8.png"/></i><span>'+data.view+'</span></a>'
						html += '			</li>'
						html += '			<li>'
						html += '				<a href="javascript:"><i class="tu"><img src="/hbang/Public/Home/img/pic7.png"/></i><span>'+data.reply+'</span></a>'
						html += '			</li>'
						html += '			<h6></h6>'
						html += '		</ul>'
						html += '	</li>'
						html += '</ul>'
						html += '<h6></h6>'
						html += '</li>'
						html += '</ul>'
						
						return html;
				}
			})
		</script>

</body>

</html>