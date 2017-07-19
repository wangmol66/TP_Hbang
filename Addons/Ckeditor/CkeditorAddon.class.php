<?php

namespace Addons\Ckeditor;
use Common\Controller\Addon;

/**
 * Ckeditor插件
 * @author 无名
 */

    class CkeditorAddon extends Addon{

        public $info = array(
			            'name'=>'Ckeditor',
			            'title'=>'Ckeditor',
			            'description'=>'编辑器',
			            'status'=>1,
			            'author'=>'无名',
			            'version'=>'0.1'
       				 );

        public function install(){
            return true;
        }

        public function uninstall(){
            return true;
        }

        /**
		 * 编辑器挂载的后台文档模型文章内容钩子
		 * @param array('id'=>'表单id')
		 */
        public function ckeditor($data){
        	
        	$this->assign('addons_data', $data);
			$this->assign('addons_config', $this->getConfig());
			$this->display('content');
        }
    }