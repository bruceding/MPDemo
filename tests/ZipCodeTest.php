<?php
define('ROOT_PATH', dirname(dirname(__FILE__)));

require ROOT_PATH . '/src/ZipCode.php';
require ROOT_PATH . '/src/config.php';
require ROOT_PATH . '/base/Logger.php';

class ZipCodeTest {

    public function testGetZipCodeByLocation() {

        $location = '山东省淄博市临淄区金岭镇';
        $zipcode = new ZipCode();
        $res = $zipcode->getZipCodeByLocation($location);
        print_r($res);
        
    } 
}

try {
    $test = new ZipCodeTest();
    $test->testGetZipCodeByLocation();
} catch (Exception $e) {
    print_r($e);
}
exit;
