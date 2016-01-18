<?php
//namespace Ycf\Swoole;
//use Ycf\Core\YcfCore;

class HttpServer {
	public static $instance;

	public $http;
	public static $get;
	public static $post;
	public static $header;
	public static $server;

	public function __construct() {
		$http = new swoole_http_server("0.0.0.0", 9501);

		$http->set(
			array(
				'worker_num' => 8,
				'daemonize' => false,
				'max_request' => 1000,
				'dispatch_mode' => 1,
			)
		);

		$http->on('WorkerStart', array($this, 'onWorkerStart'));

		$http->on('request', function ($request, $response) {
			if (isset($request->server)) {
				HttpServer::$server = $request->server;
				foreach ($request->server as $key => $value) {
					$_SERVER[strtoupper($key)] = $value;
				}
			}
			if (isset($request->header)) {
				HttpServer::$header = $request->header;
			}
			if (isset($request->get)) {
				HttpServer::$get = $request->get;
				foreach ($request->get as $key => $value) {
					$_GET[$key] = $value;
				}
			}
			if (isset($request->post)) {
				HttpServer::$post = $request->post;
				foreach ($request->post as $key => $value) {
					$_POST[$key] = $value;
				}
			}
			if (isset($request->request_uri)) {
				$_SERVER['REQUEST_URI'] = $request->request_uri;
			}
			ob_start();
			//实例化ycf对象
			try {
				Ycf\Core\YcfCore::run();
			} catch (Exception $e) {
				var_dump($e);
			}
			$result = ob_get_contents();
			ob_end_clean();
			$response->end($result);
			unset($result);
		});

		$http->start();
	}

	public function onWorkerStart() {
		date_default_timezone_set('Asia/Shanghai');
		define('DEBUG', true);
		define('SWOOLE', true);
		define('DS', DIRECTORY_SEPARATOR);
		define('ROOT_PATH', realpath(dirname(__FILE__)) . DS);
		define('YCF_BEGIN_TIME', microtime(true));

		require 'vendor/autoload.php';

	}

	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new HttpServer();
		}
		return self::$instance;
	}
}

HttpServer::getInstance();