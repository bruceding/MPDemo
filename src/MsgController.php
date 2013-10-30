<?php
require 'TextMsg.php';
require 'EventMsg.php';
require 'ImageMsg.php';
require 'LinkMsg.php';
require 'LocationMsg.php';
require 'VoiceMsg.php';
require 'VideoMsg.php';

class MsgController{
    
    /**
     * 消息类型：文本 
     */
    const MESSAGE_TYPE_TEXT = "text";

    /**
     * 消息类型：图片 
     */
    const MESSAGE_TYPE_IMAGE = "image";

    /**
     * 消息类型：链接消息 
     */
    const MESSAGE_TYPE_LINK = "link";

    /**
     * 消息类型：位置消息 
     */
    const MESSAGE_TYPE_LOCATION = "location";

    /**
     * 消息类型：语音消息  
     */
    const MESSAGE_TYPE_VOICE = "voice";

    /**
     * 消息类型：视频消息 
     */
    const MESSAGE_TYPE_VIDEO = "video";

    /**
     * 消息类型：事件 
     */
    const MESSAGE_TYPE_EVENT = "event";

    public static function factory($type = '') {

        $type = strtolower($type);
        if ($type == self::MESSAGE_TYPE_TEXT) {
            return new TextMsg();
        } else if ($type == self::MESSAGE_TYPE_EVENT) {
        	return new EventMsg();
        } else if ($type == self::MESSAGE_TYPE_IMAGE) {
            return new ImageMsg();
        } else if ($type == self::MESSAGE_TYPE_LINK) {
            return new LinkMsg();
        } else if ($type == self::MESSAGE_TYPE_LOCATION) {
            return new LocationMsg();
        } else if ($type == self::MESSAGE_TYPE_VOICE) {
            return new VoiceMsg();
        } else if ($type == self::MESSAGE_TYPE_VIDEO) {
            return new VideoMsg();
        }
    }
}
