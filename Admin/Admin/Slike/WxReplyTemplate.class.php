<?php
/**
 * Created by PhpStorm.
 * User: maomao
 * Date: 2016/12/20
 * Time: 15:09
 */

namespace Admin\Slike;


class WxReplyTemplate
{
    private $ToUserName         = null;     //接收方帐号（收到的OpenID）
    private $FromUserName       = null;     //开发者微信号
    private $MsgType            = null;     //news
    private $ArticleCount       = null;     //图文消息个数，限制为10条以内
    private $Artic              = array();  //信息数组

    public function SetUser($openid)
    {
        $this->ToUserName=$openid;
    }

    public function SetWeixin($weixin)
    {
        $this->FromUserName=$weixin;
    }

    public function SetMsgType($type)
    {
        $this->MsgType=$type;
    }

    public function SetArticCount($num)
    {
        $this->ArticleCount=$num;
    }

    public function SetArtic($arr)
    {
        $this->Artic=$arr;
    }

    public function GetReplyTemplate(){
        $picMsgTpl="<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <ArticleCount>%s</ArticleCount>
                            <Articles>";
        $picMsgTpl=sprintf($picMsgTpl,$this->ToUserName,$this->FromUserName,time(),$this->MsgType,$this->ArticleCount);

        foreach ($this->Artic as $k =>$item){
            $picMsgTpl.=$this->GetReplyItem($item['title'],$item['description'],$item['picurl'],$item['url']);
        }
        $picMsgTpl.="</Articles>
                    </xml>";

        return $picMsgTpl;
    }

    public function GetReplyItem($title,$description,$picurl,$url){

        $item='<item><Title><![CDATA[%s]]></Title>
                <Description><![CDATA[%s]]></Description>
                <PicUrl><![CDATA[%s]]></PicUrl>
                <Url><![CDATA[%s]]></Url>
                </item>';
        $item=sprintf($item,$title,$description,$description,$url);
        return $item;
    }
}