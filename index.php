<?php
require 'MpApi.php';

/**
  * wechat php test
  */
define('WEIXINID', 'gz_bruceding');

$api = new MpApi();
try {
    $api->dealMsg();
} catch (Exception $e) {

    // 简单的进行错误处理
    file_put_contents('error.log', $e->getMessage(), FILE_APPEND);
}
exit;
?>
