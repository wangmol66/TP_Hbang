var headerHtml='<!--[if lte IE 8]>'+
    '<div id="browser">'+
'   <p>我们检测到您还在使用版本较低的IE内核浏览器，为了获得最佳的浏览体验，推荐您使用<button class="close" style="position: absolute;top:15%;right: 22%;" onclick="closeFunc()">×</button></p>'+
'<dl>'+
'<dd><a target="_blank" href="https://www.google.com/intl/zh-CN/chrome/browser/">谷歌浏览器</a></dd>'+
'<dd><a target="_blank" href="http://support.apple.com/kb/DL1531?viewlocale=zh_CN">Safari浏览器</a></dd>'+
'<dd><a target="_blank" href="http://www.firefox.com.cn/">火狐浏览器</a></dd>'+
'<dd><a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/download-ie">IE浏览器（IE9以上）</a>等浏览器</dd>'+
'</dl>'+
'</div>'+
'<![endif]-->'+
'<div class="page-header navbar navbar-fixed-top">'+
'<div class="page-header-inner">'+
'<!-- logo -->'+
'<div class="page-logo">'+
'<a href=""><img src="../images/png/logo.png" class="logo-default"></a>'+
'</div>'+
'<!-- logo end -->'+
'<!-- 响应式切换按钮 -->'+
'<a href="javascript:;" class="menu-toggler responsive-toggler pull-left" data-toggle="collapse" data-target=".navbar-collapse"></a>'+
'<!-- 响应式切换按钮 end -->'+
'<!-- 顶部右侧菜单 -->'+
'<div class="top-menu">'+
'<ul class="nav navbar-nav pull-right">'+
'<li class="dropdown dropdown-user hidden-sm hidden-xs">'+
'<a href=""><i class="icon-user"></i><span>臭小子</span></a>'+
'</li>'+
'<li class="dropdown dropdown-user hidden-sm hidden-xs">'+
'<a href=""><i class="icon-signout"></i></a>'+
'</li>'+
'</ul>'+
'</div>'+
'<!-- 顶部右侧菜单 end -->'+
'</div>'+
'</div>';
document.write(headerHtml);
function closeFunc(){
    document.getElementById("browser").style.display = "none";
}