<?php

namespace Ycf\Core;

use Ycf\Core\YcfDB;

class YcfCore {
	static $_settings = array();
	static $_db = '';

	static function init() {
		self::$_settings = parse_ini_file("settings.ini.php");
		self::getDbInstance();
	}

	static public function getDbInstance() {
		if (self::$_db == '') {
			self::$_db = new YcfDB();
		}
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
		$ycf_name = isset($_REQUEST['ycf']) ? $_REQUEST['ycf'] : 'Hello';
		$action_name = 'action' . ucfirst($action);
		//route to service
		$ycf_name = "Ycf\Service\Ycf" . ucfirst($ycf_name);
		if (method_exists($ycf_name, $action_name)) {
			self::init();
			$ycf_name::$action_name();
		} else {
			die("action not find");
		}

	}
}
