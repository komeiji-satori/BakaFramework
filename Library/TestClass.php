<?php
class TestClass
{
    public $prefix;
    public $bc;
    public function __construct($test)
    {
        $this->bc = (new BakaController)->get_instance();
        $this->prefix = $test['str'];
    }
    public function get()
    {
        return $this->prefix . "|" . $this->bc->config("DB_TYPE") . "|" . time();
    }
}
