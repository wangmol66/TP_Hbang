<?php
/**
 * Created by PhpStorm.
 * User: maomao
 * Date: 2016/12/6
 * Time: 10:59
 */

namespace Home\Slike\WechatTempleat;


class WxTempleat extends WxCreateTempleat
{
    private $access_token=null;
    function __construct(){
        $this->access_token=self::file_access_token();//初始化 获取access_token
    }

    /**
     * 微信获取access_token
     * @return mixed
     */
    static public function file_access_token(){
    
    	$filepath="access_token.biu"; //Access_token 写入文件，
    
    	//echo $filepath;
    	##判断是否有accesstoken
    	if(file_exists($filepath) && false){
    		$data=parse_ini_file($filepath);
    		##判断是否过期
    		if($data['time']<=time()){
    			return self::get_access_token($filepath);
    		}
    		return $data['access_token'];
    	}
    	else{
    		return self::get_access_token($filepath);
    	}
    
    }
    
    /**
     * 获取access_token
     * @param unknown $filepath
     * @return unknown
     */
    static public function get_access_token($filepath){
    	$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
    	$res=file_get_contents($url);
    	$res=json_decode($res);
    	//$fp=fopen($filepath,"w");
    	//$text="[access_token]\r\naccess_token=".$res->access_token."\r\ntime=".(time()+$res->expires_in)."\r\nnowtime=".time();
    	//fwrite($fp,$text);
    	return $res->access_token;
    }
    
    
    /**
     * [setMsgTemplate 设置行业信息模板]
     */
    public function setMsgTemplate($id1,$id2){

        $url="https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=".$this->access_token;

        $param='{"industry_id1":"$id1","industry_id2":"$id2"}';

        $res=Wechat::curl_post_contents($url,$param);
        return $res;
    }

    /**
     * 获取模板信息
     * @return string
     */
    public function getMsgTemplate(){
        $url="https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=".$this->access_token;
        $res=file_get_contents($url);
        return $res;
    }

    /**
     * 获取微信模板列表
     * @return string
     */
    public function getMsgTemplateList(){
        $url="https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=".$this->access_token;
        $res=file_get_contents($url);
        return $res;
    }

    /**
     * 删除模板
     * @param $template_id
     * @return mixed
     */
    public function delMsgTemplate($template_id){
        $url="https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token=".$this->access_token;
        $param='{"template_id"="$template_id"}';
        $res=Wechat::curl_post_contents($url,$param);
        return $res;
    }

    /**
     * 发送模板信息
     * @param $template
     * @return mixed
     */
    public function sendMsgTemplate($template){
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$this->access_token;
        $res=self::curl_post_contents($url,$template);
        return $res;
    }

    /**
     *  curl POST 会话访问模式
     * @param $url
     * @param $arr
     * @return mixed
     */
    static public function curl_post_contents($url,$arr)
    {
    	$ch=curl_init();//初始化
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_URL, $url);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST,true);
    	curl_setopt($ch, CURLOPT_POSTFIELDS,$arr);
    	//    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    	$re=curl_exec($ch);//运行
    	curl_close($ch);
    
    	return $re;
    }
}