<?php

namespace core\lib;
use core\lib\conf;

/*
 * 路由类
 *
 * 自动转化url到对应控制器
 */
class route
{
    public $ctrl;
    public $action;

    /*
     * 路由
     *
     * @return
     */
    public function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $params = explode('&', $url);
        $url = explode('=', $params[0])[1];
        
        if (isset($url) && $url != null) {
            $patharr = explode('.', trim($url));
            if (isset($patharr[0])) {
                $this->ctrl = $patharr[0];
            }
            if (isset($patharr[1])) {
                $this->action = $patharr[1];
            }

            #get参数
            $count = count($params);
            $i = 1;
            while ($i < $count) {
                $para = explode('=', $params[$i]);
                if (isset($para[1]) && $para[1] != null) {
                    $_ET[$para[0]] = $para[1];
                }
                $i++;
            }
        } else {
            $this->ctrl = conf::get('CTRL', 'route');
            $this->action = conf::get('ACTION', 'route');;
        }
    }
}
