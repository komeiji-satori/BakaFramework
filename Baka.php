<?php
include_once 'vendor/autoload.php';
include_once 'config.php';
class Init {
	public static function run() {
		session_start();
		Loader::Import("Common");
		self::ErrorHandler();
		InvokeController::_init();
	}
	private static function ErrorHandler() {
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
	}
}
class Loader {
	public static function Library($name) {
		if (file_exists($path = __DIR__ . '/Library/' . $name . '.php')) {
			require_once $path;
			return true;
		} else {
			return false;
		}
	}
	public static function Import($type = '') {
		if ($type && is_dir($type)) {
			foreach (scandir($type) as $file) {
				if (strstr($file, '.php')) {
					require_once $type . '/' . $file;
				}
			}
		}
	}
}
class Db extends ActiveRecord {
	public $table = '';
	public $primaryKey = '';
	function __construct($name, $key = 'id') {
		$this->table = $name;
		$this->primaryKey = $key;
	}
}