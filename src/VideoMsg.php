<?php

class VideoMsg{

    const MESSAGE_TYPE = "video";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $mediaId = trim($postObj->MediaId);
        $thumbMediaId = trim($postObj->ThumbMediaId); // 缩略图
        if(!empty( $mediaId ))
        {
            $this->responseMsg($postObj, $mediaId, $thumbMediaId);
        }
    }

    /**
     * responseMsg
     * 回复视频消息的发送
     * 
     * @param mixed $postObj  
     * @param mixed $mediaId  视频内容
     * @param mixed $thumbMediaId  视频缩略图内容
     * @access public
     * @return void
     */
    public function responseMsg($postObj, $mediaId, $thumbMediaId) {
    
        $tpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Video>
                    <MediaId><![CDATA[%s]]></MediaId>
                    <ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
                    </Video> 
                    </xml>";             
        $resultStr = sprintf($tpl, $postObj->FromUserName,  $postObj->ToUserName, time(), self::MESSAGE_TYPE, $mediaId, $thumbMediaId);
        echo $resultStr;
    }
}
