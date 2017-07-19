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
			<style>
				 img{
				 	max-width: 100%;
				 }
				 </style>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title"><?php echo ($title); ?></h3>
					<ul class="page-breadcrumb breadcrumb">
						<li><a href="javascript:void(0);"> 新闻列表 </a> <i
							class="fa fa-angle-right"></i></li>
						<li><?php echo ($title); ?></li>
						<li class="btn-group">
							<a class="btn green recharge-btn" style="color:#fff" href="<?php echo U('Bangnews/edit/id/'.$info['id']);?>">
								<i class="fa fa-edit"></i> 编辑
							</a>
							<a class="btn default return ml_5" style="margin-left: 5px;" href="<?php echo U('index');?>">
								<i class="fa fa-chevron-left"></i> 返回
							</a>
						</li>
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
                        <form action="<?php echo U('save');?>" class="form-horizontal" method="post">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">标题  <span class="required"></span></label>
                                    <div class="col-md-4">
                                        <label class="col-md-3 control-label" style="text-align: left;"><?php echo ($info["title"]); ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">文章分类  <span class="required">*</span></label>
                                    <div class="col-md-4">
                                       <label class="col-md-3 control-label" style="text-align: left;"><?php echo ($info["type_name"]); ?></label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">封面图   <span class="required">*</span></label>
                                    <div class="col-md-6">
           								<label class="col-md-3 control-label" style="text-align: left;"><img style="max-width: 100%;" src="<?php echo ($info["show_url"]); ?>"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">摘要  <span class="required">*</span></label>
                                    <div class="col-md-4">
                                       <label class="col-md-8 control-label" style="text-align: left;"><?php echo ($info["remark"]); ?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">文章内容  <span class="required">*</span></label>
                                    <div class="col-md-6">
                                     <label class="col-md-8 control-label" style="text-align: left;"><?php echo ($info["content"]); ?></label>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-actionsc fluid">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="<?php echo U('index');?>" class="btn default"><i class="fa fa-chevron-left"></i> 返回</a>
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
	<script type="text/javascript">
		$(function(){
			datatable_init({
				src: $("#datatable"),
				sAjaxSource: "<?php echo U('Doctor/getReplyList/id/'.$_GET['id']);?>",
	            aoColumns:[
	            	{bSortable:false},
	            	{bSortable:false},
	            	{bSortable:false},
	            	{bSortable:false},
	            	{bSortable:false},
	            	{bSortable:false},
	            	{bSortable:false},
	            	],
			});
			
			$('.select-batch').change(function(){
                var type = $(this).val();
                var val=[];
                var oB = $('.checkable');
                for(var i = 0;i<oB.length;i++){
                    if(oB[i].checked){
                        val.push(oB[i].value);
                    }
                }
                msg=['确定要删除已选数据么？'];
                console.log(val);


                Smelly.confirmAlert("<?php echo U('checkedReply');?>",msg[type-1],{val:val,type:type},function(data){
                    console.log(data);
                });
                $(".select-batch option[value='0']").attr("selected", true);//设置选中
            })
            
    		$('.remaks-item').live('focus', function(){
    			$(this).css('height', '150px');
    		});
    		$('.remaks-item').live('blur', function(){
    			$(this).css('height', '22px');
    		});
		});
	</script>
</div>
</body>
</html>