<?php if (!defined('THINK_PATH')) exit();?><html>
<!DOCTYPE html>
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
<link href="/hbang/Public/static/treeview/css/default.css" rel="stylesheet" type="text/css"/>

<script src="/hbang/Public/Slike/dropify-master20160830/dist/js/dropify.js" type="text/javascript"></script>
<link href="/hbang/Public/Slike/dropify-master20160830/dist/css/dropify.css" rel="stylesheet" type="text/css"/>


<body>
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
            <div class="alert alert-warning" style="display: none">
                <strong>警告!</strong>你的操作是不允许的！
            </div>
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title"><?php echo ($meta_title); ?></h3>
                    <ul class="page-breadcrumb breadcrumb">
                        <li> <a href="javascript:void(0);" style="font-size: 13px;"> <?php echo ($meta_title_top); ?> </a> <i class="fa fa-angle-right"></i> </li>
                        <li style="font-size: 13px;"><?php echo ($meta_title); ?></li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet">
                        <div class="portlet-body">
                            <div class="table-container">
                                <div class="table-actions-wrapper"> <span> </span><button class="btn btn-sm green add-btn add-goods"  data-toggle="modal"><i class="fa fa-plus"></i>添加图片</button></div>

                                <table class="table table-bordered table-striped table-hover" style="font-size: 1.3px;" id="datatable">
                                    <thead>
                                    <tr class="heading" role="row">
                                        <th width="1%">编号</th>
                                        <th >排序</th>
                                        <th width="10%">轮播图片</th>
                                        <th width="20%">跳转URL</th>
                                        <th width="4%">状态</th>
                                        <th width="10%">操作</th>
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
         
            <!--BEGIN BODY-->
            <!--==========================添加地址弹出框===================-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">×
                </button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
            <form action="{U('index')}" method="post" class="form-horizontal" id="add-address">
                <div class="modal-body">
                    <div class="col-xs-12 modalbody">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close" class="btn btn-default"
                            data-dismiss="modal">关闭
                    </button>
                    <button type="submit" class="btn btn-primary btn-button">
                        提交更改
                    </button>
                </div>
            </form>
        </div><!-- /.modal-content -->

    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<style>
    .poit{
        position: absolute;
        right: 16px;
        top: 7px;
        z-index: 2;
    }
</style>

<script>
    /**
     * 编辑框综合类
     * slike <787193801@qq.com>
     * @type {{col: string, field: string, input: Editer.input, radio: Editer.radio}}
     */
    var Editer={

        //获取子节点栏目
        treeConf:{
                    'child':'child',        //option 数组 子键
                    'pkey':'column_pid',    //option 数组 父字段
                    'key':'column_id',      //option 数组 主字段
                    'name':'col_name',      //option 数组 标题字段
                    'def':'1',              //option 数组 默认值
                },

        inputText:'',
        /**+-----------------------------------------------------------------------
         * +
         * +            为了方便兼容，所以采用Input 多种类型
         * +
         * +----------------------------------------
         * /
        /**
         * 返回输入框
         * @param title  标题
         * @param field 字段
         * @arguments[2] 可选字段 输入框值
         * @arguments[3] 可选字段 是否禁用
         * @arguments[4] 可选字段 是否隐藏(3参赛填false 否则不能提交)
         * @returns {string}
         */
        input:function(title,field) {
            var value=arguments[2]?arguments[2]:'';
            var disabled=arguments[3]?' disabled ':'';
            if(arguments[4]){
                return '<input type="hidden" name="'+field+'"'+disabled+' class="form-control required" value="'+value+'"/>';
            }
            var list='<div class="form-group">'
                    +'<label class="control-label col-md-3">'+title+'</label>'
                    +'<div class="col-md-5">'
                    +'<input type="text" name="'+field+'"'+disabled+' class="form-control required" value="'+value+'"/>'
                    +'</div>'
                    +'</div>';
            return list;
        },
        /**
         * 返回输入框
         * @param title  标题
         * @param field 字段
         * @arguments[2] 可选字段 输入框值
         * @arguments[3] 可选字段 是否禁用
         * @arguments[4] 可选字段 是否隐藏(3参赛填false 否则不能提交)
         * @returns {string}
         */
        inputNumber:function(title,field) {
            var value=arguments[2]?arguments[2]:'';
            var disabled=arguments[3]?' disabled ':'';
            if(arguments[4]){
                return '<input type="hidden" name="'+field+'"'+disabled+' class="form-control required" value="'+value+'"/>';
            }
            var list='<div class="form-group">'
                +'<label class="control-label col-md-3">'+title+'</label>'
                +'<div class="col-md-5"><span class="badge badge-success pull-right poit">'+this.inputText+'</span>'
                +'<input type="text" name="'+field+'"'+disabled+' class="form-control required number" value="'+value+'"/>'
                +'</div>'
                +'</div>';
            return list;
        },
        /**
         * 返回输入框
         * @param title  标题
         * @param field 字段
         * @arguments[2] 可选字段 输入框值
         * @arguments[3] 可选字段 是否禁用
         * @arguments[4] 可选字段 是否隐藏(3参赛填false 否则不能提交)
         * @returns {string}
         */
        inputEmail:function(title,field) {
            var value=arguments[2]?arguments[2]:'';
            var disabled=arguments[3]?' disabled ':'';
            if(arguments[4]){
                return '<input type="hidden" name="'+field+'"'+disabled+' class="form-control required" value="'+value+'"/>';
            }
            var list='<div class="form-group">'
                +'<label class="control-label col-md-3">'+title+'</label>'
                +'<div class="col-md-5">'
                +'<input type="text" name="'+field+'"'+disabled+' placeholder="'+this.inputText+'" class="form-control required email" value="'+value+'"/>'
                +'</div>'
                +'</div>';
            return list;
        },

        /**
         * 返回输入框
         * @param title  标题
         * @param field 字段
         * @arguments[2] 可选字段 输入框值
         * @arguments[3] 可选字段 是否禁用
         * @arguments[4] 可选字段 是否隐藏(3参赛填false 否则不能提交)
         * @returns {string}
         */
        inputC:function(title,field) {
            var value=arguments[2]?arguments[2]:'';
            var disabled=arguments[3]?' disabled ':'';
            if(arguments[4]){
                return '<input type="hidden" name="'+field+'"'+disabled+' class="form-control required" value="'+value+'"/>';
            }
            var list='<div class="form-group">'
                    +'<label class="control-label col-md-3">'+title+'</label>'
                    +'<div class="col-md-5">'
                    +'<input type="text" name="'+field+'"'+disabled+' class="form-control number" value="'+value+'"/>'
                    +'</div>'
                    +'</div>';
            return list;
        },
        /**
         * 返回单选框
         * @param title 标题 ['标题',值]，['标题',值]
         * @param key   字段
         * @param def   选择值 ---def 会根据title中的值来 选中
         * @returns {string}
         */
         radio:function (title,key,def) {

             var list='<div class="form-group">'+
                     '<label class="control-label col-md-3">'+title[0]+'</label>' +
                     '<div class="col-md-5"><div class="radio-list"><label class="radio-inline">';

             list+='<input type="radio" '+(title[1][1]==def?'checked':'')+' name="'+key+'"  value="'+title[1][1]+'">';
             list+=''+title[1][0]+'</label><label class="radio-inline">';
             list+='<input type="radio" '+(title[2][1]==def?'checked':'')+' name="'+key+'"  value="'+title[2][1]+'">';
             list+=''+title[2][0]+'</label></div></div></div>';
             return list;
         },

         inputMore:function(title,field,pid_name) {
             var list='<div class="form-group" id="'+pid_name+'">'
                     +'<label class="control-label col-md-3">'+title+'</label>'
                     +'<div class="col-md-5">'
                     +'<input type="text" name="'+field+'" id="'+field+'" class="form-control select2" multiple/>'
                     +'</div>'
                     +'</div>';
             return list;
         },
         
        /**
         * 返回单选框 <多字段相加得到>
         * @param title 标题 ['标题',值]，['标题',值]
         * @param key   字段
         * @param def   选择值 ---def 会根据title中的值来 选中
         * @returns {string}
         */
        radioA:function (title,data,key,arr,def) {
            var list='<div class="form-group">'+
                    '<label class="control-label col-md-3">'+title+'</label>' +
                    '<div class="col-md-6" >' +
                    '<label class="radio-inline" style="padding-left:0px;"><div class="radio">' +
                    '</label>';
            for (var i=0;i<data.length;i++){
                list+='<label class="radio-inline" style="margin-left:0px;padding-left:0px;"><div class="radio">' +
                        '<input type="radio" '+(data[i][key]==def?'checked':'')+'  name="'+key+'"  value="'+data[i][key]+'">';
                for (var n=0;n<arr.length;n++){
                    if(n==1|| n==arr.length-1){
                        list+=' ';
                    }
                    list+=data[i][arr[n]];
                }

                list+='</div></label>';
            }
            list+='</div></div>';
            return list;
        },

        /**
         * 添加HTML提示
         */

        html:function (html,title) {
            var tit=title?title:"";
            var list='<div class="form-group">'
                list='<h4 class="block">'+tit+'</h4>'
                list+=html+'</div>';
            return list;
        },
        htmlA:function (html,answer,credit) {
            var list='<div class="form-group"><label class="control-label col-md-2"></label><div class="col-md-9">'
            list+='<h4>问题：'+html+'('+credit+'分)</h4>'

            list+='<h4 class="block">答案：<span style="font-size: 0.5em">'+answer+'</span></h4>'
            list+='</div></div>';
            return list;
        },
        /**
         * 获取下拉框的select HTML标签  V1.0
         * @param title         下拉框标题
         * @param key           下拉框 name值
         * @param option        下拉框的option -可以通过 getOption()获取
         * @returns {string}
         */
        select:function (title,key,option) {
            var list='<div class="form-group">'
                    +'<label class="control-label col-md-3">'+title+'</label>'
                    +'<div class="col-md-5">'
                    +'<select name="'+key+'" id="'+key+'" class="form-control user_section">'
                    +option
                    +'</select>'
                    +'</div>'
                    +'</div>';

            return list;
        },

        /**
         * 获取下拉框的select HTML标签  V1.0
         * @param title         下拉框标题
         * @param key           下拉框 name值
         * @param option        下拉框的option -可以通过 getOption()获取
         * @returns {string}
         */
        selectB:function (title,key,type,val,tag) {
            type=type?type:'4';
            var list='<div class="form-group">'
                list+='<label class="control-label col-md-3">'+title+'</label>'
                list+='<div class="col-md-7 col-sm-12">'
                list+='<label for="">'
                list+='<select name="'+key+'" id="'+key+'" class="form-control input-xsmall input-sm">'
                list+='<option value="1" '+(type==1||type==2?'selected':'')+'>选择题</option>'
                list+='<option value="3" '+(type==3?'selected':'')+'>判断</option>'
                list+='<option value="4" '+(type==4?'selected':'')+'>综合</option>'
                list+='</select>'
                list+='</label>　　'
                list+='<a href="javascript:" class="btn green" id="addItem">添加选项</a>'
                list+='<div class=" col-ms-5">'
                list+='<div id="select_exam1" class="exam" style="display: block;">'
            if(type==1 || type==2){
                for (var i=0;i<val.length;i++){
                    list+=this.inputChecked(i+1,val[i][tag],val[i].is_true);
                }
            }

                list+='</div>'
                list+='<div id="select_exam2" class="exam" style="display: none;">'
            if(type==3){
                for (var i=0;i<val.length;i++){
                    list+=this.inputCheckall(i+1,val[i][tag],val[i].is_true);
                }
            }

                list+='</div>'
                list+='<div id="select_exam3" class="exam" style="display: none;">'
            if(type==4){

            }

                list+='</div>'
                list+='</div>'
                list+='</div>'
                list+='</div>'

            return list;
        },

        /**
         * 返回option集合 V1.0
         * @param val   text字段
         * @returns {string}
         */
        chid:['','A','B','C','D','E','F','G','H','G'],
        inputChecked:function(val){
            var text=arguments[1]?arguments[1]:'';
            var checked=arguments[2]?arguments[2]:'';
            var str='<div class="input-group" style="margin: 5px">'
            +'<span class="input-group-addon"> '+this.chid[val]+'</span>'
            +'<input type="text" class="form-control" name="danx[]" value="'+text+'">'
            +'<span class="input-group-addon" style="background-color: transparent">'
            +'<input type="checkbox" value="'+val+'" name="answer_danx[]" '+(checked==1?'checked':'')+'>　<span><a href="javascript:" class="del-input">-</a></span>'
            +'</span>'
            +'</div>'

            return str;
        },
        /**
         * 判断题
         * */
        panduan:['','A','B'],
        inputCheckall:function(val){
            var text=arguments[1]?arguments[1]:'';
            var checked=arguments[2]?arguments[2]:'';
            var str='<div class="input-group" style="margin: 5px">'
                    +'<span class="input-group-addon"> '+this.panduan[val]+'</span>'
                    +'<input type="text" class="form-control" name="pand[]" value="'+text+'">'
                    +'<span class="input-group-addon" style="background-color: transparent">'
                    +'<input type="radio" value="'+val+'" name="answer_pand[]" '+(checked==1?'checked':(val==1?'checked':''))+'>　<span><a href="javascript:" class="del-input">-</a></span>'
                    +'</span>'
                    +'</div>'

            return str;
        },
        /**
         * 返回option集合 V1.0
         * @param arr   数据源
         * @param val   值字段
         * @param key   text字段
         * @returns {string}
         */
        getOption:function (arr,val,key,de) {
            //console.log(arr)
            var def=de?de:0;
            var str='';
            for (var i=0;i<arr.length;i++) {
                if(def==arr[i][val]){
                    str+='<option  value="'+arr[i][val]+'" selected>'+arr[i][key]+'</option>';
                }else{
                    str+='<option  value="'+arr[i][val]+'">'+arr[i][key]+'</option>';
                }
            }
            return str;
        },
        /**
         * 返回option集合 V1.0
         * @param begin     开始
         * @param end       结束
         * @returns {string}
         */
        getOptionNumber:function (begin,end) {
            var str='';
            for (var i=begin;i<=end;i++) {
                str+='<option  value="'+i+'">'+i+'</option>';
            }
            return str;
        },
        /**
         * 二级联动 option集合 V1.0
         * @param key           一级select id
         * @param child         二级select id
         * @param childdata     二级数据源(包含有1级值) 既 key 的字段名 存在与其中
         * @param childkey      二级 主字段 (二级option value所用)
         * @param childname     二级 标题字段(二级option text所用)
         * @returns {string}
         */
        getSelectChild:function (key,child,childdata,childkey,childname) {
            $('#'+key).change(function () {
                $('#'+child).html('');
                for (var i=0;i<childdata.length;i++){
                    if(childdata[i][key]==$(this).val()){
                        $('#'+child).append('<option value="'+childdata[i][childkey]+'">'+childdata[i][childname]+'</option>');
                    }
                }
            })
        },

        InputFile:function (name,miaos) {

            var str='';
            str+='<div class="form-group">'
            str+='<label class="control-label col-md-3">Excel：</label>'
            str+='<div class="col-md-9">'
            str+='<input type="file" name="'+name+'">'+miaos;
            str+='</div>'
            str+='</div>';
            return str;
        },

        ExpTemplate:function (url,miaos) {

            var str='';
            str+='<div class="form-group">'
            str+='<label class="control-label col-md-3">点击导出模版：</label>'
            str+='<div class="col-md-9">'
            str+='<a href="'+url+'" class="btn green">';
            str+='<i class="fa fa-search"></i>'+miaos;
            str+='</a>'
            str+='</div>'
            str+='</div>';
            return str;
        },

        Search:function (title,name) {
            var str='';
            str+='<div class="form-group">'
            str+='<label class="control-label col-md-3">'+title+'：</label>'
            str+='<div class="col-md-6">'
            str+='<div class="input-group" style="text-align:left">'
            str+='<input class="form-control" name="'+name+'" id="'+name+'" type="text">'
            str+='<span class="input-group-btn">'
            str+='<a href="javascript:;" class="btn green" id="tag_btn" data-original-title="" title="">'
            str+='<i class="fa fa-search"></i> 搜索'
            str+='</a>'
            str+='</span>'
            str+='</div>'
            str+='<div class="help-block">'
            str+='搜索考题标签'
            str+='</div>'
            str+='</div>';
            str+='</div>';
            return str;
        },
        /**
         * 获取部门信息 V1.0
         * @param a
         * @returns {string}
         */
        getSection:function (arr,a) {
            if(arr.length<=0){
                return '';
            }
            var str='';
            for(var i=0;i<arr.length;i++) {
                if (typeof(arr[i]) == 'object') {
                    if(typeof(arr[i]['child']) =='object'){
                        if(arr[i]['section_pid']=='0'){
                            str+='<option '+(arr[i]['section_id']==this.Selected?'selected':'')+' value="'+arr[i]['section_id']+'">'+arr[i]['sec_name']+'</option>'+this.getSection(arr[i]['child'],2);
                        }else{
                            str+='<option '+(arr[i]['section_id']==this.Selected?'selected':'')+' value="'+arr[i]['section_id']+'">'+this.space(a)+arr[i]['sec_name']+'</option>'+this.getSection(arr[i]['child'],a+2);
                        }
                    }else{
                        str+='<option '+(arr[i]['section_id']==this.Selected?'selected':'')+' value="'+arr[i]['section_id']+'">'+this.space(a)+arr[i]['sec_name']+'</option>';
                    }
                }
            }
            return str;
        },

        /**
         * 获取无限级栏目获取JS信息 V2.0
         * @param a
         * @returns {string}
         */
        getTree:function (arr,a) {
            var str='';
            for(var i=0;i<arr.length;i++) {
                if (typeof(arr[i]) == 'object') {
                    if(typeof(arr[i][this.treeConf.child]) =='object'){
                        if(arr[i][this.treeConf.pkey]=='0'){
                            str+='<option '+(arr[i][this.treeConf.key]==this.treeConf.def?'selected':'')+' value="'+arr[i][this.treeConf.key]+'">'+arr[i][this.treeConf.name]+'</option>'+this.getTree(arr[i][this.treeConf.child],2);
                        }else{
                            str+='<option '+(arr[i][this.treeConf.key]==this.treeConf.def?'selected':'')+' value="'+arr[i][this.treeConf.key]+'">'+this.space(a)+arr[i][this.treeConf.name]+'</option>'+this.getTree(arr[i][this.treeConf.child],a+2);
                        }
                    }else{
                        str+='<option '+(arr[i][this.treeConf.key]==this.treeConf.def?'selected':'')+' value="'+arr[i][this.treeConf.key]+'">'+this.space(a)+arr[i][this.treeConf.name]+'</option>';
                    }
                }
            }
            return str;
        },
        /**
         *子节点 隔离符号
         * @param a
         * @returns {string}
         */
        space:function(a) {
            var str='';
            for (var i=0;i<a;i++){
                str+='　';
            }
            return str;
        },

        editer:function () {
            var str='';
            str+='<div class="form-group">'
            str+='<label class="control-label col-md-1">内容 </label>'
            str+='<div class="col-md-11">'
            str+='<textarea rows="" cols="" class="form-control hide" id="content" name="content">1111111111</textarea>';
            str+='</div>'
            str+='</div>';
        },
        /**
         * Ajax 请求数据
         * @param url
         * @param func
         * @constructor
         */
        Ajax:function (url,func,data) {
            l_blockUI();
            $.ajax(url, {
                dataType: 'json',
                type: 'post',
                data:data,
                error: function () {
                    show_message({status: 0, info: '请求超时'});
                    App.unblockUI();
                },
                timeout: 60000,
                success: func,
            })
        },
        
        Zhangjie:function () {
            var html='';
            //一个输入框
            html+='<div class="portlet box green">';
            html+='     <div class="portlet-title">';
            html+='         <div class="caption">';
            html+='<i class="fa fa-reorder"></i>章节1';
            html+='</div>';
            html+='<div class="tools">';
            html+='<a href="" class="collapse">';
            html+='</a>'
            html+='<a href="" class="remove">';
            html+= '</a>';
            html+='</div>';
            html+='</div>';
            html+='<div class="portlet-body form">';
            html+='<div class="form-body">';

            html+='<div class="form-group">';
            html+='<div class="col-md-12">';
            html+='<div class="input-group">';
            html+='<span class="input-group-btn">';
            html+='<button class="btn default" type="button">标题</button>';
            html+='</span>';
            html+='<input class="form-control" type="text">';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            //图片编辑器
            html+='<div class="form-group">';
            html+='<div class="col-md-12">';
            html+='<div class="fileinput fileinput-new" data-provides="fileinput"><input type="hidden">';
            html+='<div class="fileinput-new thumbnail" style="width:695px; height:320px;">';
            html+='<img src="http://www.placehold.it/350x250/EFEFEF/AAAAAA&amp;text=no+image" alt="">';
            html+='</div>';
            html+='<div class="fileinput-preview fileinput-exists thumbnail" style="max-width:695px; max-height:320px;">';
            html+='</div>';
            html+='<div>';
            html+='<span class="btn default btn-file">';
            html+='<span class="fileinput-new">';
            html+='添加图片';
            html+='</span>';
            html+='<span class="fileinput-exists">';
            html+='更换';
            html+='</span>';
            html+='<input name="filename" type="file">';
            html+='</span>';
            html+='<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">';
            html+='删除';
            html+='</a>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            //文字编辑器
            html+='<div class="form-group">';
            html+='<label class="control-label col-md-3"></label>';
            html+='<div class="col-md-12">';
            html+='<textarea class="wysihtml5 form-control" rows="6"></textarea>';
            html+='</div>';
            html+='</div>';
            html+='<hr>';
            //按钮
            html+='<div class="form-group">';
            html+='<div class="col-md-offset-4 col-md-8">';
            html+='<button type="button" class="btn blue" style="text-align: center">添加图片</button>';
            html+='<button type="submit" class="btn green" style="text-align: center">添加文章</button>';
            html+='</div>';
            html+='</div>';

            //外层DIV
            html+='</div>';
            html+='</div>';
            html+='</div>';

            return html;
        },
        /**
         * 添加一个编辑框 外壳
         * @param title
         * @param mid
         */
        portlet:function (title,key,mid,value) {
            var html='';
            value=value?value:'';
            html+='<div class="portlet box green">';
            html+='     <div class="portlet-title">';
            html+='         <div class="caption">';
            html+='<i class="fa fa-reorder"></i>'+title+'';
            html+='</div>';
            html+='<div class="tools">';
            html+='<a href="" class="collapse">';
            html+='</a>';
            html+='<a href="" class="remove">';
            html+= '</a>';
            html+='</div>';
            html+='</div>';
            html+='<div class="portlet-body form">';
            html+='<div class="form-body" id="'+key+mid+'">';
            html+='<div class="form-group">';
            html+='<div class="col-md-12">';
            html+='<div class="input-group">';
            html+='<span class="input-group-btn">';
            html+='<button class="btn default" type="button">标题</button>';
            html+='</span>';
            html+='<input class="form-control" name="title[]" value="'+value+'" type="text">';
            html+='</div>';
            html+='</div>';
            html+='</div>';


            //外层DIV
            html+='</div>';

            //添加按钮
            html+='<div class="form-body">';
            html+='<div class="form-group">';
            html+='<div class="col-md-offset-4 col-md-8">';
            html+='<button type="button" class="btn blue" id="add-photo'+mid+'" data-num="'+mid+'"  style="text-align: center">添加图片</button>';
            html+='<button type="button" class="btn green" id="add-text'+mid+'" data-num="'+mid+'"  style="text-align: center">添加文章</button>';
            html+='</div>';
            html+='</div>';
            html+='</div>';

            html+='</div>';
            html+='</div>';
            return html;
        },

        photoup:function (id) {
            var html='';
            //图片编辑器
            html+='<div class="form-group" id="'+id+'">';
            html+='<div class="col-md-12">';
            html+='<div class="fileinput fileinput-new" data-provides="fileinput">';
            html+='<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:695px; height:320px;">';
            html+='<img src="http://www.placehold.it/350x250/EFEFEF/AAAAAA&amp;text=no+image" alt="">';
            html+='</div>';
//            html+='<div class="fileinput-preview fileinput-exists thumbnail" style="max-width:695px; max-height:320px;">';
//            html+='</div>';
            html+='<div>';
            html+='<span class="btn default btn-file" style="display: none">';
//            html+='<span class="fileinput-new">';
//            html+='添加图片';
//            html+='</span>';
//            html+='<span class="fileinput-exists">';
//            html+='更换';
//            html+='</span>';
            html+='<input name="file[]" type="file">';
            html+='</span>';
            html+='<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">';
            html+='删除';
            html+='</a>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            return html;
        },
        photoupA:function (title,id,path) {
            var html='';
            //图片编辑器
            html+='<div class="form-group" id="'+id+'">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-4">';
            html+='<div class="fileinput fileinput-new" data-provides="fileinput">';
            html+='<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:170px; height:150px;">';
            html+='<img src="'+path+'" id="" alt="">';
            html+='</div>';
//            html+='<div class="fileinput-preview fileinput-exists thumbnail" style="max-width:695px; max-height:320px;">';
//            html+='</div>';
            html+='<div>';
            html+='<span class="btn default btn-file" style="display: none">';
//            html+='<span class="fileinput-new">';
//            html+='添加图片';
//            html+='</span>';
//            html+='<span class="fileinput-exists">';
//            html+='更换';
//            html+='</span>';
            html+='<input name="file" type="file">';
            html+='<input name="pic" type="text" value="">';
            html+='</span>';
            html+='<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">';
            html+='删除';
            html+='</a>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
            return html;
        },
        photoupC:function (title,id,path) {
            var html='';
            //图片编辑器
            html+='<div class="form-group" id="'+id+'">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-4">';
            html+='<div class="fileinput fileinput-new" data-provides="fileinput">';
            html+='<span class="" style="display: block;">封面图：</span>';
            html+='<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:170px; height:150px;">';
            html+='<img src="'+path[0]+'" alt="">';
            html+='</div>';
            html+='<div>';
            html+='<span class="btn default btn-file" style="display: none">';
            html+='<input name="file1" type="file">';
            html+='</span>';
            html+='<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">';
            html+='删除';
            html+='</a>';
            html+='</div>';
            html+='</div>';
            html+='</div>';

            html+='<div class="col-md-4">';
            html+='<div class="fileinput fileinput-new" data-provides="fileinput">';
            html+='<span class="" style="display: block;">商品图：</span>';
            html+='<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:170px; height:150px;">';
            html+='<img src="'+path[1]+'" id="" alt="">';

            html+='</div>';
            html+='<div>';
            html+='<span class="btn default btn-file" style="display: none">';
            html+='<input name="file2" type="file">';

            html+='</span>';
            html+='<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">';
            html+='删除';
            html+='</a>';
            html+='</div>';
            html+='</div>';
            html+='</div>';

            html+='</div>';
            return html;
        },
        fontedit:function (id,value) {
            var html = '';
            value=value?value:'';
            //文字编辑器
            html+='<div class="form-group" id="'+id+'">';
            html+='<label class="control-label col-md-3"></label>';
            html+='<div class="col-md-12">';
            html+='<textarea class="wysihtml5 form-control" name="text[]"  rows="6">'+value+'</textarea>';
            html+='</div>';
            html+='</div>';
            html+='<hr>';
            return html;
        },
        fonteditA:function (title,id,value) {
            var html = '';
            value=value?value:'';
            //文字编辑器
            html+='<div class="form-group" id="'+id+'">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-8">';
            html+='<textarea class="wysihtml5 form-control" name="'+id+'"  rows="6">'+value+'</textarea>';
            html+='</div>';
            html+='</div>';
//            html+='<hr>';
            return html;
        },
        Ueditor:function(title,id,$text){
			console.log($text)
            var html = '';
            //文字编辑器
            html+='<label class="control-label">'+title+'</label>';
            html+='<div class="form-group" id="'+id+'">';
            html+='<div class="col-md-8">';
            html+='<script id="'+id+'" name="'+id+'" type="text/plain">'+$text+'<\/script>';
            html+='</div>';
            html+='</div>';
            html+='<hr>';

            return html;
        },
        
        Ueditor2:function (title,id,value) {
            var html = '';
            html+='<div class="form-group">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-8">';

            html+='<script id="'+id+'" name="'+id+'" type="text/plain" style="height:400px; z-index:998">'+value+'<\/script>';
            html+='</div>';
            html+='</div>';
            
            return html;
        },
        Textarea:function (title,id,value) {
            var html = '';
            value=value?value:'';
            //文字编辑器
            html+='<div class="form-group" id="'+id+'">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-8">';
            html+='<textarea class="form-control" name="'+id+'"  rows="6">'+value+'</textarea>';
            html+='</div>';
            html+='</div>';
            html+='<hr>';
            return html;
        },
        Dropify:function (title,id,value) {
            var html = '';
            html+='<div class="form-group" id="1">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-8">';
            html+='<input type="file" class="'+id+'" name="'+id+'" data-show-remove="false" data-show-loader="true"'; 
            
            if(value){
	            html+=' data-default-file="'+value+'"/>';
            }else{
	            html+=' />';
            }
            
            html+='</div>';
            html+='</div>';
            return html;
        },
        Dropify2:function (title,id,value) {
            var html = '';
            html+='<div class="form-group" id="1">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-4" ><span class="badge badge-success pull-right poit">'+this.inputText+'</span>';
            html+='<input type="file" class="'+id+'" name="'+id+'" data-show-remove="false" data-show-loader="true" data-default-file="'+value+'"/>';
            html+='</div>';
            html+='</div>';
            return html;
        },
        dropify_start:function(obj){
            $(obj).dropify({
                messages: {'default': '点击上传图片','replace': '点击图片上传替换图片','remove':'删除图片','error':'Ooops, something wrong appended.'}}
            ).on('dropify.beforeClear',function(event, element) {

                return confirm("Do you really want to delete \"" + element.filename + "\" ?");
            });
        },

        /**
         * 文字编辑器
         * @param title
         * @param id
         * @param value
         * @returns {string}
         * @constructor
         */
        Froala:function (title,id,value) {
            var html = '';
            html+='<div class="form-group" id="1">';
            html+='<label class="control-label col-md-2">'+title+'</label>';
            html+='<div class="col-md-8">';
//            html+=' <div id="'+id+'">'+value+'</div>';
            html+='<textarea class="form-control" rows="6" id="'+id+'" name="'+id+'" style="display: none">'+value+'</textarea>';
            html+='</div>';
            html+='</div>';
            return html;
        },
        btn:function (id) {
            var html='';
            //按钮
            html+='<div class="form-group">';
            html+='<div class="col-md-offset-4 col-md-8">';
            html+='<button type="button" class="btn blue add-photo" data-num="'+id+'"  style="text-align: center">添加图片</button>';
            html+='<button type="button" class="btn green add-text" data-num="'+id+'"  style="text-align: center">添加文章</button>';
            html+='</div>';
            html+='</div>';
            return html;
        },

        btnA:function (id) {
            var html='';
            //按钮
            html+='<div class="form-group">';
            html+='<div class="col-md-offset-4 col-md-8">';
            html+='';
            html+='';
            html+='</div>';
            html+='</div>';
            return html;
        },
        deleteBtn:function (id) {
            var html='';
            //按钮
            html+='<div class="form-group">';
            html+='<div class="col-md-offset-4 col-md-8">';
            html+='<button type="button" class="btn green add-text" id="'+id+'" style="text-align: center">删除图片</button>';
            html+='</div>';
            html+='</div>';
            return html;
        },

        
        /**
         * 获取下拉框的select HTML标签  V1.0
         * @param title         下拉框标题
         * @param key           下拉框 name值
         * @param option        下拉框的option -可以通过 getOption()获取
         * @returns {string}
         */
        select2:function (title,key,option,dsc,pid_name,multiple) {
            var list='<div class="form-group" id="'+pid_name+'">'
                    +'<label class="control-label col-md-3">'+title+'</label>'
                    +'<div class="col-md-6">';
                 if(multiple){
	                list+='<select name="'+key+'[]" id="'+key+'" class="form-control select2 user_section" placeholder="'+dsc+'" '+multiple+'>';
                 }else{
	                list+='<select name="'+key+'" id="'+key+'" class="form-control select2 user_section" placeholder="'+dsc+'" '+multiple+'>';
                 }
                
                    
                list+='<option value=""></option>'
                    +option
                    +'</select>'
                    +'</div>'
                    +'</div>';

            return list;
        },
        
        inputA:function (title,key1,val1,key2,val2) {
          var html='';
            html+='<div class="form-group">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-4">';
            html+='<div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">';
            html+='<input class="form-control" name="'+key1+'" id="'+key1+'" value="'+val1+'" type="text">';
            html+='<span class="input-group-addon">';
            html+='至';
            html+='</span>';
            html+='<input class="form-control" name="'+key2+'" id="'+key2+'" value="'+val2+'" type="text">';
            html+='</div>';
            html+='<!-- /input-group -->';
            html+='<span class="help-block">';
            //html+='Select date range';
            html+='</span>';
            html+='</div>';
            html+='</div>';
            return html;
        },

        inputB:function (title,key1,val1,key2,val2) {
            val1 = val1==''?0:val1;
            val2 = val2==''?0:val2;
            var html='';
            html+='<div class="form-group">';
            html+='<label class="control-label col-md-3">'+title+'</label>';
            html+='<div class="col-md-2">';
            html+='<div class="input-group" data-date="10/11/2012" data-date-format="mm/dd/yyyy">';
            html+='<span class="input-group-addon">';
            html+='已兑';
            html+='</span>';
            html+='<input class="input-xsmall form-control" name="'+key1+'" id="'+key1+'" value="'+val1+'" type="text">';
            html+='<span class="input-group-addon">';
            html+='库存';
            html+='</span>';
            html+='<input class="input-xsmall form-control" name="'+key2+'" id="'+key2+'" value="'+val2+'" type="text">';
            html+='</div>';
            html+='<!-- /input-group -->';
            html+='<span class="help-block">';
            //html+='Select date range';
            html+='</span>';
            html+='</div>';
            html+='</div>';
            return html;
        },
    }
    $(function(){
        var ABC=['','A','B','C','D','E','F','G','H','J'];
        var PAN=['','A','B'];
        var n=1;
        $('.del-input').live('click',function () {
            $(this).parents('.input-group').remove();
            switch ($("#exam_type").val()){
                case '1':
                    var a=$('#select_exam1').children('.input-group');

                    for (var i=0;i<a.length;i++){
                        $($(a[i]).children('.input-group-addon')[0]).html(ABC[n]);
                        $($(a[i]).children('.input-group-addon')[1]).children('input[type=checkbox]').val(n++)
                    }

                    break;
                case '3':
                    var b=$('#select_exam2').children('.input-group');
                    for (var i=0;i<b.length;i++){
                        $($(b[i]).children('.input-group-addon')[0]).html(PAN[n]);
                        $($(b[i]).children('.input-group-addon')[1]).children('input[type=checkbox]').val(n++)
                    }
                    break;
                case '4':
                    var c=$('#select_exam3').children('.input-group');
                    for (var i=0;i<c.length;i++){
                        $($(c[i]).children('.input-group-addon')[0]).html(n);
                        $($(c[i]).children('.input-group-addon')[1]).children('input[type=checkbox]').val(n++)
                    }
                    break;
            }

            n=1;
        })
    })

</script>
            <script>
                $(function () {

                    $('.add-goods').live('click',function () {
                        var model = $('#myModal');
                        var obj=Object.create(Editer);
                        
						obj.Ajax("<?php echo U('shows/getAllArticle');?>",function(article){
							/* console.log(article); */
	                        model.find('#add-address').attr('action', "<?php echo U('add');?>");
	                        model.find('.modal-title').html("上传图片");
	                        model.find('.btn-primary').html("立即添加");
	                        model.find('.modalbody').html('');
	
	                        model.find('.modalbody').append(obj.Dropify('上传图片：', 'showpic',''));//添加了一个文字编辑器
	
	                        model.find('.modalbody').append(obj.select2('跳转文章：', 'url',obj.getOption(article,'article_id','title'),'选择跳转至文章'));//添加了一个文字编辑器
							$('#url').select2();
	                        $('.showpic').dropify({
	                            messages: {'default': '点击上传图片','replace': '点击图片上传替换图片','remove':'删除图片','error':'Ooops, something wrong appended.'}}
	                        ).on('dropify.beforeClear',function(event, element) {
	
	                            return confirm("Do you really want to delete \"" + element.filename + "\" ?");
	                        });
						})
                        model.modal();
                        App.unblockUI();
                        $.e_validate.init('#add-address', {modal: model, ignore: ''});
                    })

                    $('.sortadd').live('click',function () {
                        var url=$(this).attr('href')
                          $.ajax({
                              url:url,
                              success:function (data) {
                                  console.log(data)
                                  if(data.status){
                                      $('#datatable').dataTable().fnDraw();
                                  }
                                  show_message({status:data.status,info:data.info})
                              }
                          })
                        return false;
                    })

                    function ajaxRequestCallBack(){

                    }
                })
                
                function Dropify(title,id,value) {
                    var html = '';
//                    html+='<div class="well">';
                    html+='<input type="file" class="'+id+'" name="'+id+'" data-show-remove="false" data-show-loader="true" data-default-file="'+value+'"/>';
//                    html+='</div>';
                    return html;
                }

                $(function(){
                    datatable_init({
                        src: $("#datatable"),
                        sAjaxSource: "<?php echo U('getList');?>",
                        aoColumns:[{bSortable:false},{bSortable:false},{bSortable:false},{bSortable:false},{bSortable:false},{bSortable:false},],
                    });

                });
            </script>
            <!--END BODY-->
        </div>
    </div>
</div>
</body>
</html>