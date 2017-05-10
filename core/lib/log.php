<?php
namespace core\lib;
use core\lib\conf;

/*
 * 日志类
 *
 * @return
 */
class log
{
    static $class;
    static public function init()
    {
        #参数名,文件
        $drive = conf::get('DRIVE', 'log');
        $class = 'core\lib\drive\log\\'. $drive;
        self::$class = new $class;
    }

    /*
     * 日志内容和存放的文件
     *
     * @return bool
     */
    static public function log($data, $file = 'log')
    {
        self::$class->log($data, $file);
    }
}
