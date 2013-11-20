<?php
require ROOT_PATH . '/src/RuleConfig.php';

/**
 * ConfigReplyTactic
 * 基于配置的回复策略
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class ConfigReplyTactic {

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
        
        $rules = $this->getRules;

        foreach ($rules['rules'] as $rule) {

            if ($rule['type'] == Rule::TYPE_EXACT_MATCH) {

                // 如果是精确匹配
                if ($content == $rule['keyword']) {
                    return $rule;
                } 
            } else if ($rule['type'] == Rule::TYPE_FUZZY_MATCH) {
            
                // 如果是模糊匹配
                if (strpos($content, $rule['keyword']) !== false) {
                    return $rule;
                }
            }
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
     * 根据匹配到的规则进行回复消息
     * 
     * @param mixed $rule 
     * @param mixed $postObj 
     * @access public
     * @return void
     */
    public function sendReplyMsg($rule, $postObj) {
        
        foreach ($this->_rules['messageInfos'] as $msgInfo) {
            if ($msgInfo['messageid'] == $rule['messageid']) {

                // 具体的消息发送
                $msgClass = MsgController::factory($msgInfo['msgType']);
                if ($msgClass) {
                    $msgClass->responseMsg($postObj, $msgInfo['content']);
                    return true;
                }
            
            }
        }

        Logger::error("not find messageid:{$rule['messageid']}");
        return false;
    }
}
