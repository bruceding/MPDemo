<?php

class TextMsg{

    const MESSAGE_TYPE = "text";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Content);
        $time = time();
        if(!empty( $keyword ))
        {
            $contentStr = '您发的文本已经收到';
            $this->send($contentStr, WEIXINID, $fromUsername);
        }
    }

    /**
     * send
     * 文本消息的发送
     * 
     * @param mixed $msg  消息内容 
     * @param mixed $wxid  开发者的微信号
     * @param mixed $openid  用户的openid
     * @access public
     * @return void
     */
    public function send($msg, $wxid, $openid) {
    
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";             
        $resultStr = sprintf($textTpl, $openid,  $wxid, time(), self::MESSAGE_TYPE, $msg);
        echo $resultStr;
    }
}
