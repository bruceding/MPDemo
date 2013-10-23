<?php
require 'TextMsg.php';
require 'EventMsg.php';

class MsgController{
    
    const MESSAGE_TYPE_TEXT = "text";

    public static function factory($type = '') {
        
        if (strtolower($type) == 'text') {
            return new TextMsg();
        } else if (strtolower($type) == 'event') {
        	return new EventMsg();
        }
    }
}
