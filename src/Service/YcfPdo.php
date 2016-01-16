<?php
namespace Ycf\Service;

use Ycf\Model\ModelTest;

class YcfPdo {

	public function actionTest() {
		$modelTest = new ModelTest();
		$result = $modelTest->testInsert();
		var_dump($result);

		$result = $modelTest->testQuery();
		var_dump($result);

		$result = $modelTest->testRedis();
		var_dump($result);

	}

}