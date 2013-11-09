<?php
require ROOT_PATH . '/src/MessageInfo.php';

class Rule {

    /**
     * 精确匹配 
     */
    const TYPE_EXACT_MATCH = 1;

    /**
     * 模糊匹配 
     */
    const TYPE_FUZZY_MATCH = 2;

    public $keyword;

    public $type;

    public $messageInfo;

    public $messageid;

    public $allRules;

    public function getRule() {
        
        return array('keyword' => $this->keyword, 'type' => $this->type, 'messageid' => $this->messageid);
    }

    public function getRules() {

        if (!$this->allRules) {
            $this->messageid = 1;
            $this->allRules = array();
        } else {
            $msgCount = count($this->allRules['messageInfos']);
            $this->messageid = $msgCount + 1;
        }

        $this->messageInfo->messageid = $this->messageid;

        $this->allRules['rules'][] = $this->getRule();
        $this->allRules['messageInfos'][] = $this->messageInfo->getMessageInfo();

        return $this->allRules;
    }
   
}
