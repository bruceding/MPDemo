<?php

class EventMsg{


    public function processMsg($postObj) {

        // 用户的openid，在同一应用下，可以作为用户的唯一标识
        $fromUsername = $postObj->FromUserName; 
        $toUsername = $postObj->ToUserName;

        // 事件类型：订阅，取消订阅，自定义菜单点击等。
        $event = trim($postObj->Event);

        // 不同的事件，调用不同的处理函数
        call_user_func_array(array("EventMsg", $event), array($fromUsername));
    }

    private function subscribe($openid) {

        // 在这里我们记录用户
        // 这里我省略处理...

        // 当用户关注我们的时候，我们可以发送一条关注消息
        $textMsg = MsgController::factory(MsgController::MESSAGE_TYPE_TEXT);

        $msg = '感谢你的关注';
        $textMsg->send($msg, WEIXINID, $openid);
    }

    private function unsubscribe($openid) {

       // 处理用户取消关系
   }
}
