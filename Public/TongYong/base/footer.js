var html='<h1 class="mb-footer"></h1>'+
    '    <div class="footer-content">'+
    '   <ul>'+
    '      <li><a href="" class="selected"><div>'+
    '          <img src="images/png/footer-pic1.png" />'+
    '         <p>首页</p></div></a>'+
    '    </li>'+
    '   <li><a href=""><div>'+
    '      <img src="images/png/footer-pic2.png" />'+
    '     <p>最新揭晓</p></div></a>'+
    '        </li>'+
    '       <li><a href=""><div>'+
    '          <img src="images/png/footer-pic3.png" />'+
    '         <p>发现</p></div></a>'+
    '    </li>'+
    '   <li><a href=""><div>'+
    '      <img src="images/png/footer-pic4.png" />'+
    '     <p>清单</p><div></a>'+
    '</li>'+
    '   <li><a href=""><div>'+
    '      <img src="images/png/footer-pic5.png" />'+
    '     <p>我的</p><div></a>'+
    '</li>'+
    '</ul>'+
   '</div>';

$(function () {
    var footerImg=$(".footer-content .selected img");
    var src=footerImg.attr("src");
    var news_src=src.substring(0,src.length-4)+"_2.png";
    footerImg.attr("src",news_src)
});
document.write(html);