<?php

class LinkMsg{

    const MESSAGE_TYPE = "link";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Url);
        $time = time();
        if(!empty( $keyword ))
        {
            $contentStr = '您发的链接消息已经收到' . $postObj->Url;
            $textMsg =  MsgController::factory(MsgController::MESSAGE_TYPE_TEXT);
            $textMsg->send($contentStr, WEIXINID, $fromUsername);
        }
    }

}
