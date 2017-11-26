<?php
class owo {
	public static function test($id) {
		$user = new Db('user');
		return $user->select('*')->eq('id', $id)->find()->data;
	}
}