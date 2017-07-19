<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\AnswerModel;
use Home\Model\ReviewModel;
use Home\Model\DoctorModel;
class ViewsController extends InitController {
    public function index(){
    	$m = new DoctorModel();
    	$tA = $m->getDoctorLog(UID,1);
    	 
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 友邦记录
     */
    public function index2(){
    	$m = new AnswerModel();
    	$tA = $m->getAnswerLog(UID,1);
//     	print_r($tA);
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    public function index3(){
    	$m = new ReviewModel();
    	$tA = $m->getReviewLog(UID,1);
    	 
    	$this->assign('info',$tA);
    	$this->display();
    }
}