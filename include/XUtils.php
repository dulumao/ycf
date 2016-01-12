<?php

/**
 * 系统助手类
 * 
 *
 */
class XUtils {
    /**
     * 注册类库载入路径
     */
    static public function spl_autoload_register()
    {
        spl_autoload_register(function ($name) {
            $file_path = ROOT_PATH . "include" . DS . $name . ".php";
            if(!file_exists($file_path)){
                die('class no exits');
            }
            include $file_path;
        });
    }
    /**
     * 
     * 写日志
     */
    static public function log($errmsg, $fileName) {
        $path = ROOT_PATH. '/runtime/';
        $filename = $path . $fileName . '.log';
        $fp2 = @fopen($filename, "a");
        fwrite($fp2, date('Y-m-d H:i:s') . '  ' . $errmsg . "\r\n");
        fclose($fp2);
    }
}