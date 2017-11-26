<?php
class DbDriver {
	public static $dsn;
	public static $connection;
	public static function getInstance($type) {
		switch ($type) {
		case 'MySQL':
			$config = Utils::get_cfg('MySQL');
			self::$dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $config['host'], $config['port'], $config['dbname'], $config['charset']);
			self::$connection = new PDO(self::$dsn, $config['user'], $config['pass']);
			return ActiveRecord::setDb(self::$connection);
			break;
		}
	}
}