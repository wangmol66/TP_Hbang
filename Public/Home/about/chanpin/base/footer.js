var html=' <h1 class="mb-footer"></h1> <div class="footer-content"> <ul> <li> <a href="index.php?s=/Index/index.html" id="Index"> <div> <img src="/Public/home/img/gongyong/pic40_1.png"/> <p>管家</p> </div> </a> </li> <li> <a href="index.php?s=/Shop/index.html"  id="Shop" > <div> <img src="/Public/home/img/gongyong/pic41_1.png"/> <p>商城</p> </div> </a> </li> <li> <a href="index.php?s=/Lesson/index.html"  id="Lesson" > <div> <img src="/Public/home/img/gongyong/pic42_1.png"/> <p>学习</p> </div> </a> </li> <li> <a href="index.php?s=/User/index.html"  id="User" > <div> <img src="/Public/home/img/gongyong/pic43_1.png" alt=""/> <p>我的</p> </div> </a> </li> </ul> </div>';

$(function () {
    $('#'+NowFooer).addClass('selected');
    var footerImg=$(".footer-content .selected img");
    var src=footerImg.attr("src");
    var news_src=src.substring(0,src.length-6)+"_2.png";
    footerImg.attr("src",news_src)
});
document.write(html);