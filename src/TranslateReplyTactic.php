<?php
require ROOT_PATH . '/src/BaiDuTranslate.php';

/**
 * TranslateReplyTactic
 * 翻译的回复策略
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class TranslateReplyTactic {

    private $_rules;
    public function reply($postObj) {

        $rule = $this->matchRule($postObj);

        // 没找到规则，直接返回
        if (!$rule) { 
            return false;
        }

        return $this->sendReplyMsg($rule, $postObj);
    }

    /**
     * matchRule 
     * 查找匹配规则
     * 
     * @param mixed $postObj 
     * @access public
     * @return void
     */
    public function matchRule($postObj) {

        $content = $postObj->Content;
        
        if (strpos($content, '#') === 0) {
            $translate = new BaiDuTranslate();
            return $translate->translate(substr($content, 1));
        }

        return false;

    }

    public function getRules() {

        // WEIXINID:config配置里的，当前商家的微信ID
        $config = new RuleConfig(WEIXINID); 

        $this->_rules = $config->readConfig();

        return $this->_rules;
    }

    /**
     * sendReplyMsg 
     * 根据翻译结果进行回复消息
     * 文本消息回复
     * 
     * @param mixed $rule 
     * @param mixed $postObj 
     * @access public
     * @return void
     */
    public function sendReplyMsg($rule, $postObj) {

        $msgType = 'text';
        // 具体的消息发送
        $msgClass = MsgController::factory($msgType);
        if ($msgClass) {
            $msgClass->responseMsg($postObj, $rule);
            return true;
        }
        return false;
    }
}
