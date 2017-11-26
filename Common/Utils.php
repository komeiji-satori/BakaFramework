<?php
class Utils {
	public static function get_cfg($var = '') {
		return json_decode(Config, true)[$var];
	}
}