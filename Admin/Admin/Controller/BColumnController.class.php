<?php

    //+------------------------------------------------------------------
    //|  邦邦后台管理  邦邦首页
    //+-------------------------------------------------------------------
    //|  Slike <787193801@qq.com> 2016年10月24日 11:44:02
    //+-------------------------------------------------------------------

    namespace Admin\Controller;

    use Admin\Slike\NesTableController;
				
    class BColumnController extends NesTableController  {
        public $className        = 'BColumn';
        public $tableName        = 'bang_column';
        public $fieldName        = 'col_name';
        public $parentsField     = 'column_pid';
        public $mainField        = 'column_id';
        public $fatherField      = 'column_id';
        public $maxLevel         = 1;
        public $maxCeng          = 1;


        public function index(){
            $meta_title = '产品分类';
            $meta_title_top = '产品分类';
            //加载静态插件
            $this->assign('__plugins', 'datatable');
            $this->assign('__sidebar', 'BColumn/index');
            $this->assign('meta_title', $meta_title);
            $this->assign('meta_title_top', $meta_title_top);
            $this->assign('maxLevel',$this->maxLevel);
            //print_r("<script>console.log('模块访问');</script>");
            $this->display();
        }

        public function edit($mid,$name)
        {
            if(!empty($_FILES['icon_url'])){
                $error=$this->_uploadPicPath($_FILES['icon_url'],'icon','icon'.$mid);
                if(!$error['status']){
                    $this->error($error['data']);
                }
                ##更新地址
                $res=$this->save(array('col_icon'=>$error['data']),$mid);
//                if(! $res){
//                    $this->error('图标更新失败');
//                }
            }
            ##修改名称
            parent::edit($mid,$name,true);
        }

    }
