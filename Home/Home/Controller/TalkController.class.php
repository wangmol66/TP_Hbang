<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\AnswerModel;
class TalkController extends InitController {
    public function index(){
    	$m = new AnswerModel();
    	
    	$tA = $m->getMyAnswerList(UID);
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    public function huitie(){
    	$m = new AnswerModel();
    	
    	$tA = $m->getMyReplyList(UID);
    	
    	$this->assign('info',$tA);
    	$this->display();
    }
}