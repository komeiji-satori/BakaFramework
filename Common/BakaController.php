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
    public function cache($driver = false)
    {
        if (!$driver) {
            $driver = $this->config("CACHE_TYPE");
        }
        return $this->_cache_driver($driver);
    }
    private function _cache_driver($driver = "")
    {
        switch ($driver) {
            case 'redis':
                require_once __DIR__ . "/Cache/" . $driver . ".php";
                return (new redis_driver)->getInstance();
                break;
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
