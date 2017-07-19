<?php

namespace Common\Library;

/**
 * 微信公众号接口
 * user:whb
 * time:2015-03-25 16:20
 */
class WeixinCommon{

    /**
     * 获取 ACCESS_TOKEN
     * $appid：appid
     * $appsecret：appsecret
     */
    function getAccessToken($appid, $appsecret)
    {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode(file_get_contents(ROOT_PATH . "includes/jssdk/access_token.json"));
        if ($data->expire_time < time()) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";
            $output=$this->getDataCurl($url);
            if(!$output){
                return false;
            }
            $arr=json_decode($output,true);
            if(isset($arr['access_token'])){
                $access_token = $arr['access_token'];
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen(ROOT_PATH . "includes/jssdk/access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }else{
                return false;
            }
        } else {
            $access_token = $data->access_token;
        }
        return $access_token;
    }

    /**
     * 通过appid，appsecret和code获取 ACCESS_TOKEN
     * 网页授权获取ACCESS_TOKEN
     */
    function getAccessTokenByCode($appid,$appsecret,$code){
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";
        $output=$this->getDataCurl($url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['access_token'])){
            return $arr;
        }else{
            return false;
        }
    }

    /**
     * 通过appid，refresh_token获取 ACCESS_TOKEN
     * 刷新ACCESS_TOKEN
     */
    function getAccessTokenByRefresh($appid,$refresh_token){
        $url = "https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=$appid&grant_type=refresh_token&refresh_token=$refresh_token";
        $output=$this->getDataCurl($url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['access_token'])){
            return $arr;
        }else{
            return false;
        }
    }

    /**
     * 网页授权
     * url：需要跳转的完整路径
     * appid：微信的appid
     * type：授权方式：snsapi_base（不弹出授权页面），snsapi_userinfo
     */
    function oauth($url,$appid,$type){
        $url=urlencode($url);//（授权成功后跳转）
        $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$url&response_type=code&scope=$type&state=123#wechat_redirect";
        return $url;
    }

    /**
     * 创建微信菜单
     */
    function createMenu($access_token,$data){
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $output=$this->postDataCurl($data,$url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['errcode'])){
            return ($arr['errcode']=='0');
        }else{
            return false;
        }
    }

    /**
     * 网页授权拉取用户信息
     * $access_token：access_token（网页授权access_token）
     * $openid：微信用户openid
     */
    function getUserInfo($access_token,$openid){
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid&lang=zh_CN";
        $output=$this->getDataCurl($url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr)&& !empty($arr)){
            return $arr;
        }else{
            return false;
        }
    }

    /**
     * 获取用户基本信息
     * $access_token：access_token（基础access_token）
     * $openid：微信用户openid
     */
    function getUserInfoByOpenid($access_token,$openid){
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$access_token.'&pagesize=10&pageidx=0&openid='.$openid.'&lang=zh_CN';
        $output=$this->getDataCurl($url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr)&& !empty($arr)){
            return $arr;
        }else{
            return false;
        }
    }

    /**
     * 获取所有用户openid
     * $access_token：access_token
     */
    function getAllOpenid($access_token,$next_openid=''){
        $next='';
        if($next_openid!=''){
            $next="&next_openid=$next_openid";
        }
        $url='https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$access_token.$next;
        $output=$this->getDataCurl($url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['total'])&&$arr['total']>'0'){
            return $arr;
        }else{
            return false;
        }
    }

    /**
     * 上传多媒体文件，获取thumb_media_id
     * $access_token：access_token
     * $mediapath：文件地址路径
     * $type：上传多媒体类型（image，voice，video，thumb）
     */
    function getThumbMediaId($access_token,$mediapath,$type){
        $filedata=array('media'=>"@".$mediapath);
        $url="http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=$type";
        $output=$this->postDataCurl($filedata,$url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['media_id'])){
            return $arr['media_id'];
        }else{
            return false;
        }
    }

    /**
     * 下载多媒体文件
     * $access_token：access_token
     * $media_id
     * $type：上传多媒体类型（image，voice，video，thumb）
     */
    function getMedia($access_token,$media_id){
        $url = "http://file.api.weixin.qq.com/cgi-bin/media/get?access_token=$access_token&media_id=$media_id";

        $output=$this->getDataCurl($url);

        if(!$output){
            return false;
        }
        if(!empty($output)){
            return $output;
        }else{
            return false;
        }
    }

    /**
     * 上传视频，获取media_id
     * $access_token：access_token
     * $articlesdata：素材data
     */
    function getVideoMediaId($access_token,$videodata){
        $url="https://file.api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=$access_token";
        $output=$this->postDataCurl($videodata,$url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['media_id'])){
            return $arr['media_id'];
        }else{
            return false;
        }
    }

    /**
     * 上传图文消息素材，获取media_id
     * $access_token：access_token
     * $articlesdata：素材data
     */
    function getMediaId($access_token,$articlesdata){
        $url="https://api.weixin.qq.com/cgi-bin/media/uploadnews?access_token=$access_token";
        $output=$this->postDataCurl($articlesdata,$url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['media_id'])){
            return $arr['media_id'];
        }else{
            return false;
        }
    }

    /**
     * 根据分组进行群发
     * $access_token：access_token
     * $contentdata：群发内容
     */
    function sendAll($access_token,$contentdata){
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$access_token";
        $output=$this->postDataCurl($contentdata,$url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['errcode'])&&$arr['errcode']=='0'){
            return true;//发送成功
        }else{
            return false;
        }
    }

    /**
     * 根据OpenID列表群发
     * $access_token：access_token
     * $contentdata：群发内容
     */
    function sendMsg($access_token,$contentdata){
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$access_token";
        $output=$this->postDataCurl($contentdata,$url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['errcode'])&&$arr['errcode']=='0'){
            return true;//发送成功
        }else{
            return false;
        }
    }

    /**
     * 发送客服消息
     * $access_token：access_token
     * $contentdata：发送内容
     */
    function sendCustom($access_token,$contentdata){
        $url="https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$access_token";
        $output=$this->postDataCurl($contentdata,$url);
        if(!$output){
            return false;
        }
        $arr=json_decode($output,true);
        if(isset($arr['errcode'])&&$arr['errcode']=='0'){
            return true;//发送成功
        }else{
            return false;
        }
    }

    /**
     * 作用：以get方式从对应的接口url获取数据
     */
    function getDataCurl($url,$second=30){
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true) ;
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        $data = curl_exec($ch);
        curl_close($ch);

        if($data){
            return $data;
        }else{
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error"."<br>";
            echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
            return false;
        }
    }

    /**
     * 	作用：以post方式提交数据（xml或json等）到对应的接口url
     */
    function postDataCurl($postdata,$url,$second=30)
    {
        //初始化curl
        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        //运行curl
        $data = curl_exec($ch);
        curl_close($ch);
        //返回结果
        if($data)
        {
            return $data;
        }
        else
        {
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error"."<br>";
            echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
            return false;
        }
    }
}