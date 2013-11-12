<?php

class ImageMsg{

    const MESSAGE_TYPE = "image";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $picUrl = trim($postObj->PicUrl);
        if(!empty( $picUrl ))
        {
            $this->responseMsg($postObj, $postObj->MediaId); 
        }
    }


    public function responseMsg($postObj, $mediaId) {
    
        $tpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                    </Image>
                    </xml>";             

        $resultStr = sprintf($tpl, $postObj->FromUserName,  $postObj->ToUserName, time(), self::MESSAGE_TYPE, $mediaId);
        echo $resultStr;
    }

}
