<?php
require ROOT_PATH . '/src/ZipCodeReplyTactic.php';

class LocationMsg{

    const MESSAGE_TYPE = "location";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $location = trim($postObj->Label);
        $time = time();
        if(!empty( $location ))
        {
            $zipcodeTactic = new ZipCodeReplyTactic();
            if (!$zipcodeTactic->reply($postObj)) {
                $contentStr = '很抱歉，没有找到邮政编码';
                Logger::debug("not find zipcode\t{$postObj->Label}");
                $textMsg =  MsgController::factory(MsgController::MESSAGE_TYPE_TEXT);
                $textMsg->responseMsg($postObj, $contentStr);
            }
        }
    }

}
