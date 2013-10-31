<?php

class NewsMsg{

    const MESSAGE_TYPE = "news";

    public function processMsg($postObj) {
        return true; 
    }

    /**
     * responseMsg 
     * 回复图文消息 
     *
     * @param mixed $postObj 
     * @param array $news    $news = array(
     *                                    'articleCount' => '',
     *                                     'news' => array(
     *                                                    'title' => '',
     *                                                    'description' => '',
     *                                                    'picUrl' => '',
     *                                                    'url' => ''
     *                                                    ),
     *                                                    array(
     *                                                    ...
     *                                                    ),
     *                                     .... 
     *                                  ) 
     * @access public
     * @return void
     */
    public function responseMsg($postObj, array $news) {
    
        if (!$news['articleCount'] || !is_array($news['news'])) {
            throw new InvalidException('Invalid news');
        } 

        $textTpl = "<xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[%s]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>";
        $str =  sprintf($textTpl, $postObj->FromUserName, $postObj->ToUserName, time(), self::MESSAGE_TYPE, $news['articleCount']);

        foreach ($news['news'] as $new) {
            $newTpl = "<item>
                        <Title><![CDATA[%s]]></Title> 
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                        </item>";
            $newStr = sprintf($newTpl, $new['title'], $new['description'], $new['picUrl'], $new['url']);

            $str .= $newStr;
        }
         
        $str .= "</Articles></xml>";
        echo $str;
    }
}
