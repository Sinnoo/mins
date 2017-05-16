<?php
namespace app\ctrl;

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
        $model = new \app\service\test();
        $res = $model->getOne();
        $this->assign('data', 'ceshi');
        $this->tpl('main');
    }
}

?>
