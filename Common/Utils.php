<?php
class Utils extends BakaController
{
    public function RedisConnect()
    {
        if (!class_exists('Redis')) {
            return false;
        }
        $redis = new Redis();
        $redis_cfg = $this->config('Redis');

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
