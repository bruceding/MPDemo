<?php
require ROOT_PATH . '/src/TextMsg.php';
require ROOT_PATH . '/src/EventMsg.php';
require ROOT_PATH . '/src/ImageMsg.php';
require ROOT_PATH . '/src/LinkMsg.php';
require ROOT_PATH . '/src/LocationMsg.php';
require ROOT_PATH . '/src/VoiceMsg.php';
require ROOT_PATH . '/src/VideoMsg.php';
require ROOT_PATH . '/src/NewsMsg.php';

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
     * 消息类型：图文消息  
     */
    const MESSAGE_TYPE_NEWS = "news";

    /**
     * 消息类型：事件 
     */
    const MESSAGE_TYPE_EVENT = "event";

    public static function factory($type = '') {

        $type = strtolower($type);

        // 实例化消息类型相关的类
        $class = ucfirst($type) . 'Msg';

        if (!class_exists($class)) {
            throw new Exception('not found class:' . $class);
        }

        return new $class();
    }
}
