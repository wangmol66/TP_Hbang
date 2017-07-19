<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\UserModel;
class FollowMeController extends InitController {
    public function index(){
    	$um = new UserModel();
    	$tA = $um->getCollection(3);
//     	print_r($tA);
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 邦邦解答
     */
    public function index2(){
    	 
    	$um = new UserModel();
    	$tA = $um->getCollection(1);
    	
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 往期回顾
     */
    public function index3(){
    	$um = new UserModel();
    	$tA = $um->getCollection(2);
    	$this->assign('info',$tA);
    	$this->display();
    }
}