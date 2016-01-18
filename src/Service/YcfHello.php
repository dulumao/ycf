<?php
namespace Ycf\Service;
use Ycf\Core\YcfCore;

class YcfHello {

	public function actionHello() {
		echo "hello ycf" . time();

	}

	public function actionLog() {
		echo 'test log';
		YcfCore::$_log->log('hello ycf', 'info', 'application');
	}

}