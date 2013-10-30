<?php
require 'MpApi.php';

/**
  * wechat php test
  */
define('WEIXINID', 'gz_bruceding');
define('ROOT_PATH', __DIR__);

$api = new MpApi();
try {
    $api->dealMsg();
} catch (Exception $e) {

    // 简单的进行错误处理
    file_put_contents(ROOT_PATH . '/error.log', $e->getMessage(), FILE_APPEND);
}
exit;
?>
