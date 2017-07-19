<?php
namespace Home\Controller;
use Home\Init\InitController;
use Home\Model\HelperModel;
use Youzl\Youzl\YouzlPHP;
use Home\Slike\WechatTempleat\WxTempleat;
use Home\Slike\WechatTempleat\WxCreateTempleat;
use Home\Model\UserModel;
class HelperController extends InitController {
	
	/**
	 * 我要开会首页
	 */
    public function index(){
    	$m = new HelperModel();
    	$tA = $m->where(array('user_id'=>UID))->order('id desc')->select();
    	
    	//print_r($tA);
    	
    	$this->assign('list',$tA);
    	$this->display();
    }
    
    /**
     * 获取详情
     */
    public function info(){
    	$id = I('get.id');
    	
    	$m = new HelperModel();
    	$tA = $m->where(array('id'=>$id,'user_id'=>UID))->find();
    	$answer = json_decode($tA['answer'],true);
    	$true = json_decode($tA['true'],true);
    	
    	$str = '';
    	foreach ($answer as $k=>$v){
    		if(in_array($k, $true)){
    			$str .=($k+1).'.'.$v.',';
    		}
    	}
    	
    	$tA['str'] = substr($str,0,-1);
    	
    	//获取加入会议的会员
    	$tJoin = M($m->tbHelperJoin)
    	->alias('a')
    	->field('a.id,b.nickname,b.headimgurl,a.addtime,is_prize')
    	->where(array('helper_id'=>$id))
    	->join('wechat_user b on a.user_id = b.uid','LEFT')
    	->select();
    	
    	//print_r($tJoin);
    	
		//生成二维码
    	//路径
    	$path = "uploads/erweima/";
    	//生成的文件名
    	$fileName = $path.$id.'.png';
    	
    	if(!file_exists($path)){
    		mkdir($path,0777,true);
    	}
    	
    	//如果文件不存在
    	if(!file_exists($fileName)){
			//加载插件
	    	YouzlPHP::vendor('PHPqrcode/phpqrcode');
	    	
	    	$ewmurl ='http://'.$_SERVER['HTTP_HOST'].U('Helper/join/id/'.$id);
	    	\QRcode::png($ewmurl, $fileName, 'L', 8);
    	}
    	//echo $fileName;
    	$this->assign('ewmurl',$fileName);
    	$this->assign('info',$tA);
    	$this->assign('join',$tJoin);
    	$this->display();
    }
    
    /**
     * 加入会议
     */
    public function join(){
    	$id = I('get.id');
		//echo UID;
    	if(UID){
    		$um = new UserModel();
    		$user = $um->where(array('uid'=>UID))->find();
    		if(!$user['subscribe']){
    			//未关注的同学，先关注之后才加入
    			echo '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
    			echo "<script>alert('请关注华邦制药后参加会议');</script>";
    			$this->display();
    		}else{
    			$mm = new HelperModel();
    			$tA = $mm->where(array('id'=>$id))->find();
    			$m = M($mm->tbHelperJoin);
    			
    			if($tA['user_id'] == UID){
    				echo '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
    				echo "<script>alert('你已经在会议中');</script>";
    				exit();
    			}
    			
    			//查询是否已经加入
    			$tJoin = $m->where(array('helper_id'=>$id,'user_id'=>UID))->find();
    			if($tJoin){
    				echo '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
    				echo "<script>alert('你已经在会议中');</script>";
    				exit();
    			}
    			
    			
    			//加入记录
    			$data['helper_id'] = $id;
    			$data['user_id'] = UID;
    			$data['is_prize'] = 0;
    			$data['addtime'] = time();
    			$tId = $m->add($data);
    			
    			if(!$tId){
    				echo '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
    				echo "<script>alert('加入会议失败,重新试试');</script>";
    				exit();
    			}
    			
    			//关注的同学
    			echo '<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">';
    			echo "<script>alert('加入会议成功!');</script>";
    		}
    	}else{
    		echo '你没有账户';
    	}
    	
    }
    
    /**
     * 增加会议
     */
    public function add(){
    	$this->display();
    }
    
    /**
     * 增加会议
     */
    public function fabuAjax(){
    	/*获取数据*/
    	$title = I('post.title');
    	$address = I('post.address');
    	$content = I('post.content');
    	$isQuestion = I('post.isquestion');
    	$question = I('post.question');
    	
    	$answer = I('post.answer');
    	
    	//获取答案
    	$true = explode(',', I('post.true'));
    	

    	
    	$prize = I('post.prize');
    	
    	/*验证*/
    	if(!$title || !$address || !$content){
    		$this->error('数据不能为空');
    	}
    	
    	if($isQuestion){
    		
    		if(!$question){
    			$this->error('请填写问题');
    		}
    		
	    	if($prize> 0 && !is_numeric($prize)){
	    		$this->error('奖励应填数字');
	    	}
	   
	    	$tAnswer = implode(',',$answer);
	    	if(empty($tAnswer)){
	    		$this->error('选项为空');
	    	}
	    	//print_r($true);
	    	$tTrue = implode(',',$true);
	    	if(empty($tTrue)){
	    		$this->error('正确答案错误');
	    	}
	    	
	    	$temp = array();
	    	foreach ($true as $k=>$v){
	    		if($v){
	    			$temp[] = $v-1;
	    		}
	    	}
	    	$true = $temp;
    	}

    	
    	//插入数据
    	$m=new HelperModel();
    	
    	$data = array(
    			'user_id'=>UID,
    			'title'=>$title,
    			'address'=>$address,
    			'content'=>$content,
    			'question'=>$question,
    			'is_question'=>$isQuestion,
    			'answer'=>json_encode($answer),
    			'true'=>json_encode($true),
    			'prize'=>$prize,
    			'winners'=>0,
    			'is_luckdraw'=>0,
    			'addtime'=>time(),
    			'status'=>1,
    	);
    	
    	$tId = $m->add($data);
    	if(!$tId){
    		$this->error('保存失败');
    	}
    	
    	$this->success('保存成功');
    }
    
    /**
     * 结束会议
     */
    public function overAjax(){
    	$id = I('post.id');
    	$m = new HelperModel();
    	
    	//结束会议
    	$query = $m->where(array('id'=>$id))->save(array('status'=>2));
    	if($query === false){
    		$this->error('保存失败');
    	}
    	
    	//获取用户
    	$tJoin = M($m->tbHelperJoin)->where(array('helper_id'=>$id))->select();
    	
    	$tUid = array();
    	foreach ($tJoin as $k=>$v){
    		if(!in_array($v['user_id'], $tUid)){
    			$tUid[] = $v['user_id'];
    		}
    	}

    	$um = new UserModel();
    	$tUser = $um->getUserByIds($tUid);
    	
    	foreach ($tUser as $k=>$v){
    		//发送通知
    		if($v['openid']){
	    		$this->msg($v['openid'],$id);
    		}
    	}
    	
    	$this->timing($id); //设置定时任务
    	
    	$this->success('保存成功',U('Helper/info/id/'.$id));
    }
    
    /**
     * 发送消息
     */
    public function msg($openId,$id){
    	$wx = new WxCreateTempleat();
    	$msg = new WxTempleat();
    	
    	//获取会议信息
    	$m = new HelperModel();
    	$tA = $m->where(array('id'=>$id))->find();
    	
    	//微信信息模板
    	$wx->SetParam('first','您有一门会议问答卷感觉参加吧');
    	$wx->SetParam('keyword1',$tA['title']);
    	$wx->SetParam('keyword2',date('Y-m-d H:i',$tA['addtime']));
    	$wx->SetParam('keyword3',$tA['address']);
    	$wx->SetParam('keyword4',$tA['content']);
    	$wx->SetParam('remark','点击参加会议考题,有大奖哦!');
    	
    	$wx->SetOpenid($openId);
    	$wx->SetUrl('http://'.$_SERVER['HTTP_HOST'].U('Helper/question/id/'.$id));
    	$wx->SetTemplateId('yGbAhbd1NvnEShQ-sJbLlBBq1Cdyn0XeD93Rg3rxXwM');
    	
    	$template = $wx->GetTemplate();
    	$status = json_decode($msg->sendMsgTemplate($template),true);
    	
    	$um = new UserModel();
    	$tUser = $um->where(array('openid'=>$openId))->find();
    	//print_r($tUser);
    	if($status['errmsg'] == 'ok'){
    		M($m->tbHelperJoin)->where(array('user_id'=>$tUser['uid'],'helper_id'=>$id))->save(array('status'=>1));
    	}
    }
    /**
     * 考题
     */
    public function question(){
    	$id = I('get.id'); //获取会议ID
    	$m = new HelperModel();
    	
    	$tA = $m->where(array('id'=>$id))->find();
    	$tA['answer'] = json_decode($tA['answer'],true);
    	$tA['true'] = json_decode($tA['true'],true);
    	
    	//$tA = M($m->tbHelperJoin)->where(array('user_id'=>UID,'helper_id'=>$id))->find();
    	//print_r($tA);
    	$this->assign('info',$tA);
    	$this->display();
    }
    
    /**
     * 提交问题
     */
    public function submitQuestion(){
    	//获取参数
    	$id = I('post.id');
    	$answer = I('post.answer');
    	
    	//加载
    	$m = new HelperModel();
    	
    	//获取信息
    	$where['id'] = $id;
    	$tA = $m->where($where)->find();
    	
    	//获取正确答案
    	$true = json_decode($tA['true'],true);
    	
    	//验证正确答案是否全对
    	$status = 2;
    	foreach ($true as $k=>$v){
    		if(!in_array($v, $answer)){
    			$status = 3;//不全对
    		}
    	}
    	
    	$where = array();
    	$where['user_id'] = UID;
    	$where['helper_id'] = $id;
    	$where['status'] = 1; //推送状态
    	$query = M($m->tbHelperJoin)->where($where)->save(array('status'=>$status,'user_answer'=>json_encode($answer)));
    	//print_r(M($m->tbHelperJoin)->getLastSql());
    	if($query === false || $query<=0){
    		$this->error('提交错误');
    	}
    	
    	$this->success('提交成功',U('helper/index'));
    	
    }
    
    /**
     * 会议结束，写出文件定时任务信息
     */
    
    public function timing($helperId){
    	$PATH = 'Follow';
    	//创建文件
    	if(!file_exists($PATH)){
    		mkdir($PATH,0777,true);
    	}
    	
    	//写出文件
    	$text ='['.$helperId.']'.PHP_EOL.
    	'TIME = '.(time()+5*60).PHP_EOL.    //5分钟
    	'send_time = '.date('Y-m-d H:i:s',(time()+5*60)).PHP_EOL.PHP_EOL;
    	
    	$file = fopen($PATH.'\helper.ini', 'a'); //打开文件 写入方式
    	
    	if(fwrite($file, $text) === FALSE){
    		fclose($file);
    		return false;
    	}
    	
    	fclose($file);
    	return true;
    }
    
}