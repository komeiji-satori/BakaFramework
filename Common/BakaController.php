<?php
class BakaController
{
    public function load_library($name = "", $construct = [], $as = null)
    {
        if (file_exists($path = __DIR__ . '/../Library/' . $name . '.php')) {
            require_once $path;
            if (is_null($as)) {
                $this->$name = new $name($construct);
            }
            $this->$as = new $name($construct);
            return true;
        } else {
            return false;
        }
    }
    public function get_instance()
    {
        return $this;
    }
    public function config($var = '')
    {
        return json_decode(Config, true)[$var];
    }

}
