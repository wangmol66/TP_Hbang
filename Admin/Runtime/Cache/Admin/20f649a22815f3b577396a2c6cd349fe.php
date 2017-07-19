<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo ($meta_title); ?>|<?php echo C('WEB_SITE_TITLE');?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<link href="/hbang/Public/static/metronic/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="/hbang/Public/static/metronic/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/hbang/Public/static/metronic/css/style-metronic.css" rel="stylesheet" type="text/css"/>
<link href="/hbang/Public/static/metronic/css/style.css" rel="stylesheet" type="text/css"/>
<link href="/hbang/Public/static/metronic/css/style-responsive.css" rel="stylesheet" type="text/css"/>
<link href="/hbang/Public/static/metronic/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/hbang/Public/static/metronic/css/themes/custom.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="/hbang/Public/static/metronic/css/pages/timeline.css" rel="stylesheet" type="text/css"/>
<link href="/hbang/Public/static/metronic/css/pages/profile.css" rel="stylesheet" type="text/css"/>
<link href="/hbang/Public/static/datetimepicker/css/datetimepicker.css" rel="stylesheet" type="text/css"/>
<!--<link href="/hbang/Public/static/treeview/css/default.css" rel="stylesheet" type="text/css"/>-->
<link rel="stylesheet" type="text/css" href="/hbang/Public/static/metronic/plugins/bootstrap-datepicker/css/datepicker.css"/>
<!--[if lt IE 9]>
<script src="/hbang/Public/static/metronic/plugins/respond.min.js"></script>
<script src="/hbang/Public/static/metronic/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="/hbang/Public/static/metronic/plugins/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="/hbang/Public/static/metronic/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="/hbang/Public/static/metronic/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/hbang/Public/static/metronic/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/hbang/Public/static/metronic/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/hbang/Public/static/metronic/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="/hbang/Public/static/metronic/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/hbang/Public/static/metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/hbang/Public/static/metronic/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="/hbang/Public/static/treeview/js/bootstrap-treeview.js"></script>
<?php if( ! empty($__plugins)) echo loadStaticPlugin($__plugins);?>
<script src="/hbang/Public/static/metronic/scripts/core/app.js"></script>
<script src="/hbang/Public/Slike/Smelly.js"></script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">

	<div class="header navbar navbar-fixed-top">
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="header-inner">
		<!-- BEGIN LOGO -->
		<a class="navbar-brand" href="javascript:void(0);">
			<img src="/hbang/Public/Admin/images/png/pclogo.png" class="logo-default" width="191" height="40" style="margin-left: -1em">
		</a>
		<!-- END LOGO -->
		<!-- BEGIN RESPONSIVE MENU TOGGLER -->
		<a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<img src="/hbang/Public/static/metronic/img/menu-toggler.png" alt=""/>
		</a>
		<!-- END RESPONSIVE MENU TOGGLER -->
		<ul class="nav navbar-nav pull-right">
			<li class="dropdown user">
				<a href="#"  class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
					<span class="username">
						<?php echo session('user_auth.username');?>
					</span>
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo U('Public/logout');?>">
							<i class="fa fa-key"></i> 退出
						</a>
					</li>
				</ul>
			</li>
			<!-- END USER LOGIN DROPDOWN -->
		</ul>
		<!-- END TOP NAVIGATION MENU -->
	</div>
	<!-- END TOP NAVIGATION BAR -->
</div>
<div class="clearfix">
</div>
<style type="text/css">
	div .radio-inline:nth-child(2), div .checkbox-inline:nth-child(2) {
	    margin-left: 10px;
	}
</style>
<div class="page-container"> 
  <!-- BEGIN SIDEBAR --> 
  <div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
			<?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; $active = false; if($menu['url'] == $__sidebar) $active = true; if( ! $active && ! empty($menu['child'])){ foreach($menu['child'] as $v){ if($v['url'] == $__sidebar){ $active = true; break; } } } ?>
				<li <?php if($active):?>class="active"<?php endif ?>>
				<a href="<?php echo (U($menu["url"])); ?>">
					<i class="<?php echo ($menu["menu_class"]); ?>"></i>
					<span class="title">
						<?php echo ($menu["title"]); ?>
					</span>
					<?php if( ! empty($menu['child'])):?>
					<span class="arrow <?php if($active):?>open<?php endif; ?>">
					</span>
					<?php endif;?>
				</a>
				<?php if( ! empty($menu['child'])):?>
				<ul class="sub-menu">
				   <?php if(is_array($menu["child"])): $i = 0; $__LIST__ = $menu["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menus): $mod = ($i % 2 );++$i; if($menus['url'] == $__sidebar) $active = true; else $active = false; ?>
						<li <?php if($active):?>class="active"<?php endif ?>>
							<a href="<?php echo (U($menus["url"])); ?>">
								<?php echo ($menus["title"]); ?>
							</a>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ul>
				<?php endif;?>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</div>
 
  <!-- END SIDEBAR --> 
  <!-- BEGIN CONTENT -->
  <div class="page-content-wrapper">
    <div class="page-content"> 
      <!-- BEGIN PAGE HEADER-->
      <div class="row">
        <div class="col-md-12"> 
          <!-- BEGIN PAGE TITLE & BREADCRUMB-->
          <h3 class="page-title"> 菜单管理 </h3>
          <ul class="page-breadcrumb breadcrumb">
          	<li class="btn-group"> <a href="<?php echo U('Menu/index?pid='.I('pid'));?>" class="btn default"><i class="fa fa-chevron-left"></i> 返回</a> </li>
            <li> <a href="javascript:void(0);"> 系统 </a> <i class="fa fa-angle-right"></i> </li>
            <li> <a href="<?php echo U('Menu/index?pid='.I('pid'));?>"> 菜单管理 </a> <i class="fa fa-angle-right"></i></li>
            <li> <?php if(isset($edit)): ?>编辑<?php else: ?>新增<?php endif; ?></li>
          </ul>
          <!-- END PAGE TITLE & BREADCRUMB--> 
        </div>
      </div>
      <div class="row">
				<div class="col-md-12">
					<!-- BEGIN VALIDATION STATES-->
					<div class="portlet box">
						<div class="portlet-body form">
							<!-- BEGIN FORM-->
							<form action="" class="form-horizontal" method="post">
								<div class="form-body">
									<div class="form-group">
										<label class="control-label col-md-3">标题 <span class="required"> *</span></label>
										<div class="col-md-6">
											<input type="text" placeholder="用于后台显示的配置标题" name="title" value="<?php echo ((isset($info["title"]) && ($info["title"] !== ""))?($info["title"]):''); ?>" class="form-control required">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">排序 </label>
										<div class="col-md-6">
											<input type="text" placeholder="用于分组显示的顺序" name="sort" value="<?php echo ((isset($info["sort"]) && ($info["sort"] !== ""))?($info["sort"]):0); ?>" class="form-control required">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">链接 <span class="required"> *</span></label>
										<div class="col-md-6">
											<input type="text" placeholder="U函数解析的URL或者外链" name="url" value="<?php echo ((isset($info["url"]) && ($info["url"] !== ""))?($info["url"]):''); ?>" class="form-control required">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">上级菜单</label>
										<div class="col-md-6">
												 <select name="pid" class="form-control">
			                                        <?php if(is_array($Menus)): $i = 0; $__LIST__ = $Menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><option <?php if( info && $menu['id'] == $info['pid']) echo 'selected="true"'; ?> value="<?php echo ($menu["id"]); ?>"><?php echo ($menu["title_show"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			                                    </select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">分组 </label>
										<div class="col-md-6">
											 <input type="text" class="form-control" placeholder="用于左侧分组二级菜单" name="group" value="<?php echo ((isset($info["group"]) && ($info["group"] !== ""))?($info["group"]):''); ?>">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">是否隐藏 </label>
										<div class="col-md-6">
											<div class="radio-list">
												<label class="radio-inline"><input <?php if( ! empty($info['hide'])):?>checked<?php endif;?> type="radio" name="hide" value="1"  >是</label>
												<label class="radio-inline"><input <?php if(empty($info['hide'])):?>checked<?php endif;?> type="radio" name="hide" value="0">否</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">仅开发者模式可见</label>
										<div class="col-md-6">
											<div class="radio-list">
												<label class="radio-inline"><input <?php if( ! empty($info['is_dev'])):?>checked<?php endif;?> type="radio" name="is_dev" value="1">是</label>
												<label class="radio-inline"><input <?php if( empty($info['is_dev'])):?>checked<?php endif;?> type="radio" name="is_dev" value="0">否</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">说明 </label>
										<div class="col-md-6">
											<input type="text" class="form-control" id="tip" placeholder="输入行为规则，不写则只记录日志" name="tip" value="<?php echo ((isset($info["tip"]) && ($info["tip"] !== ""))?($info["tip"]):''); ?>">
										</div>
									</div>
								</div>
								<div class="form-actionsc fluid">
									<div class="col-md-offset-3 col-md-9">
										<input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
										<button type="submit" class="btn green"><i class="fa fa-save"></i> 保存</button>
										<a href="<?php echo U('Menu/index?pid='.I('pid'));?>" class="btn default"><i class="fa fa-chevron-left"></i> 返回</a>
									</div>
								</div>
							</form>
							<!-- END FORM-->
						</div>
					</div>
					<!-- END VALIDATION STATES-->
				</div>
			</div>
    </div>
  </div>
  <!-- END CONTENT --> 
</div>
<script type="text/javascript">
	$(function(){
		 $.e_validate.init('.form-horizontal',{});
	});
</script>
</body>
</html>