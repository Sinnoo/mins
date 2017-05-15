<?php
namespace app\ctrl;

use app\biz\people;
use core\lib\model;

class test extends \core\mins
{
    public function index()
    {
        $model = new \app\service\test();
        $res = $model->getOne();
        var_d($res);
        $this->assign('data', $data);
        $this->tpl('index');
    }
}

?>
