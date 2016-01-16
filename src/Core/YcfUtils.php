<?php

namespace Ycf\Core;

/**
 * 系统助手类
 *
 *
 */
class YcfUtils {

	/**
	 *
	 * 写日志
	 */
	static public function log($errmsg, $fileName) {
		$path = ROOT_PATH . '/runtime/';
		$filename = $path . $fileName . '.log';
		$fp2 = fopen($filename, "a+") or die("Log fatal Error !");
		fwrite($fp2, "Time: " . date('Y-m-d H:i:s') . '  ' . $errmsg . "\r\n");
		fclose($fp2);
	}

	/**
	 * 获得来源类型 post get
	 *
	 * @return unknown
	 */
	static public function method() {
		return strtoupper(isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET');
	}
}