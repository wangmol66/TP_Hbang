<?php

/**
 * js插件配置
 */
return array(

        'togglebuttons' => array(
	                        'Public/static/metronic/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
	                        'Public/static/metronic/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
	                       ),
		'validation'	=> 	 array(
		                        'Public/static/metronic/plugins/jquery-validation/dist/jquery.validate.min.js',
		                        'Public/static/metronic/plugins/jquery-validation/localization/messages_zh.js',
		                      ),  
		'datatable'     =>	array(
	                         'Public/static/metronic/plugins/data-tables/DT_bootstrap.css',
			                 'Public/static/metronic/plugins/data-tables/jquery.dataTables.min.js',
			                 'Public/static/metronic/plugins/data-tables/DT_bootstrap.js',
			        	     'Public/static/metronic/plugins/data-tables/datatableinit.js'
	                       ),
		'uniform'     =>	array(
	                         'Public/static/metronic/plugins/uniform/css/uniform.default.min.css',
			                 'Public/static/metronic/plugins/uniform/jquery.uniform.min.js',
	                       ),  
		'cropit_master'  =>	array(
                         		'Public/static/metronic/plugins/cropit_master/dist/jquery.cropit.js'
                       		),
	    'nestable' => array(
	                 	'Public/static/metronic/plugins/jquery-nestable/jquery.nestable.css',
	                    'Public/static/metronic/plugins/jquery-nestable/jquery.nestable.js'      		
	                 ),
	    'ckeditor' => array(
	                 	'Public/static/ckeditor/ckeditor.js',
	                 ),
	    'jstree' => array(
	                 	'Public/static/metronic/plugins/jstree/dist/themes/default/style.min.css',
	                 	'Public/static/metronic/plugins/jstree/dist/jstree.min.js',
	                 ),
		'select2' => array(
				'Public/static/metronic/plugins/select2/select2_metro.css',
				'Public/static/metronic/plugins/select2/select2.min.js',
		),
	    /*
		|--------------------------------------------------------------------------
		| 日期插件
		|--------------------------------------------------------------------------
		*/
		'datepicker' => array(
		                        'Public/static/metronic/plugins/bootstrap-datepicker/css/datepicker.css',
		        		  		'Public/static/metronic/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
								'Public/static/metronic/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.zh-CN.js'
		                       ),

        'fileinput' => array(
                                'Public/static/metronic/plugins/bootstrap-fileinput/bootstrap-fileinput.css',
                                'Public/static/metronic/plugins/bootstrap-fileinput/bootstrap-fileinput.js',
        ),

	    'ueditor'   =>array(
	        'Public/Slike/Ueditor/ueditor.config.js',
	        'Public/Slike/Ueditor/ueditor.all.min.js',
	    ),
		
		/*
		 |--------------------------------------------------------------------------
		 | 范围日期插件
		 |--------------------------------------------------------------------------
		 */
		
		'daterangepicker'   =>array(
				'Public/Slike/bootstrap-daterangepicker/moment.min.js',
				'Public/Slike/bootstrap-daterangepicker/daterangepicker.js',
				'Public/Slike/bootstrap-daterangepicker/daterangepicker.css',
		),
		
		/*
		 |--------------------------------------------------------------------------
		 |图标上传插件
		 |--------------------------------------------------------------------------
		 */
		
		'cropit_master'   =>array(
				'Public/Static/metronic/plugins/cropit_master/dist/jquery.cropit.js',
		),
		
		'dropify'   =>array(
				'Public/Slike/dropify-master20160830/dist/js/dropify.js',
				'Public/Slike/dropify-master20160830/dist/css/dropify.css',
		),

);