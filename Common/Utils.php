<?php
class Utils {
	public static function get_cfg($var = '') {
		return json_decode(Config, true)[$var];
	}
	public static function RedisConnect() {
		if (!class_exists('Redis')) {
			return false;
		}
		$redis = new Redis();
		$redis_cfg = self::get_cfg('Redis');

		$redis->connect($redis_cfg['host'], $redis_cfg['port']);
		if (!is_null($redis_cfg['auth'])) {
			$redis->auth($redis_cfg['auth']);
		}
		if (!$redis->ping()) {
			return false;
		} else {
			return $redis;
		}
	}
}