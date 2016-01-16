<?php
namespace Ycf\Service;

use Ycf\Core\YcfCore;

class YcfPdo extends YcfCore {

	public static function actionTest() {
		$data['pName'] = 'fww';
		$data['pValue'] = '总过万佛无法';
		$insert = self::$_db->query("INSERT INTO pdo_test( pName,pValue) VALUES ( :pName,:pValue)", $data);
		if ($insert > 0) {
			echo self::$_db->lastInsertId() . "\r\n";
		} else {
			echo false . "\r\n";
		}
	}

	public static function query() {
		return self::$_db->query("select  *  from pdo_test limit 10");

	}
}