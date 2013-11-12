<?php

class VoiceMsg{

    const MESSAGE_TYPE = "voice";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $mediaId = trim($postObj->MediaId);
        if(!empty( $mediaId ))
        {
            $this->responseMsg($postObj, $mediaId);
        }
    }

    public function responseMsg($postObj, $mediaId) {
    
        $tpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Voice>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Voice>
                    </xml>";             

        $resultStr = sprintf($tpl, $postObj->FromUserName,  $postObj->ToUserName, time(), self::MESSAGE_TYPE, $mediaId);
        echo $resultStr;
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
    public function send($mediaID, $wxid, $openid) {
    
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Voice>
                        <MediaId><![CDATA[%s]]></MediaId>
                    </Voice>
                    <FuncFlag>0</FuncFlag>
                    </xml>";             
        $resultStr = sprintf($textTpl, $openid,  $wxid, time(), self::MESSAGE_TYPE, $mediaID);
        echo $resultStr;
    }
}
