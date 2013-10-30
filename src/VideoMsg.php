<?php

class VideoMsg{

    const MESSAGE_TYPE = "video";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->MediaId);
        $thumbMediaId = trim($postObj->ThumbMediaId); // 缩略图
        $time = time();
        if(!empty( $keyword ))
        {
            //file_put_contents(ROOT_PATH . '/data.log', $keyword . "\t" . $postObj->Format . PHP_EOL, FILE_APPEND);
            $this->send('', '', $postObj);
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
    public function send($mediaId, $thumbMediaId,  $postObj) {
    
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Video>
                    <MediaId><![CDATA[%s]]></MediaId>
                    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                    </Video> 
                    </xml>";             
        $resultStr = sprintf($textTpl, $postObj->FromUserName,  $postObj->ToUserName, time(), self::MESSAGE_TYPE, $postObj->MediaId, $postObj->ThumbMediaId);
        echo $resultStr;
    }
}
