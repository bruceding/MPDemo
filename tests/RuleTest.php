<?php
define('ROOT_PATH', dirname(dirname(__FILE__)));

require ROOT_PATH . '/src/RuleConfig.php';
require ROOT_PATH . '/src/config.php';
class RuleTest {

    public function testAddRule() {

        $msgInfo = new MessageInfo();
        $msgInfo->msgType = MessageInfo::MESSAGE_TYPE_TEXT;
        $msgInfo->content = 'this is a test';

        $rule = new Rule();
        $rule->keyword = 'test';
        $rule->type = Rule::TYPE_EXACT_MATCH;
        $rule->messageInfo = $msgInfo;

        $ruleConfig = new RuleConfig('wxid');
        $ruleConfig->addRule($rule);
    }

    public function testGetRules() {
    
        $ruleConfig = new RuleConfig('wxid');
        $rules = $ruleConfig->getRules();

        print_r($rules);
    }
}

try {
    $test = new RuleTest();
//    $test->testAddRule();
    $test->testGetRules();
} catch (Exception $e) {
    print_r($e);
}
exit;
