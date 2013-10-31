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
//            $contentStr = '您发的文本已经收到';
//            $this->send($contentStr, WEIXINID, $fromUsername);
//            $mediaID = 'vVIK447r1FMlJUovc09iYiAaDiyXBPpBZwYRqysGF2dcoYtigwQ9t-OTQjediU11';
//            $voiceMsg = MsgController::factory(MsgController::MESSAGE_TYPE_VOICE);
//            $voiceMsg->send($mediaID, WEIXINID, $fromUsername);
            $newsMsg = MsgController::factory(MsgController::MESSAGE_TYPE_NEWS);
            $news = array();
            $news['articleCount'] = 1;
            $new = array();
            $new['title'] = '测试图文消息';
            $new['description'] = '这是一个测试';
            $new['picUrl'] = 'http://p.qpic.cn/ecc_merchant/0/P_idc1321596_1382500696281/0';
            $new['url'] = 'http://www.google.com'; 
            $news['news'][] = $new;
            $newsMsg->responseMsg($postObj, $news);
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
