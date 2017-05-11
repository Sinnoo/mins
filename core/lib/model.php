<?php

namespace core\lib;
use core\biz;
use core\lib\conf;

/*
 * 模型类
 *
 * 连接数据库
 */
class model extends \Medoo\Medoo
{
    private $config;
    public function __construct()
    {
        $biz = CORE. 'biz/config.php';
        if (is_file($biz)) {
            include $biz;
        } else {
            #默认暂时只支持mysql
            $conf = conf::getAll('dsn');
            if (is_array($conf)) {
                return $this->connMysql($conf);
            } else {
                throw new \Exception ('no files');
            }
        }

        $this->config = $config;
        if ($config['type'] == 'mysql') {
            return $this->connMysql($config);
        } elseif ($config['type'] == 'mongo') {
            return $this->connMongo($config);
        } else {
            throw new \Exception ('no files');
        }
    }

    /*
     * 连接mysql数据库
     *
     * @return mix
     */
    protected function connMysql($config)
    {
        $biz = $config;

        #继承medoo
        $dasename = explode('=', explode(';', $biz['dsn'])[1])[1];
        $dsn = explode('=', explode(';', $biz['dsn'])[0])[1];
        $option = [
            'database_type' => 'mysql',
            'database_name' => $dasename,
            'server' => $dsn,
            'username' => $biz['username'],
            'password' => $biz['psw'],
            'charset' => 'utf8',
        ];
        try {
            parent::__construct($option);
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
