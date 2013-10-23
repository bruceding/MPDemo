<?php
require 'SigCheck.php';
require 'MsgController.php';

class MpApi{

    public function dealMsg() {

        // 如果是网址接入配置校验 
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['echostr']) {
            $check = new SigCheck();
            $check->valid();

        } else {
                
            $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

            if (!empty($postStr)){
                    
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $type = $postObj->MsgType;

                // 根据不同的消息类型初始化对象
                $instance = MsgController::factory($type);
                $instance->processMsg($postObj) ;
            }
        } 
    }
}
