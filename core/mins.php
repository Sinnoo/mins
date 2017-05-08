<?php 

namespace core;

class mins 
{
    public static $classMap = [];

    /*
     * 框架启动
     * 引入各种类文件
     *
     * @return bool
     */
    static public function run()
    {
        #路由
        $route = new \core\route();
    }

    static public function load($class)
    {
        #自动加载类
        if (isset($classMap[$class])) {
            return true;
        } else {
            $class = str_replace('\\', '/', $class);
            if (is_file(MINS .'/'. $class.'.php')) {
                include MINS .'/'. $class.'.php';
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }
}
