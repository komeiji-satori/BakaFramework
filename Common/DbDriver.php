<?php
class DbDriver extends BakaController
{
    public $dsn;
    public $connection;
    public function getInstance($type)
    {
        switch ($type) {
            case 'MySQL':
                $config = $this->config('MySQL');
                $this->dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $config['host'], $config['port'], $config['dbname'], $config['charset']);
                $this->connection = new PDO($this->dsn, $config['user'], $config['pass']);
                return ActiveRecord::setDb($this->connection);
                break;
            case 'SQLite':
                $config = $this->config('SQLite');
                $this->dsn = sprintf('sqlite:%s', $config['name']);
                $this->connection = new PDO($this->dsn);
                return ActiveRecord::setDb($this->connection);
                break;
        }
    }
}
