<?php 

namespace core;

class mins 
{
    #类集合
    public static $classMap = [];

    #接收变量
    public $assign;

    /*
     * 框架启动
     * 引入各种类文件
     *
     * @return bool
     */
    static public function run()
    {

        #内容,文件名
        \core\lib\log::init();
        \core\lib\log::log($_SERVER, 'server');

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
            \core\lib\log::log('ctrl:'.$ctrlClass.'------action:'.$action, 'operate');
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

    /*
     * 渲染
     *
     * @return data
     */
    public function assign($name, $value)
    {
        $this->assign[$name] = $value;
    }

    /*
     * 模板文件
     *
     * @return bool
     */
    public function tpl($file)
    {
        $file = APP. 'views/' . $file;
        if (is_file($file)) {
            extract($this->assign);
            include $file;
        } else {
            throw new \Exception ('no fils');
        }
    }
}
