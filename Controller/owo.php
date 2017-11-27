<?php
class owo {
	public static function test($id = 1) {
		$user = new Db('user');
		return $user->select('*')->eq('id', $id)->find()->data;
	}
	public static function lib() {
		Loader::Library("test");
		return TestClass::get();
	}
}