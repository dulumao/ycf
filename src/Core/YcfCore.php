<?php

namespace Ycf\Core;

use Ycf\Core\YcfDB;
use Ycf\Core\YcfRedis;

class YcfCore {

	static $_settings = array();
	static $_db = null;
	static $_redis = null;

	static function init($model = 0) {
		self::$_settings = parse_ini_file("settings.ini.php", true);

	}

	static function load($_lib) {
		switch ($_lib) {
		case '_db':
			return self::getDbInstance();
			break;
		case '_redis':
			return self::getRedisInstance();
			break;
		default:
			break;
		}
	}

	static public function getDbInstance() {
		// Create Mysql Client instance with you configuration settings
		if (self::$_db == '') {
			self::$_db = new YcfDB(self::$_settings['Mysql']);
		}
		return self::$_db;
	}
	static public function getRedisInstance() {
		if (!extension_loaded('redis')) {
			throw new \RuntimeException('php redis extension not found');
			return null;
		}
		// Create Redis Client instance with you configuration settings
		self::$_redis = new YcfRedis(self::$_settings['Redis']);
		return self::$_redis;
	}

	static public function run() {
		/**
		 *cli use this:  /opt/php7/bin/php index.php ycf=Pdo act=test
		 *
		 */
		if (php_sapi_name() == "cli") {
			global $argv;
			foreach ($argv as $arg) {
				$e = explode("=", $arg);
				if (count($e) == 2) {
					$_REQUEST[$e[0]] = $e[1];
				} else {
					$_REQUEST[$e[0]] = 0;
				}
			}
		}

		$action = isset($_REQUEST['act']) ? $_REQUEST['act'] : 'hello';
		$ycfName = isset($_REQUEST['ycf']) ? $_REQUEST['ycf'] : 'Hello';
		$actionName = 'action' . ucfirst($action);
		//route to service
		$ycfName = "Ycf\Service\Ycf" . ucfirst($ycfName);
		if (method_exists($ycfName, $actionName)) {
			self::init();
			$ycf = new $ycfName();
			$ycf->$actionName();
		} else {
			die("action not find");
		}

	}
}
