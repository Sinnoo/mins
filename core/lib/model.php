<?php

namespace core\lib;
use core\biz;

class model extends \PDO
{
    private $config;
    public function __construct()
    {
        $biz = CORE. 'biz/config.php';
        if (is_file($biz)) {
            include $biz;
        } else {
            throw new \Exception ('no files');
        }

        $this->config = $config;
        if ($config['type'] == 'mysql') {
            return $this->connMysql($config);
        } elseif ($config['type'] == 'mongo') {
            return $this->connMongo($config);
        } else {
            throw new \Exception ('no files');
        }
        var_d($config);exit;
        $dsn = 'mysql:host=127.0.0.1;dbname=songmingshuo';
        $username = 'songmingshuo';
        $psw = '123456';

    }

    /*
     * 连接mysql数据库
     *
     * @return mix
     */
    protected function connMysql($config)
    {
        $biz = $config;
        try {
            parent::__construct($biz['dsn'], $biz['username'], $biz['psw']);
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /*
     * 获取配置信息
     *
     * @return arr
     */
    public function config()
    {
        $data = $this->config;
        unset($data['dsn']);
        unset($data['username']);
        unset($data['psw']);
        return $data;
    }

    /*
     * 连接mongo
     *
     * @return mix
     */
    protected function connMongo($config)
    {
    }
}
