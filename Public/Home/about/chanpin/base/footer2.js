var html='<h1 class="mb-footer"></h1>'+
    '    <div class="footer-content">'+
    '   <ul class="footer2Ul">'+
    '      <li><a href="" class="selected"><div>'+
    '          <img src="img/shangjiaduan/dingdan1.png" />'+
        '<b>1</b>'+
    '         <p>待处理</p></div></a>'+
    '    </li>'+
    '   <li><a href=""><div>'+
    '      <img src="img/shangjiaduan/jishiben1.png" />'+
         '<b>1</b>'+
    '     <p>进行中</p></div></a>'+
    '        </li>'+
    '       <li><a href=""><div>'+
    '          <img src="img/shangjiaduan/dianpu1.png" />'+
         '<b>1</b>'+
    '         <p>商铺</p></div></a>'+
    '    </li>'+
    '   <li><a href=""><div>'+
    '      <img src="img/shangjiaduan/shezhi1.png" />'+
         '<b>1</b>'+
    '     <p>设置</p><div></a>'+
    '</li>'+
    '</ul>'+
    '</div>';

$(function () {
    var footerImg=$(".footer-content .selected img");
    var src=footerImg.attr("src");
    var news_src=src.substring(0,src.length-5)+"2.png";
    footerImg.attr("src",news_src)
});
document.write(html);