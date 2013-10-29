<?php

class ImageMsg{

    const MESSAGE_TYPE = "image";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $keyword = trim($postObj->PicUrl);
        $time = time();
        if(!empty( $keyword ))
        {
            $contentStr = '您发的图片消息已经收到';
            //$picurl = 'https://mp.weixin.qq.com/cgi-bin/getqrcode?fakeid=2391036540&token=2061340161&style=1';
            $textMsg =  MsgController::factory(MsgController::MESSAGE_TYPE_TEXT);
            $textMsg->send($contentStr, WEIXINID, $fromUsername);
        }
    }

}
