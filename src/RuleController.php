<?php
require ROOT_PATH . '/src/ConfigReplyTactic.php';
require ROOT_PATH . '/src/TranslateReplyTactic.php';

/**
 * RuleController 
 * 规则控制器
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class RuleController {

    private $_rule_tactics = array();

    public function __construct() {

        // 注册回复策略
        // 这里可以从配置文件中读取回复策略
        $this->_rule_tactics[] = new ConfigReplyTactic();    
        $this->_rule_tactics[] = new TranslateReplyTactic();    
    }

    /**
     * autoReply 
     * 根据每个回复策略进行回复消息
     * 
     * @param mixed $postObj 
     * @access public
     * @return void
     */
    public function autoReply($postObj) {

        foreach ($this->_rule_tactics as $tactic) {

            if ($tactic->reply($postObj)) {
                return true;
            }
        }

        return false;
    }
}
