<?php
require ROOT_PATH . '/src/RuleController.php';

/**
 * TextMsg
 * 文本消息类
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class TextMsg {

    const MESSAGE_TYPE = "text";

    public function processMsg($postObj) {
    
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $content = trim($postObj->Content);
        $time = time();
        if(!empty( $content ))
        {
//            $contentStr = '您发的文本已经收到';
//            $this->send($contentStr, WEIXINID, $fromUsername);
//            $mediaID = 'vVIK447r1FMlJUovc09iYiAaDiyXBPpBZwYRqysGF2dcoYtigwQ9t-OTQjediU11';
//            $voiceMsg = MsgController::factory(MsgController::MESSAGE_TYPE_VOICE);
//            $voiceMsg->send($mediaID, WEIXINID, $fromUsername);
            
            // 先走自动回复，如果没有，默认回复一条图文消息
            $ruleController = new RuleController();
            if ($ruleController->autoReply($postObj)) {
                return true;
            }

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
     * responseMsg
     * 回复文本消息的发送
     * 
     * @param mixed $postObj  微信推送的消息结构体 
     * @param mixed $msg  回复消息内容 
     * @access public
     * @return void
     */
    public function responseMsg($postObj, $msg) {
    
        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <Content><![CDATA[%s]]></Content>
                    <FuncFlag>0</FuncFlag>
                    </xml>";             
        $resultStr = sprintf($textTpl, $postObj->FromUserName,  $postObj->ToUserName, time(), self::MESSAGE_TYPE, $msg);
        echo $resultStr;
    }
}
