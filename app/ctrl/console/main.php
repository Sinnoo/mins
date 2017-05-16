<?php
namespace app\ctrl\console;

use app\biz\people;
use core\lib\model;

class main extends \core\mins
{
    /*
     * 初始化页面
     *
     * @return mix
     */
    public function index()
    {
        $model = new \app\service\main();
        $res = $model->getOne();
        $this->assign('data', '您好!');
        $this->tpl('main');
    }
}

?>
