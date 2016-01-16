<?php
namespace Ycf\Service;

use Ycf\Core\YcfCore;

class YcfHello extends YcfCore {

	public static function actionHello() {
		echo "hello ycf";
	}

	public static function actionShow() {
		$result = YcfPdo::query();
		var_dump($result);
	}

}