<?php
namespace Ycf\Model;
use Ycf\Core\YcfCore;

class ModelTest {
	private $_db = null;
	private $_redis = null;
	function __construct() {
		$this->_db = YcfCore::load('_db');
		$this->_redis = YcfCore::load('_redis');
	}

	public function testInsert() {
		$data['pName'] = 'fww';
		$data['pValue'] = '总过万佛无法';
		$insert = $this->_db->query("INSERT INTO pdo_test( pName,pValue) VALUES ( :pName,:pValue)", $data);
		if ($insert > 0) {
			echo $this->_db->lastInsertId() . "\r\n";
		} else {
			echo false . "\r\n";
		}
	}

	public function testQuery() {
		return $this->_db->query("select  *  from pdo_test limit 10");

	}

	public function testRedis() {
		// Use Redis commands
		$this->_redis->set('test', '7');
		var_dump($this->_redis->get('test'));
	}

}