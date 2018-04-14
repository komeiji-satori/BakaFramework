<?php
class owo extends BakaController
{
    public static function test($id = 1)
    {
        $user = new Db('user');
        return $user->select('*')->eq('id', $id)->find()->data;
    }
    public function www($x = "233")
    {
        $this->load_library("TestClass", ["str" => "w"], "test");
        return [
            'code' => 123,
            'data' => $x,
            "str" => $this->test->get(),
        ];
    }
}
