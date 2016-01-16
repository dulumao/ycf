<?php
date_default_timezone_set('Asia/Shanghai');
define('DEBUG', true);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH', realpath(dirname(__FILE__)) . DS);


use Ycf\Core\YcfCore;
//require_once(ROOT_PATH.'src/Core/YcfCore.php');
require 'vendor/autoload.php';
YcfCore::run();