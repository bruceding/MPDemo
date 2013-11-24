<?php
define('ROOT_PATH', dirname(dirname(__FILE__)));

require ROOT_PATH . '/src/BaiDuTranslate.php';
require ROOT_PATH . '/src/config.php';
require ROOT_PATH . '/base/Logger.php';
class BaiDuTranslateTest {

    public function testTranslate() {

        $translate = new BaiDuTranslate();
        $res = $translate->translate('今天');

        print_r($res);
    } 
}

try {
    $test = new BaiDuTranslateTest();
    $test->testTranslate();
} catch (Exception $e) {
    print_r($e);
}
exit;
