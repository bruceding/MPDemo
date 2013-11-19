<?php
/**
 * Logger 
 * 日志类 
 *
 * @package 
 * @version $id$
 * @copyright 1997-2005 The PHP Group
 * @author Tobias Schlitt <toby@php.net> 
 * @license PHP Version 3.0 {@link http://www.php.net/license/3_0.txt}
 */
class Logger {

    //private static $_str = "";

    /**
     * 日志级别:错误 
     */
    const LOG_LEVEL_ERROR = 1;

    /**
     * 日志级别：警告 
     */
    const LOG_LEVEL_WARNING = 2;

    /**
     * 日志级别：调试 
     */
    const LOG_LEVEL_DEBUG = 3;

    /**
     * Log文件的根目录 
     */
    private static $_log_dir;

    /**
     * 过滤掉不需要记录的路径, 用于_getLogDirectory函数  
     */
    //private static $_unuse_dir = array('include');

    public static function error($e) {
        
        $file = self::_getLogDirectory($e);
        return self::log($e, self::LOG_LEVEL_ERROR, $file);
    }

    private static function _getLogDirectory($e) {

        $trace = debug_backtrace();
        $path = $trace[1]['file']; 

        $path = explode('/', $path);

        $rootPath = explode('/', ROOT_PATH);
        $file = '';
        foreach ($path as $key => $value) {

            // 过滤掉根目录
            if (in_array($value, $rootPath)) {
                continue;
            }

            $file .= $value . '/';
        }
        $file = substr($file, 0, strpos($file, '.'));

        return $file . '/' . date('Y-m-d') . '.log';

    }

    public static function warning($e, $file = '') {
        if (!$file) {
            $file = self::_getLogDirectory();
        }

        self::log($e, self::LOG_LEVEL_WARNING, $file);
    }
    
    public static function debug($e, $file='') {
        if (!$file) {
            $file = self::_getLogDirectory();
        }

        self::log($e, self::LOG_LEVEL_DEBUG, $file); 
    }
    public static function log($e, $level, $file) {

        self::validLogDir();

        if ($file) {
            $fileArr = explode('/' , $file);
            $dir = self::$_log_dir;
            for ($i = 0; $i < count($fileArr) -1; $i++) {
               $dir .= '/' . $fileArr[$i]; 
            }
            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }
            $file = self::$_log_dir . '/' . $file;
        } else {
            $file = self::$_log_dir . '/' . date('Y-m-d') . '.log';
        }

        $message = $logstr = "";
        if ($e instanceof Exception) {
            $message .=  $e->getFile() . " : " . $e->getMessage();
        } else {
            $message = $e;
        }

        switch($level) {
            case self::LOG_LEVEL_ERROR:
                $logstr .= "[" . date('Y-m-d H:i:s') . "]" . " Error: " . $message . "\n";
                break;
            case self::LOG_LEVEL_WARNING:
                $logstr .= "[" . date('Y-m-d H:i:s') . "]" . " Warning: " . $message . "\n";
                break;
            case self::LOG_LEVEL_DEBUG:
                $logstr .= "[" . date('Y-m-d H:i:s') . "]" . " Debug: " . $message . "\n";
                break;
        }

        file_put_contents($file, $logstr, FILE_APPEND);
    }

    /**
     * validLogDir 
     * 根据LOG_DIR变量，定义Log根目录 
     *
     * @static
     * @access public
     * @return void
     */
    public static function validLogDir() {

        if (!defined('LOG_DIR') && !$conf['LOG_DIR']) {
            die('NOT FOUND LOG_DIR  VARIABLE');
        }

        if (defined('LOG_DIR')) { 
        
            $logDir = ROOT_PATH . '/' . LOG_DIR; 
        } else if ($conf['LOG_DIR']) {
        
            $logDir = ROOT_PATH . '/' . $conf['LOG_DIR']; 
        }

        if (!file_exists($logDir)) {
            
            mkdir($logDir, 0777, true);
        }
        
        self::$_log_dir = $logDir;
    }
}
