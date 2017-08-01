<?php
/**
 * Created by PhpStorm.
 * User: maomao
 * Date: 2016/11/29
 * Time: 14:19
 */

namespace Home\Slike\Wechat;


class Weixin
{
    public function get_openid()
    {
        if(empty($_SESSION['wechat'])){
            if(!empty($_REQUEST['wechat'])){
                $wechat=$_REQUEST['wechat'];
            }

            if(empty($wechat)){
            	$code=$this->get_wechat_code();//get_wechat_code code_to_host; //切换本地与线上授权
                $wechat=$this->get_oauth2_openid($code);
                $_SESSION['wechat']=$wechat;
                return $wechat;
            }
        }else{
            $wechat=$_SESSION['wechat'];
            $_SESSION['wechat']=$wechat;
            return $wechat;
        }
    }
    /**
     * @return mixed 获取code
     */
    public function code_to_host()
    {
        $host="http://dm.deepinfo.cn/hbang/index.php?s=/index/wechat.html";

        if(empty($_GET['code']))
        {
            $redirect_uri = urlencode($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            header("location:".$host."&url=".$redirect_uri); // URL参数名不能 redirect_uri 会与微信冲突
            exit();
        }
        else{
            return $_GET['code'];
        }
    }

    /**
     * 发送code到访问请求的地址
     * @param $code
     */
    public function send_code_self($code)
    {
        if(!empty($code)){
            //检查
            if(strstr($_REQUEST['url'],'?')){
                header("location:http://".$_REQUEST['url']."&code=".$code);
            }
            else{
                header("location:http://".$_REQUEST['url']."?code=".$code);
            }

        }
    }
    /**
     * [get_wechat_code 获取CODE中转]
     */
    public function get_wechat_code(){

        $filepath="code.biu";
        ##判断是否有accesstoken
        if(file_exists($filepath)){
            $data=parse_ini_file($filepath);
            //print_r($data);
            ##判断是否过期
            if($data['time']<=time()||true){

                //print_r('<script>console.info("重新获取了一次Code")</script>');
                return self::putCode($filepath);
            }
            return $data['code'];
        }
        else{
            return self::putCode($filepath);
        }
    }

    /**
     * 获取CODE 并且写入文件中
     * @param $filepath
     * @return mixed
     */
    public function putCode($filepath){
        $code=$this->get_oauth2_code();
        //$fp=fopen($filepath,"w");
        //$text="[code]\r\ncode=".$code."\r\ntime=".(time()+0)."\r\nnowtime=".date('Y-m-d H:i:s',time());
        //fwrite($fp,$text);
        return $code;
    }


    /**
     * 获取微信code
     */
    public function get_oauth2_code()
    {
        if(empty($_GET['code']))
        {
            $redirect_uri = urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
            $para = array(
                "appid"         => APPID,
                "redirect_uri"  => $redirect_uri,
                "response_type" => 'code',
                "scope"         => 'snsapi_userinfo',
                "state"         => '123#wechat_redirect'
            );
            //snsapi_base 无需点击授权
            //snsapi_userinfo 点击授权
            $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".APPID."&redirect_uri=".$para['redirect_uri']."&response_type=code&scope=".$para['scope']."&state=123#wechat_redirect";
            header("location:".$url);
            exit;
        }
        else{
            return $_GET['code'];
        }
    }

    /**
     * 获取微信openid
     * @param $code
     * @return string
     */
    public function get_oauth2_openid($code){

        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".APPID."&secret=".APPSECRET."&code=".$code."&grant_type=authorization_code";
        $rets =  $this->curl_get_contents($url);
        $ret_arr = json_decode($rets,true);
        if(!empty($ret_arr['openid'])){
            return  $ret_arr['openid'];
        }
        else{
            return 'null';
        }
    }

    /**
     * 获取用户信息
     * @param $wechatid 用户openid
     * @return mixed  返回用户信息
     */
    public function get_user_info($wechatid){

    	
        if(!empty($wechatid))
        {
            $access_token = $this->file_access_token();
            $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$wechatid";
            $res_json = $this->curl_get_contents($url);
            $w_user = json_decode($res_json,TRUE);
            $w_user['access_token']=$access_token;//设置token
            //抛出获取用户详细信息时的错误
            if(!empty($w_user['errcode']))
            {
            	
                if($w_user['errcode']== '40003')
                {
                	echo '<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">';
                	echo "ERROR:".$w_user['errmsg'];
                	exit();
                }
            }
            return $w_user;
        }
    }

    public function curl_get_contents($url){

        $ch=curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:26.0) Gecko/20100101 Firefox/26.0");
        curl_setopt($ch, CURLOPT_REFERER,$url);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $r = curl_exec($ch);
        curl_close($ch);
        return $r;
    }

    /**
     *  curl POST 会话访问模式
     * @param $url
     * @param $arr
     * @return mixed
     */
    public function curl_post_contents($url,$arr)
    {
        $ch=curl_init();//初始化
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$arr);
        $re=curl_exec($ch);//运行
        curl_close($ch);

        return $re;
    }


    /**
     * 微信获取access_token
     * @return mixed
     */
    public function file_access_token(){

        $filepath="access_token.biu"; //Access_token 写入文件，
        //echo $filepath;
        ##判断是否有accesstoken
        if(file_exists($filepath)){
            $data=parse_ini_file($filepath);
            ##判断是否过期
            if($data['time']<=time()){
                return $this->get_access_token($filepath);
            }
            return $data['access_token'];
        }
        else{
            return $this->get_access_token($filepath);
        }

    }

    public function get_access_token($filepath){
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
        $res=file_get_contents($url);
        $res=json_decode($res);
        //$fp=fopen($filepath,"w");
        //$text="[access_token]\r\naccess_token=".$res->access_token."\r\ntime=".(time()+3000)."\r\nnowtime=".time();
        //fwrite($fp,$text);
        return $res->access_token;
    }

    public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();
        //print_r($jsapiTicket);
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => APPID,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/data/access_token.json'));

        if ($data->expire_time < time()) {
            $accessToken = $this->new_access_token();
            //echo  $accessToken;
            // 如果是企业号用以下 URL 获取 ticket
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->curl_get_contents($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $fp = fopen($_SERVER['DOCUMENT_ROOT'].'/data/access_token.json', "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }

        return $ticket;
    }

    /**
     * [new_access_token 创建一个新的Access_token]
     * @return [type] [description]
     */
    public function new_access_token()
    {
        $appid = APPID;
        $appsecret = APPSECRET;
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
        $ret_json = $this->curl_get_contents($url);
        $ret = json_decode($ret_json);
        //print_r($ret->access_token);//调试输出CODE
        return $ret->access_token;
    }

    /**
     * 从微信服务器 下载资源
     * @param $media_id
     * @return string
     */
    public function downloadMEDIA($media_id,$path){

        if(!file_exists($path)){
            mkdir($path,0777);
        }

        $data=array();
        $url="http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=".$this->new_access_token()."&media_id=";
        foreach ($media_id as $k=>$v){
            $filename= time().'_'.$k;
            $Turl=$url.$v;
            $ch=curl_init($Turl);
            $filename=$path.'/'.$filename.'.jpg';
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
            $image=curl_exec($ch);
            if(empty($image)){
                break;
            }
            $tp=fopen($filename,'a');
            fwrite($tp,$image);
            fclose($tp);
            $data[$k]=$filename;
        }
        return $data;
    }
}