<?php
class InvokeController {
	public static $_action;
	public static $_method;

	public static $_error = [
		'action_not_found' => ['status' => 404, 'message' => 'Action Not Found'],
		'method_not_found' => ['status' => 404, 'message' => 'Method Not Found'],
	];
	private static $_pathinfo;
	public static function _init() {
		self::$_pathinfo = $_SERVER['PATH_INFO'] ?? '';
		self::_setActionAndMethod();
		if (!class_exists(self::$_action)) {
			die(json_encode(self::$_error['action_not_found']));
		}
		if (!method_exists(self::$_action, self::$_method)) {
			die(json_encode(self::$_error['method_not_found']));
		}
		if (self::$_action == 'Utils') {
			die(json_encode(self::$_error['action_not_found']));
		}
		$action = new ReflectionClass(self::$_action);
		$params = $action->getMethod(self::$_method)->getParameters();

		$vars = array_merge(self::parsePathInfo(), $_POST);
		$vars = array_merge($vars, $_GET);
		foreach ($params as $param) {
			if (!in_array($param->getName(), array_keys($vars))) {
				if ($param->isDefaultValueAvailable()) {
					$args[] = $param->getDefaultValue();
				} else {
					$args[] = null;
				}
			} else {
				$args[] = $vars[$param->getName()];
			}

		}
		DbDriver::getInstance(Utils::get_cfg('DB_TYPE'));
		if (count(@$args) > 0) {
			$result = $action->getMethod(self::$_method)->invokeArgs(new self::$_action, $args);
		} else {
			$result = $action->getMethod(self::$_method)->invoke(new self::$_action);
		}
		switch (Utils::get_cfg('OUTPUT')) {
		case 'json':
			header('Content-Type: application/json');
			print(json_encode($result));
			break;
		case 'xml':
			header('Content-Type: application/xml');
			print(Spatie\ArrayToXml\ArrayToXml::convert($result));
			break;
		case 'http':
			print(http_build_query($result));
			break;
		case 'raw':
			var_dump($result);
			break;
		}
	}
	private static function parsePathInfo() {
		$params_arr = [];
		$params = explode('/', self::$_pathinfo);
		$url_arrays = [];
		foreach ($params as $key => $value) {
			if ($value) {
				$params_arr[] = $value;
			}
		}
		unset($params_arr[0]);
		unset($params_arr[1]);
		$arrays = array_values($params_arr);
		foreach ($arrays as $key => $value) {
			if ($key % 2 == 0) {
				$url_arrays[$value] = @$arrays[$key + 1];
			}
		}
		return $url_arrays;
	}
	private static function _setActionAndMethod() {
		$params = explode('/', self::$_pathinfo);
		self::$_action = $params[1];
		self::$_method = $params[2];
	}
}