<?php
define('WEIXINID', 'gz_bruceding');
define('ROOT_PATH', __DIR__);

require ROOT_PATH . '/src/MpApi.php';

/**
  * wechat php test
  */

$api = new MpApi();
try {
    $api->dealMsg();
} catch (Exception $e) {

    // 简单的进行错误处理
    file_put_contents(ROOT_PATH . '/error.log', $e->getMessage(), FILE_APPEND);
}
exit;
?>
