<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\Slike\NesTableController;
class ReviewCategoryController extends NesTableController {
	const cName='ReviewCategory';
	public $className        = 'ReviewCategory';
	public $tableName        = 'hbang_review_category';
	public $fieldName        = 'type_name';
	public $parentsField     = 'type_pid';
	public $mainField        = 'type_id';
	public $maxLevel         = 1;
	public $maxCeng          = 1;
	public $icon          	 = 'icon';
	
	function __construct()
	{
		parent::__construct();
	}
	
	public function index(){
	
		//加载静态插件
		$this->assign('__plugins', 'datatable,select2');
		$this->assign('__sidebar', 'ReviewCategory/index');
		$this->assign('title','分类管理');
		//$this->assign('select',$this->getSection());
		$this->assign('maxLevel',$this->maxLevel);
		$this->display();
	}
}