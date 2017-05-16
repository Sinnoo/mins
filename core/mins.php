<?php 

namespace core;

class mins 
{
    //类集合
    public static $classMap = [];

    //接收变量
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
        if (is_array($ctrlClass)) {
            $file = self::ctrlToStr($ctrlClass);
            $class = self::ctrlToStr($ctrlClass, 'class');
        }
        $action = $route->action;
        $ctrlFile = APP. 'ctrl/' .$file. '.php';


        $ctrlClass = MODULE. 'ctrl\\' .$class;
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
     * 如果多级目录,则将数组转化为字符串
     *
     * @return str
     */
    static protected function ctrlToStr($arr, $type = 'file')
    {
        $str = '';
        if (is_array($arr) && $type == 'file') {
            foreach ($arr as $key => $val) {
                $str = $str . $val . '/';
            }
            $str = trim($str, '/');
        } elseif (is_array($arr) && $type == 'class') {
            foreach ($arr as $key => $val) {
                $str = $str . $val . '\\';
            }
            $str = trim($str, '\\');
        } else {
            throw new \Exception ('no arrays');
        }
        return $str;
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
        $template = $file;
        $file = APP. 'views/' . $file .'.html';
        if (is_file($file)) {

            //加载模板
            require_once MINS. '/vendor/autoload.php';
            $loader = new \Twig_Loader_Filesystem(APP. 'views');
            $twig = new \Twig_Environment($loader, array(
                    /* 'cache' => './compilation_cache', */
                ));
            $template = $twig->loadTemplate($template. '.html');
            $template->display($this->assign ? : 'error');
        } else {
            throw new \Exception ('no fils');
        }
    }
}
