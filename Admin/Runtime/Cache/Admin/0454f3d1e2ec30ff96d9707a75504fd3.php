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
      <div class="row">
        <div class="col-md-12"> 
          <!-- BEGIN PAGE TITLE & BREADCRUMB-->
          <h3 class="page-title"><?php echo ($meta_title); ?>  </h3>
          <ul class="page-breadcrumb breadcrumb">
            <li> <a href="javascript:void(0);"> 有问邦解答 </a> <i class="fa fa-angle-right"></i> </li>
            <li> <?php echo ($meta_title); ?></li>
          </ul>
          <!-- END PAGE TITLE & BREADCRUMB--> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="portlet">
            <div class="portlet-body">
              <div class="table-container">
                <div class="table-actions-wrapper"> <span> </span> <select
                        class="form-control input-inline input-small input-sm select-batch">
                    <option value="0">批量操作</option>
                    <option value="1">批量删除</option>
                </select>
                    <!-- <a  class="btn btn-sm blue add-btn" href="<?php echo U('add');?>"><i class="fa fa-plus"></i> 新增 </a> -->
                </div>
                <table class="table table-bordered table-striped table-hover" id="datatable">
                  <thead>
                    <tr class="heading" role="row">
                        <th width="36px"><input class="group-checkable" type="checkbox"></th>
	                    <th>话题</th>
	                    <th width="100px">作者</th>
	                    <th width="50px">赞</th>
	                    <th width="50px">回复数</th>
	                    <th width="50px">浏览数</th>
	                    <th width="140px">发布时间</th>
	                    <th width="70px">状态</th>
	                    <th width="120px">操作</th>
                    </tr>
                    <tr role="row" class="filter">
                        <th></th>
	                    <th><input type="text" class="form-control form-filter input-sm" name="title"/></th>
	                    <th><input type="text" class="form-control form-filter input-sm" name="author"/></th>
	                    <th></th>
	                    <th></th>
	                    <th></th>
	                    <th></th>
	                    <th><select name="status" class="form-control form-filter select2 input-sm">
                      		<option value="">全部</option>
                      		<option value="1">隐藏</option>
                      		<option value="2">显示</option>
                        </select></th>
	                    <th>
	                       <div class="btn-group">
							<a class="btn btn-xs filter-submit btn-default">
								<i class="fa fa-search"></i> 搜索
							</a>
							<button data-toggle="dropdown" class="btn btn-default dropdown-toggle btn-xs" type="button"><i class="fa fa-angle-down"></i></button>
							<ul role="menu" class="dropdown-menu pull-right">
								<li>
									<a href="javascript:void(0);" class="filter-cancel">重置</a>
								</li>
							</ul>
						</div>
						</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END CONTENT --> 
  <script type="text/javascript">
		$(function(){
			datatable_init({
				src: $("#datatable"),
				sAjaxSource: "<?php echo U('getList');?>",
	            aoColumns:[
	            	{bSortable:false},
	            	{bSortable:false},
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


                Smelly.confirmAlert("<?php echo U('checked');?>",msg[type-1],{val:val,type:type},function(data){
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
</body></html>