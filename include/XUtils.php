<?php

/**
 * 系统助手类
 * 
 *
 */
class XUtils {

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