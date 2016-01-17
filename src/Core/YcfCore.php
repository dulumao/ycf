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

		$router = self::route();
		//route to service
		$actionName = 'action' . ucfirst($router['action']);
		$ycfName = "Ycf\Service\Ycf" . ucfirst($router['controller']);
		if (method_exists($ycfName, $actionName)) {
			self::init();
			$ycf = new $ycfName();
			$ycf->$actionName();
		} else {
			die("action not find");
		}

	}

	static function route() {
		$array = array('controller' => 'Hello', 'action' => 'hello');
		if (!empty($_GET["ycf"])) {
			$array['controller'] = $_GET["ycf"];
		}
		if (!empty($_GET["act"])) {
			$array['action'] = $_GET["action"];
		}
		$uri = parse_url($_SERVER['REQUEST_URI']);
		if (empty($uri['path']) or $uri['path'] == '/' or $uri['path'] == '/index.php') {
			return $array;
		}
		$request = explode('/', trim($uri['path'], '/'), 3);
		if (count($request) < 2) {
			return $array;
		}
		$array['controller'] = $request[0];
		$array['action'] = $request[1];
		return $array;
	}
}
