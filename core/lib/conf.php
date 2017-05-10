<?php 
namespace core\lib;

class conf
{
    static public $conf = [];

    /*
     * 动态加载单个配置项
     *
     * @name 配置项变量名
     * @file 配置项文件名
     * @return mix
     */
    static public function get($name, $file)
    {
        #已经存在加载的配置项
        if (isset(self::$conf[$file])) {
            return self::$conf[$file][$name];
        }

        $path = MINS. '/core/config/' .$file. '.php';
        if (is_file($path)) {
            $conf = include $path;
            if (isset($conf[$name])) {
                self::$conf[$file] = $conf;
                return $conf[$name];
            } else {
                throw new \Exception ('no config options');
            }
        } else {
            throw new \Exception ('no config files');
        }
    }

    /*
     * 动态加载所有配置项
     *
     * @file 配置项文件名
     * @return mix
     */
    static public function getAll($file)
    {
        #已经存在加载的配置项
        if (isset(self::$conf[$file])) {
            return self::$conf[$file];
        }
        $path = MINS. '/core/config/' .$file. '.php';
        if (is_file($path)) {
            $conf = include $path;
            if (isset($conf)) {
                self::$conf[$file] = $conf;
                return $conf;
            } else {
                throw new \Exception ('no config options');
            }
        } else {
            throw new \Exception ('no config files');
        }
    }
}
