<?php
require ROOT_PATH . '/src/ZipCode.php';

/**
 * ZipCodeReplyTactic
 * 查询邮政编码的回复策略
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class ZipCodeReplyTactic {

    private $_rules;
    public function reply($postObj) {

        $rule = $this->matchRule($postObj);

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

        $location = trim($postObj->Label);
        
        if ($location) {

            // 过滤掉中国 两字
            if (strpos($location, '中国') !== false) {
                $location = substr($location, 6);        
            }

            // 过滤掉数字，-
            $location = preg_replace('/[\d-]/', '', $location);
            $zipcode = new ZipCode();
            while(strlen($location)) {
               $res = $zipcode->getZipCodeByLocation($location); 
               if ($res) {
                    return "【{$location}】$res";
               }

               $location = substr($location, 0, -3);
            }
        }

        return '';

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
