<?php


namespace Home\Controller;
use Home\Model\UserModel;
use Think\Controller;
use Home\Slike\WechatTempleat\WxTempleat;
use Home\Slike\Vhall\Vhall;
use Home\Slike\Wechat\Weixin;
use Home\Model\HelperModel;

class FollowController extends Controller {
	const PATH = 'Follow';

	/**
	 * 关注消息输出
	 * 关注时,写出文件 run.ini
	 */
	public function index(){

		$id = I('post.id');
		$time = I('post.time');
		$tempTime = strtotime($time)-time();


		//创建文件
		if(!file_exists(self::PATH)){
			mkdir(self::PATH,0777,true);
		}

		//获取用户信息
		if(!$_SESSION['wechat']){
			$this->error('关注失败');
		}
		$um = new UserModel();
		$user = $um->where(array('openid'=>$_SESSION['wechat']))->find();//获取用户信息

		//检测是否关注过
		if($this->hasFollow($user['uid'].'_'.$id)){
			$this->error('已经关注过');
		}

		//写出文件
		$text ='['.$user['uid'].'_'.$id.']'.PHP_EOL.
		'UID = '.$user['uid'].PHP_EOL.
		'WEBINAR_ID = '.$id.PHP_EOL.
		'TIME = '.strtotime($time).PHP_EOL.
		'nickname = '.$user['nickname'].PHP_EOL.
		'openid = '.$user['openid'].PHP_EOL.
		'send_time = '.$time.PHP_EOL.PHP_EOL;


		$file = fopen(self::PATH.'\run.ini', 'a'); //打开文件 写入方式

		if(fwrite($file, $text) === FALSE){
			fclose($file);
			$this->error('网络繁忙请稍后重试');
		}

		fclose($file);
		$this->success('关注成功');
	}

	/**
	 * 是否已经关注过
	 */
	public function hasFollow($key = ''){
		//获取配置项
		$info = parse_ini_file(self::PATH.'\run.ini',true);
		if(array_key_exists($key, $info)){
			return TRUE;
		}
		return FALSE;
	}


	/**
	 * 定时任务调用方法
	 * 采用系统定时 每5分钟 运行一次脚本。检测文件是否需要执行
	 * 定时脚本：G:\xampp56\php\php.exe -q G:\xampp56\htdocs\hbang\follow\run.php
	 */
	public function run(){

		//创建文件
		if(!file_exists(self::PATH.'/log')){
			mkdir(self::PATH.'/log',0777,true);
		}

		$file_log = fopen(self::PATH.'\log\\'.date('Ymd').'.txt','a'); //打开文件 写入方式

		$res1 = fwrite($file_log, '['.date('Y-m-d H:i:s').']:'.'开始执行一次计划任务...'.PHP_EOL);

		//获取配置项
		$info = parse_ini_file(self::PATH.'\run.ini',true);

		$tData = array();
		//检测条件,执行任务
		foreach ($info as $k =>$v){
				
			if(time()>=$v['TIME']){
				//执行代码

				$this->sendTempleat($v['openid'],$v['WEBINAR_ID']); //发送模板

				$tData[] = $info[$k];

				//删除该行
				unset($info[$k]);
			}
		}

		//重新组织数据写入配置文件
		$text = $this->putIni($info);
		//打开文件 写入方式
		$file = fopen(self::PATH.'\run.ini', 'w');
		fwrite($file, $text);
		fclose($file);


		$res2 = fwrite($file_log,json_encode($tData).PHP_EOL.PHP_EOL);
		fclose($file_log);
		echo json_encode($tData);//输出执行了那些
	}


	public function test(){
		echo '测试函数!如果该函数能访问，就没有问题';
	}

	/**
	 * 测试模板消息发送
	 */
	public function sendTempleat($OPENID,$WEBINAR_ID){

		//获取直播标题
		$vh = new Vhall();
		$info = $vh->getWebinarFetch($WEBINAR_ID,'subject,t_start');
		$info = json_decode($info);

		//获取会员名称
		$we = new Weixin();
		$user = $we->get_user_info($OPENID);

		//获取消息模板
		$temp = new WxTempleat();
		$temp->SetParam('first', '您关注的直播即将开始');
		$temp->SetParam('keyword1', $user['nickname']);
		$temp->SetParam('keyword2', $info->data->subject);
		$temp->SetParam('keyword3', date('Y年m月d日 H:i',strtotime($info->data->t_start)));
		$temp->SetParam('keyword4', '微信线上直播');
		$temp->SetParam('remark', '点击本消息可进入直播！');

		$temp->SetOpenid($OPENID);
		$temp->SetUrl('http://e.vhall.com/'.$WEBINAR_ID);//设置跳转URL
		$temp->SetTemplateId('G2Qonub3XX18dEjOmz94DvEERml6xPXAQcPnUQhKsZ8');

		$template = $temp->GetTemplate();
		$res = $temp->sendMsgTemplate($template);//发送模板
		//print_r($res);
	}

	/**
	 * 删除数据重新写入
	 * @param array $data
	 * @return string
	 */
	private function putIni($data = array()){
		$text = '';
		foreach ($data as $k => $v){
			$text .= '['.$k.']'.PHP_EOL;
			foreach ($v as $kk => $vv){
				$text .=$kk.' = '.$vv.PHP_EOL;
			}
		}

		return $text;
	}

	/**+-------------------------------------------------------------------------
	 * |		定时抽奖任务执行
	 * +-------------------------------------------------------------------------
	 * |
	 * +-------------------------------------------------------------------------
	 */
	/**
	 * 定时任务调用方法
	 * 采用系统定时 每5分钟 运行一次脚本。检测文件是否需要执行
	 * 定时脚本：G:\xampp56\php\php.exe -q G:\xampp56\htdocs\hbang\follow\run.php
	 */
	public function helper_run(){

		$PATH = 'Follow';
		//创建文件
		if(!file_exists($PATH.'/log')){
			mkdir($PATH.'/log',0777,true);
		}
	
		$file_log = fopen($PATH.'\log\\helper_'.date('Ymd').'.txt','a'); //打开文件 写入方式
	
		$res1 = fwrite($file_log, '['.date('Y-m-d H:i:s').']:'.'开始进行抽奖...'.PHP_EOL);
	
		//获取配置项
		$info = parse_ini_file($PATH.'\helper.ini',true);
	
		$tData = array();
	
		$m = new HelperModel();
	
		//检测条件,执行任务
		foreach ($info as $k =>$v){
	
			if(time()>=$v['TIME']){
				//执行代码
	
				$res = $m->LuckDraw($k);
				$res['number'] = urlencode('第一次执行=>'.$k);
				
				if(!$res['status']){
					$res['child'] = $m->LuckDraw($k);// 如果第一次执行失败 尝试第二次
					$res['child']['number'] = urlencode('第二次执行');
					$res['status'] = $res['child']['status'];
					
				}
				
				$tData[] = $info[$k];//执行了的任务
	
				//删除该行
				if($res['status']){
					//执行成功才删除，不然就留着下次继续执行
					unset($info[$k]);//删除执行了的任务
					$res['msg'] = urlencode($res['msg']);
				}
			}
		}
	
		//重新组织数据写入配置文件
		$text = $this->putIni($info);
		//打开文件 写入方式
		$file = fopen($PATH.'\helper.ini', 'w');
		fwrite($file, $text);
		fclose($file);
	
	
		$res2 = fwrite($file_log,json_encode($tData).PHP_EOL.urldecode(json_encode($res)).PHP_EOL.PHP_EOL);
		fclose($file_log);
		echo json_encode($res);//输出执行了那些
	}
}