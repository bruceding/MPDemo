<?php

/**
 * ZipCode 
 * 邮政编码
 * 
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class ZipCode {

    public function getZipCodeByLocation($location) {

         $location = iconv("UTF-8", "GBK", trim($location));
         $url = "http://opendata.baidu.com/post/s?wd=".urlencode($location)."&p=mini&rn=20";
         $response = file_get_contents($url);
         $pattern = "/(?P<td><td>)(?P<zipcode>\d{6})/";
         $res = preg_match($pattern, $response, $match);
         if ($res > 0) {
            $zipcode = $match['zipcode']; 
         }
         return $zipcode;
    }
}
