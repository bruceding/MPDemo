<?php
define('ROOT_PATH', dirname(dirname(__FILE__)));

require ROOT_PATH . '/src/config.php';
require ROOT_PATH . '/base/Logger.php';
class LoggerTest {

}

try {
    Logger::debug('test debug');
    throw new Exception('log test');
} catch (Exception $e) {
    Logger::error($e);
}
exit;
