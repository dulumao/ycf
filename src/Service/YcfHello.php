<?php
namespace Ycf\Service;
use Ycf\Core\YcfCore;

class YcfHello {

	public function actionIndex() {
		echo "hello ycf";

	}
	public function actionHello() {
		echo "hello ycf" . time();

	}

	public function actionLog() {
		YcfCore::$_log->log('hello ycf', 'info');
	}

}