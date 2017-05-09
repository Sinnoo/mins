<?php 

namespace core;

class mins 
{
    #类集合
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
        $route = new \core\lib\route();

        #自动执行到位到方法
        $ctrlClass = $route->ctrl;
        $action = $route->action;
        $ctrlFile = APP. 'ctrl/' .$ctrlClass. 'Ctrl.php';
        $ctrlClass = MODULE. 'ctrl\\' .$ctrlClass. 'Ctrl';
        if (is_file($ctrlFile)) {
            include $ctrlFile;
            $ctrl = new $ctrlClass();
            $ctrl->$action();
        } else {
            throw new \Exception ('no actions');
        }
    }

    /*
     * 自动加载类
     *
     * @return mix
     */
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
