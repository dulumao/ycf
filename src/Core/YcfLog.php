<?php
namespace Ycf\Core;

class YcfLog {
	const LEVEL_TRACE = 'trace';
	const LEVEL_WARNING = 'warning';
	const LEVEL_ERROR = 'error';
	const LEVEL_INFO = 'info';
	const LEVEL_PROFILE = 'profile';
	const MAX_LOGS = 10000;

	private $_logs = array();
	private $_logCount = 0;
	private $_logpath = ROOT_PATH . '/src/runtime/';

	public function formatLogMessage($message, $level, $category, $time) {
		return @date('Y/m/d H:i:s', $time) . " [$level] [$category] $message\n";
	}

	public function log($message, $level = 'info', $category = 'application', $flush = false) {
		$this->_logs[] = array($message, $level, $category, microtime(true));
		$this->_logCount++;
		if ($this->_logCount >= MAX_LOGS || $flush == true) {
			$this->flush($category);
		}
	}

	public function processLogs() {
		$text = '';
		foreach ((array) $this->_logs as $log) {
			$text .= $this->formatLogMessage($log[0], $log[1], $log[2], $log[3]);
		}
		return $text;
	}
	/**
	 *
	 * 写日志到文件
	 */
	public function flush($category) {
		$text = $this->processLogs();
		if ($this->_logCount <= 0) {
			return false;
		}
		$text .= "[" . $_SERVER['REQUEST_URI'] . "] " . "[runing time]: " . (microtime(true) - YCF_BEGIN_TIME) . "\n";
		$filename = $this->_logpath . $category . '.log';
		$fp2 = fopen($filename, "a+") or YcfUtils::exit("Log fatal Error !");
		fwrite($fp2, $text);
		fclose($fp2);
		$this->_logs = array();
		$this->_logCount = 0;
	}
}