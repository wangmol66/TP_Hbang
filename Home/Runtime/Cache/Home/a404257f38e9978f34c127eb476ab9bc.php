<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>__TITLE__</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <meta content="" name="description">
    <link rel="stylesheet" href="/hbang/Public/Home/style/base.css" type="text/css">
    <link rel="stylesheet" href="/hbang/Public/Home/style/style.css" type="text/css">
    <link rel="stylesheet" href="/hbang/Public/Home/style/swiper.min.css">
    <script src="/hbang/Public/Home/js/jquery.min.js"></script>
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
    </style>
</head>
<body style="background-color:#fff;">
<div class="mengban"></div>
<div class="top-top">
    <ul class="paixuUl">
        <li class="first <?php echo ($d); ?>"><a href="javascript:;">类型</a></li>
        <li class="first <?php echo ($a); ?>"><a href="<?php echo ($index); ?>">综合排序</a></li>
        <li class="first <?php echo ($b); ?>"><a href="<?php echo ($page_view); ?>">热度排序</a></li>
        <li class="first <?php echo ($c); ?>"><a href="<?php echo ($create_time); ?>">时间排序</a></li>

        <div class="xlbas">
            <?php if(empty($twoCol)){ echo '<h3><a href="javascript:">暂无类型</a></h3>';} ?>
            <?php if(is_array($twoCol)): foreach($twoCol as $key=>$vo): ?><h3><a href="<?php echo U('Index/lists/id/'.$vo['column_id']);?>"><?php echo ($vo["col_name"]); ?></a></h3><?php endforeach; endif; ?>
        </div>
    </ul>
    <script>
        $(".paixuUl>li").click(function(){
            $(this).addClass("active").siblings().removeClass("active");
        })
        $(".paixuUl>li:nth-child(1)").click(function(){
            if($(".xlbas").is(":hidden")){
                $(".mengban").show();
                $(".xlbas").slideDown(249);
            }else{
                $(".xlbas").slideUp(249);
                setTimeout(function(){
                    $(".mengban").hide();
                },249)
            }
        })
        $(".mengban").click(function(){
            $(".xlbas").slideUp(249);
            setTimeout(function(){
                $(".mengban").hide();
            },249)
        })
        $(".xlbas>h3>a").click(function(){
            $(this).parents(".paixuUl").children("li").first().children("a").text($(this).text())
            $(".xlbas").slideUp(249);
            setTimeout(function(){
                $(".mengban").hide();
            },249)
        })
    </script>
</div>

<section>

    <div class="zhsh-list">
        <?php if(is_array($info)): foreach($info as $key=>$vo): ?><div class="chanpin-list1">
                <a href="<?php echo U('Index/shows/id/'.$vo['article_id']);?>">
                    <div class="chanpin-list-flPhoto fl">
                        <img src="<?php echo ($vo["show_url"]); ?>" alt=""/>
                    </div>
                    <div class="chanpin-list-frcontent fl">
                        <h3><?php echo ($vo["title"]); ?></h3>
                        <h5><?php echo ($vo["content"]); ?></h5>
                        <h6><span><i class="xiaotubiao"><img src="/hbang/Public/Home/img/guanjia/xiaophoto1.png" alt=""/></i><?php echo ($vo["page_view"]); ?></span>
                            <span><i class="xiaotubiao"><img src="/hbang/Public/Home/img/guanjia/xiaophoto2.png" alt=""/></i><?php echo (date("Y-m-d",strtotime($vo["create_time"]))); ?></span>
                            <span><i class="xiaotubiao"><img src="/hbang/Public/Home/img/guanjia/xiaophoto3.png" alt=""/></i><?php echo ($vo["user_name"]); ?></span></h6>
                    </div>
                </a>
            </div><?php endforeach; endif; ?>
    </div>
</section>

</body>
</html>