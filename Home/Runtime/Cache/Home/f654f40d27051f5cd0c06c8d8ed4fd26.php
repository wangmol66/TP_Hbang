<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
		<title></title>
		<link rel="stylesheet" href="/hbang/Public/Home/css/swiper.min.css" />
		<!-- <script type="text/javascript" src="/hbang/Public/Home/js/jquery-1.9.1.min.js"></script> -->
		<script type="text/javascript" src="/hbang/Public/Home/js/swiper.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/css/base.css" />
		<link rel="stylesheet" href="/hbang/Public/Home/css/main.css" />
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/css/animate.css" />
		
		<script src="/hbang/Public/Home/weui/dist/example/zepto.min.js"></script>
    	<script src="/hbang/Public/Home/weui/jweixin-1.0.0.js"></script>
    	<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/weui/dist/style/weui.css" />
    	
    	<!-- 下拉刷新  -->
    	<script src="/hbang/Public/Slike/dropload/dist/dropload.min.js"></script> <!--js-->
    	<link rel="stylesheet" type="text/css" href="/hbang/Public/Slike/dropload/dist/dropload.css" />
	</head>
		<style>
			.lib{position:relative;}
			.lib .lib-xian{position:absolute;left:50%;top:0;width:1px;background:#E6E6E6;height:100%;}
			
			.lib-dw li a .tu.t1{
				margin-bottom:-0.05em;
			}
			.lib-dw li a .tu.t2{
				margin-bottom:-0.1em;
			}
			.lib-box a .tu img {
			    max-width: 100%;
			    height: auto;
			}
			.lib-box .wz5 {
			    height: 3.5em;
			}
		</style>
		
		  <link rel="stylesheet" type="text/css" href="/hbang/Public/Slike/dropload/dist/dropload.css" />



		<link rel="stylesheet" type="text/css"
			href="/hbang/Public/tongyong/style/tongyong.css">
		<style type="text/css">
		.warps-textCons {
			text-align: center;
			padding: 0em 0 1em 0;
		}
		
		.warps-textCons img {
		margin-top: 2em;
			width: 35%;
		}
		
		.warps-textCons h1 {
			font-size: 0.9em;
		}
		.dropload-noData {
		    color: #555;
		}
		.content {
		    margin-bottom: 0.2rem;
		}
		</style>
	<body>
		<!-- <div class="swiper-container">
			<div class="swiper-wrapper">
				<?php if(is_array($lunbo)): $i = 0; $__LIST__ = $lunbo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide swiper-slide-active">
						<a href=""><img src="<?php echo ($vo["show_url"]); ?>" width="100%" /></a>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
			如果需要分页器
			<div class="swiper-pagination ">
			</div>

		</div> -->


	<div class="content">
		<div class="search">
			<input type="text" name="search" value="" placeholder="输入您想关注的话题进行搜索吧" />
			<div class="icon">
				<a href="javascript:" id="search"><img src="/hbang/Public/Home/img/pic3.png" /></a>
			</div>
		</div>

		<div class="swiper-container bigs">
			<div class="swiper-wrapper">
				<?php if(is_array($types)): $k = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="swiper-slide swiper-slide-active">
					<ul class="fenlei">
						<?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Review/index/typeid/'.$voo['type_id']);?>">
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
		
	</div>
		<div class="main-list">
			
		</div>
		<div class="element">
		</div>

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
		
		<script>
			
			$(function(){
				var TAG = "<?php echo ($_GET['i']); ?>";//标签
				var SEARCH = '';//搜索字符
				var PAGE = 0;//页数
				var SIZE = 4;//每页展示4个
				var TYPEID = "<?php echo ($_GET['typeid']); ?>";
				var ME;//下拉加载的对象
				
				$('#search').click(function(){
					SEARCH = $('input[name="search"]').val();
					PAGE = 1;
					ME.unlock();//解锁
					ME.noData(false);//设置有数据可以拉
					
	                $.post("<?php echo U('Review/search');?>",{page:PAGE,size:SIZE,search:SEARCH,i:TAG,typeid:TYPEID},function (data) {
                       	if(data.status){
                    	 	$('.main-list').html('');
                    	 	PAGE = 1;
                    	 	var arrlen = data.info.length;
                    	 	var html = '';
                    	 	for(var i = 0;i<arrlen;i++){
                    	 		
		            			html+= loadList(data.info[i],i);
		            			if((i+1)==arrlen && arrlen%2!=0){
		    						html +='<h6></h6>'
		    							html +='</div>'
		    							html +='</div>'
		            			}
                    	 	}
                    	 	//加载到指定位置
							$('.main-list').append(html);
             			   
                       	}else{
                       	//提示
              			    layer.open({
              			       content: '网络错误'
              			       ,skin: 'msg'
              			       ,time: 2 //2秒后自动关闭
              			    });
                       	}
                     	//加载完数据，重置
                       	ME.resetload();
                   })
	                   
				})
				
				/*点赞*/
				$(".dianzan").live('click',function(){
					if($(this).hasClass("pulse")){
						$(this).removeClass("pulse");
					}else{
						$(this).addClass("animated pulse");
					}
					var id = $(this).attr('data-id');
					var _this = this;
					$.post("<?php echo U('Answer/dianzan');?>",{id:id},function(data){
						if(data.status){
							var num = parseInt($(_this).children('.zan').text())+1;
							$(_this).children('.zan').text(num);
						}
					})
				})
				
				var isnull = false;
				/*下拉加载*/
				$('.element').dropload({
				    scrollArea : window,
				    loadDownFn : function(me){
				    	ME = me
				    	PAGE++;
				        $.ajax({
				            type: 'POST',
				            url: "<?php echo U('Review/loadMore');?>",
				            data:{page:PAGE,size:SIZE,i:TAG,search:SEARCH,typeid:TYPEID},
				            dataType: 'json',
				            success: function(data){
				            	var arrlen = data.length;
				            	if(arrlen>0){
				            		isnull = true;
				            		var html = '';
				            		for(var i=0; i<arrlen; i++){
				            			
				            			html+= loadList(data[i],i);
				            			if((i+1)==arrlen && arrlen%2!=0){
				    						html +='<h6></h6>'
				    							html +='</div>'
				    							html +='</div>'
				            			}
			                        }
									//加载到指定位置
									$('.main-list').append(html);
				            	}else{
				            		if(!isnull){
					            		$('.main-list').append(nullhtml());
				            		}
			                        // 锁定
			                        me.lock();
			                        // 无数据
			                        me.noData();
			                    }
				                
				                //每次数据加载完，必须重置
				                me.resetload();
				            },
				            error: function(xhr, type){
				                //alert('Ajax error!');
				                // 即使加载出错，也得重置
				                me.noData();
				                me.resetload();
				            }
				        });
				    }
				});
			})
			
			/*列表HTML*/
			function loadList(info,i){
				var html = '';
					if((i%2==0)){
						html ='<div class="mid-box">'
						html +='<div class="lib">'
						html +='<div class="lib-box">'
						html +='<a href="<?php echo U('review/info');?>&id='+info['id']+'"><i class="tu"><img src="'+info.show_url+'"/></i></a>'
						html +='<p class="wz5">'+info.title+'</p>'
						html +='<ul class="lib-dw">'
						html +='<li>'
						html +='<a href="javascript:"><i class="tu"><img src="/hbang/Public/Home/img/pic6.png"/></i><span>'+info.good+'</span></a>'
						html +='</li>'
						html +='<li>'
						html +='<a href="javascript:"><i class="tu t1"><img src="/hbang/Public/Home/img/pic8.png"/></i><span>'+info.view+'</span></a>'
						html +='</li>'
						html +='<li>'
						html +='<a href="javascript:"><i class="tu t2"><img src="/hbang/Public/Home/img/pic7.png"/></i><span>'+info.reply+'</span></a>'
						html +='</li>'
						html +='<h6></h6>'
						html +='</ul>'
						html +='</div>'
						html +='<div class="lib-xian">'
						html +='</div>'
					}else{
						html +='<div class="lib-box flor">'
						html +='<a href="<?php echo U('review/info');?>&id='+info['id']+'"><i class="tu"><img src="'+info.show_url+'"/></i></a>'
						html +='<p class="wz5">'+info.title+'</p>'
						html +='<ul class="lib-dw">'
						html +='<li>'
						html +='<a href="javascript:"><i class="tu"><img src="/hbang/Public/Home/img/pic6.png"/></i><span>'+info.good+'</span></a>'
						html +='</li>'
						html +='<li>'
						html +='<a href="javascript:"><i class="tu t1"><img src="/hbang/Public/Home/img/pic8.png"/></i><span>'+info.view+'</span></a>'
						html +='</li>'
						html +='<li>'
						html +='<a href="javascript:"><i class="tu t2"><img src="/hbang/Public/Home/img/pic7.png"/></i><span>'+info.reply+'</span></a>'
						html +='</li>'
						html +='<h6></h6>'
						html +='</ul>'
						html +='</div>'
						html +='<h6></h6>'
						html +='</div>'
						html +='</div>'
					}
				
					return html;
				}

			function nullhtml(){
				var html = '<section>'
					html += '<div id="body-container">'
					html += '<div class="warps-textCons">'
					html += '<img src="/hbang/Public/tongyong/images/png/11.png" />'
					html += '</div>'
					html += '</div>'
					html += '</section>'
					
					return html;
			}
		</script>

	</body>

</html>