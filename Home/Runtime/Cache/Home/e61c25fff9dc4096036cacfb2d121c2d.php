<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>华邦直播</title>
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
    <meta content="" name="description">
    <link rel="stylesheet" href="/hbang/Public/Home/about/chanpin/style/base.css" type="text/css">
    <link rel="stylesheet" href="/hbang/Public/Home/about/chanpin/style/style.css" type="text/css">
    <link rel="stylesheet" href="/hbang/Public/Home/about/chanpin/style/swiper.min.css">
    <script src="/hbang/Public/Home/about/chanpin/js/jquery.min.js"></script>
    <script src="/hbang/Public/Home/about/chanpin/js/swiper.jquery.min.js"></script>
    <style>
        .swiper-slide{
            padding:0 3em;
        }
        .swiper-slide-next>a{
            font-size: 1.2em;
            color: #333;
        }
        .swiper-slide>a{
            font-size: 1.2em;
            color: #333;
        }
        .xiangqing-bankuaihua strong{font-weight: 700}
        .xiangqingbanner img{
            margin: auto;
            /*max-width: 100%;*/
            /*width: auto;*/
            height: 13em;
        }
        .xiangqing-bankuaihua img{
            margin: auto;
        }
        table{
            border-spacing: inherit;
            border-collapse:collapse;
            border-top: 1px solid #e6e6e6;
            border-left: 1px solid #e6e6e6;
            border-right: 1px solid #e6e6e6;
        }
        table tr{
            border-bottom: 1px solid #e6e6e6;
        }
        table td:not(:last-child){
            border-right: 1px solid #e6e6e6;

        }
    </style>
</head>
<body style="background-color:#fff;">
<section>
<div class="xiangqing-top">
    <h2><?php echo ($article["title"]); ?></h2>
    <h6><span><i class="xiaotubiao"><img src="/hbang/Public/Home/about/chanpin/img/guanjia/xiaophoto1.png" alt=""/></i><?php echo ($article["page_view"]); ?></span>
        <span><i class="xiaotubiao"><img src="/hbang/Public/Home/about/chanpin/img/guanjia/xiaophoto2.png" alt=""/></i><?php echo (date("Y-m-d",strtotime($article["create_time"]))); ?></span>
        <span><i class="xiaotubiao"><img src="/hbang/Public/Home/about/chanpin/img/guanjia/xiaophoto3.png" alt=""/></i><?php echo ($article["user_name"]); ?></span></h6>
</div>
<div class="xiangqingbanner">
    <img src="<?php echo ($article["info_url"]); ?>" alt=""/>
</div>
    <?php if(is_array($page)): foreach($page as $k=>$item): ?><div class="xiangqing-bankuaihua">
            <h3><a name="a<?php echo ($k+1); ?>"></a><span><?php echo ($item["page_name"]); ?></span></h3>
            <h5><?php echo ($item["page_content"]); ?></h5>
        </div><?php endforeach; endif; ?>
</section>
<div class="fudonganniu">
    <a href="javascript:"><img src="/hbang/Public/Home/about/chanpin/img/guanjia/fudong-niu.png" alt=""/></a>
</div>
<div class="tanchuceng" style="opacity:0;">
    <div class="tanchuceng-duanluo2">
        <h2>段落选择</h2>
        <div class="swiper-container swiper-nested2" style="overflow: hidden;height: 16em;">
            <div class="swiper-wrapper"></div>
        </div>
        <b class="guanbianniu">×<s></s></b>
    </div>
</div>
<script>
    setTimeout(function () {
        $(".tanchuceng").css({"opacity":1,"display":"none"});
    },500)
    $(".tanchuceng-duanluo2").css("top",parseInt($(window).height()-$(".tanchuceng-duanluo2").height())/2)
    $(".fudonganniu>a").click(function(){
        $(".tanchuceng").show();
        $(".tanchuceng").click(function(){
            $(".tanchuceng").hide();
        })
    })
</script>
</body>
</html>
<script>
    $(function(){
        var TextArr=[];
        var shu="";
        var Html="";
        var zuobiao="";
        for(var i= 0,j=1;i<$(".xiangqing-bankuaihua>h3>span").length;i++,j++){
            shu=j+1000+"";
            shu=shu.slice(2);
            TextArr.push(shu+" "+$(".xiangqing-bankuaihua>h3>span").eq(i).text());
            zuobiao="#a"+j;
            Html+='<div class="swiper-slide"><a href="'+zuobiao+'">'+TextArr[i]+'</a></div>'
        }
        var swiper = new Swiper('.swiper-container', {
            slidesPerView : 5,
            direction: 'vertical'
        });
        $(".swiper-wrapper").append(Html);
        swiper.onResize();
    })
</script>