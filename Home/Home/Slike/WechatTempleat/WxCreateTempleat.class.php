<?php
/**
 * 微信消息模板类
 * User: Rable
 * Date: 2016/12/6
 * Time: 11:22
 */

namespace Home\Slike\WechatTempleat;


class WxCreateTempleat
{
    private $value=array();     //值数组
    private $openid=null;       //openid
    private $templateid=null;   //模板ID
    private $url=null;          //跳转URL
    /**
     * [SetOpenid description]
     * @param [type] $val [description]
     */
    public function SetUrl($val){
        $this->url=$val;
    }

    /**
     * @param $val
     * @return null
     */
    public function GetUrl($val){
        return $this->url;
    }



    /**
     * [SetOpenid description]
     * @param [type] $val [description]
     */
    public function SetTemplateId($val){
        $this->templateid=$val;
    }

    /**
     * @param $val
     * @return null
     */
    public function GetTemplateId($val){
        return $this->templateid;
    }




    /**
     * [SetOpenid description]
     * @param [type] $val [description]
     */
    public function SetOpenid($val){
        $this->openid=$val;
    }

    /**
     * @param $val
     * @return null
     */
    public function GetOpenid($val){
        return $this->openid;
    }

    /**
     * [setParam description]
     * @param [type] $param [description]
     * @param [type] $value [description]
     */
    public function SetParam($param,$value){
        $this->value[$param]=$value;
    }

    /**
     * [getValue description]
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function GetValue($param){
        return $this->value[$param];
    }

    /**
     * @return array
     */
    public function GetArray(){
        return $this->value;
    }


    /**
     * 判断签名，详见签名生成算法是否存在
     * @return true 或 false
     **/
    public function IsParamSet($param)
    {
        return array_key_exists($param, $this->value);
    }

    /**
     * 获取模板参数信息
     * [GetTemplate description]
     */
    public function GetTemplate(){
        $param='{
                   "touser":"'.$this->openid.'",
                   "template_id":"'.$this->templateid.'",
                   "url":"'.$this->url.'",
                   "data":'.$this->get_Template_Param().'}}';

        return $param;
    }

    /**
     * Value 生成模板参数
     * @return string
     */
    private function get_Template_Param(){
        $json='{';
        foreach ($this->value as $key => $value) {
            $json.='"'.$key.'":{"value":"'.$value.'","color":"#137177"},';
        }
        $json=substr($json,0,-1);//截取调末尾的,号
        return $json;
    }
}