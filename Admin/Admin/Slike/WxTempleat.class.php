<?php
/**
 * Created by PhpStorm.
 * User: maomao
 * Date: 2016/12/6
 * Time: 10:59
 */

namespace Admin\Slike;


class WxTempleat
{
    //const APPID="wxa4334ebbae27aa0b";
    //const APPSERCET="ba93e3d3a312d2cc4762ff5cba8f661d";
    private $access_token=null;
    function __construct(){
        $this->access_token=Wechat::file_access_token();//初始化 获取access_token
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
        $res=Wechat::curl_post_contents($url,$template);
        return $res;
    }

}