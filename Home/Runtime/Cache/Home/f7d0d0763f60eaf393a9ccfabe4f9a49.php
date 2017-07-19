<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>华邦直播</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <meta content="" name="description">
    
    <link rel="stylesheet" href="/hbang/Public/Home/about/chanpin/style/style.css" type="text/css">
    <link rel="stylesheet" href="/hbang/Public/Home/about/chanpin/style/swiper.min.css">
    <script src="/hbang/Public/Home/about/chanpin/js/jquery.min.js"></script>
    <style>
        .chanpin-list1 a .chanpin-list-flPhoto{
            height: 7em;
        }
        .chanpin-list1 a .chanpin-list-flPhoto img{
            height: 100%;
        }
        .mengban{
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            background-color: rgba(0, 0, 0, .6);
            z-index: 999;
            display: none;
        }
        .xlbas{
            z-index: 1000;
            clear: both;
            display: none;
        }
        .xlbas>h3>a{
            display: block;
            padding: .85em;
            font-size: 1.15em;
            color: #333;
            border-bottom: 1px solid #e6e6e6;
        }
        .chanpin-list-frcontent fl{
		    font-family: inherit;
		}
    </style>
    
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/css/base.css" />
		<link rel="stylesheet" type="text/css" href="/hbang/Public/Home/about/css/style.css" />
		<script type="text/javascript" data-main="/hbang/Public/Home/about/js/cont" src="/hbang/Public/Home/about/js/require.js"></script>
		<link rel="stylesheet" href="/hbang/Public/Home/about/chanpin/style/base.css" type="text/css">
</head>
<body style="background-color:#fff;">
<div class="mengban"></div>
<div class="top-top">
		<div id="header" class="market">
		  <div class="swiper-wrapper">
		  	<?php if(is_array($type)): foreach($type as $key=>$vo): ?><div class="swiper-slide <?php if($vo['column_id'] == $column_id){echo 'active';}?> "><a href="<?php echo U('About/chanpin/type/'.$vo['column_id']);?>"><?php echo ($vo["col_name"]); ?></a></div><?php endforeach; endif; ?>
		  </div>
		</div>
<!--     <ul class="paixuUl">
    	<?php if(is_array($type)): foreach($type as $key=>$vo): ?><li class="first "><a href="<?php echo U('About/chanpin/type/'.$vo['column_id']);?>"><?php echo ($vo["col_name"]); ?></a></li><?php endforeach; endif; ?>
    </ul> -->
    
    
    <script>
        $(".paixuUl>li").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
        })
    </script>
</div>

<section>

    <div class="zhsh-list">
        <?php if(is_array($info)): foreach($info as $key=>$vo): ?><div class="chanpin-list1">
                <a href="<?php echo U('About/shows/id/'.$vo['article_id']);?>">
                    <div class="chanpin-list-flPhoto fl">
                        <img src="<?php echo ($vo["show_url"]); ?>" alt=""/>
                    </div>
                    <div class="chanpin-list-frcontent fl">
                        <h3 style=""><?php echo ($vo["title"]); ?></h3>
                        <h5><?php echo ($vo["content"]); ?></h5>
                        <h6>
                        <span><i class="xiaotubiao"><img src="/hbang/Public/Home/about/chanpin/img/guanjia/xiaophoto1.png" alt=""/></i><?php echo ($vo["page_view"]); ?></span>
                            <span><i class="xiaotubiao"><img src="/hbang/Public/Home/about/chanpin/img/guanjia/xiaophoto2.png" alt=""/></i><?php echo (date("Y-m-d",strtotime($vo["create_time"]))); ?></span>
                            <span><i class="xiaotubiao"><img src="/hbang/Public/Home/about/chanpin/img/guanjia/xiaophoto3.png" alt=""/></i><?php echo ($vo["user_name"]); ?></span></h6>
                    </div>
                </a>
            </div><?php endforeach; endif; ?>
    </div>
</section>

</body>
</html>