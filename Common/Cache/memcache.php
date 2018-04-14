<?php
class memcace_driver extends BakaController
{
    private $_memcache;
    public function getInstance()
    {
        if (class_exists('Memcached', false)) {
            $this->_memcache = new Memcached();
        } elseif (class_exists('Memcache', false)) {
            $this->_memcache = new Memcache();
        }
        $config = $this->config("Memcache");
        $this->_memcache->connect($config['host'], $config['port']);
        return $this;
    }
    public function save($key = "", $value = "", $expire = null)
    {
        return $this->_memcache->set($key, $value, $expire);
    }
    public function get($key = "")
    {
        return $this->_memcache->get($key);
    }
    public function increment($key, $offset = 1)
    {
        return $this->_memcache->increment($key, $offset);
    }
    public function decrement($key, $offset = 1)
    {
        return $this->_memcache->decrement($key, $offset);
    }
    public function delete($key = "")
    {
        return $this->_memcache->delete($key);
    }
    public function clean()
    {
        return $this->_memcache->flush();
    }
}
