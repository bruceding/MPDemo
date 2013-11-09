<?php

class MessageInfo {

    /**
     * 消息类型：文本 
     */
    const MESSAGE_TYPE_TEXT = "text";
    
    /**
     * 消息类型：图文 
     */
    const MESSAGE_TYPE_NEWS = "news";
    /**
     * messageid 
     * 回复消息的id 
     */
    public $messageid;

    /**
     * content 
     * 回复消息的内容 
     */
    public $content;

    /**
     * msgType 
     * 回复消息的类型 
     */
    public $msgType;

    public function getMessageInfo() {

       $this->_checkContent();
       return array('messageid' => $this->messageid, 'msgType' =>$this->msgType, 'content' => $this->content); 
    }

    /**
     * _checkContent 
     * 校验回复内容 
     *
     * @access private
     * @return void
     */
    private function _checkContent() {
        
        if ($this->msgType == self::MESSAGE_TYPE_TEXT) {
            if (!$this->content || !is_string($this->content)) {
                throw new Exception('Invalid content');
            }
        } else if ($this->msgType == self::MESSAGE_TYPE_NEWS) {
        
        }
    }
}
