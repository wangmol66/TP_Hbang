<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\DoctorModel;
class UserController extends InitController {
    public function index(){
    	
    	$this->display();
    }
    
    /**
     * 共用回复
     */
    public function reply(){
    	$type = I('type');
    	$id = I('id');
    	
    	$Model = 'Home\\Model\\'.ucwords($type).'Model';
    	
    	$m = new $Model();
    	$tA = $m->where(array('id'=>$id))->find();
//     	print_r($tA);
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    
    public function about(){
    	$tA = M('about')->where(array('id'=>1))->find();
    	
    	$this->assign('info',$tA);
    	$this->display();
    }
}