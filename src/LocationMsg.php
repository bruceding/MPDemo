<?php

class LocationMsg{

    const MESSAGE_TYPE = "location";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->Label);
        $time = time();
        if(!empty( $keyword ))
        {
            $contentStr = "您发的地理位置消息已经收到,经度:{$postObj->Location_Y},纬度:{$postObj->Location_X},位置信息:{$keyword}" ;
            $textMsg =  MsgController::factory(MsgController::MESSAGE_TYPE_TEXT);
            $textMsg->send($contentStr, WEIXINID, $fromUsername);
        }
    }

}
