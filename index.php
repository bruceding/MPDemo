<?php

// 设置当前项目的根目录
define('ROOT_PATH', __DIR__);

require ROOT_PATH . '/src/config.php';
require ROOT_PATH . '/src/MpApi.php';
require ROOT_PATH . '/base/Logger.php';

$api = new MpApi();
try {
    $api->dealMsg();
} catch (Exception $e) {

    Logger::error($e);
}
exit;
?>
