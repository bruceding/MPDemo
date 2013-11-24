<?php
require "HTTP/Request2.php";

class BaiDuTranslate {

    private $_isGood = false;

    private $_result = '';
    public function translate($text, $from = 'auto', $to='auto') {

       $url = 'http://openapi.baidu.com/public/2.0/bmt/translate'; 

       $post = array(
                    'from' => $from,
                    'to' => $to,
                    'client_id' => BAIDU_APPKEY,
                    'q' => $text
                    );

       try {
            $res = $this->_request($url, $get, $post);
       } catch (Exception $e) {
            $this->_isGood = false;
            Logger::error($e); 
       }

       if (!$res) {
            $res = '很抱歉，没有找到翻译结果'; 
       }

       return $res;
    }

    protected function _request($url, $get = array(), $post = array()) {

        // 构造get请求
        if ($get) {
            $requestMethod = HTTP_Request2::METHOD_GET;
            if (strpos('?', $url) === false) {
                $url .= '?' . http_build_query($get);
            } else {
                $url .=  http_build_query($get);
            }
        } 

        if ($post) {
            $requestMethod = HTTP_Request2::METHOD_POST;
        }
    
        try {
            $httpRequest = new HTTP_Request2($url, $requestMethod); 
            if ($post) {
                $httpRequest->addPostParameter($post);
            }

            // 返回的是HTTP_Request2_Response
            $response = $httpRequest->send();
            $body = $response->getBody();
        } catch (Exception $e) {
            Logger::error($e);
            throw new Exception($e);
        }

        // getStatus:返回code， 小于400 调用成功
        if ($response->getStatus() < 400) {
            $res = $this->_handleResult($body);
        } else {
            throw new Exception('网络错误', $response->getStatus());
        }

        return $res;

    }

    /**
     * good 
     * 返回翻译是否成功
     * 
     * @access public
     * @return void
     */
    public function good() {
        return $this->_isGood;
    }

    protected function _handleResult($body) {

        $res = json_decode($body, true);
        if ($res['error_code'] > 0) {
            throw new Exception($res['error_msg'], $res['error_code']);
        }

        $result = array();
        foreach ($res['trans_result'] as $val) {
            $result[] = $val['dst']; 
        }

        $this->_isGood = true;
        return join(';', $result);
    }
}
