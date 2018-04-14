<?php
class redis_driver extends BakaController
{
    private $redis;
    public function getInstance()
    {
        $this->redis = (new Utils)->RedisConnect();
        return $this;
    }
    public function save($key = "", $value = "", $expire = null)
    {
        return $this->redis->set($key, $value, $expire);
    }
    public function get($key = "")
    {
        return $this->redis->get($key);
    }
    public function increment($key, $offset = 1)
    {
        return $this->redis->incr($key, $offset);
    }
    public function decrement($key, $offset = 1)
    {
        return $this->redis->decr($key, $offset);
    }
    public function clean()
    {
        return $this->redis->flushDB();
    }
    public function delete($key = "")
    {
        return $this->redis->del($key);
    }
}
