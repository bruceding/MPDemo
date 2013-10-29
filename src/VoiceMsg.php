<?php

class VoiceMsg{

    const MESSAGE_TYPE = "voice";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->MediaId);
        $time = time();
        if(!empty( $keyword ))
        {
            file_put_contents(ROOT_PATH . '/data.log', $keyword . "\t" . $postObj->Format . PHP_EOL, FILE_APPEND);
            //$contentStr = '您发的文本已经收到';
            //$this->send($contentStr, WEIXINID, $fromUsername);
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
