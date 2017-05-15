<?php
namespace core\lib\drive\log;
use core\lib\conf;

class file
{
    public $path;

    /*
     * 日志目录初始化
     *
     */
    public function __construct()
    {
        $conf = conf::get('OPTION', 'log');
        $this->path = $conf['PATH'];
    }

    /*
     * 写入日志
     *
     * @return bool
     */
    public function log($msg, $file = 'log')
    {

        if (!is_dir($this->path)) {
            mkdir($this->path, '777', true);
            $cmd = "chmod -R 777 {$this->path}";
            shell_exec($cmd);
        } else {
        }

        return file_put_contents($this->path.date('Ymd').$file.'.php', date('Y-m-d H:i:s').json_encode($msg).PHP_EOL, FILE_APPEND);
    }

}
