<?php
namespace app\ctrl;
use app\biz\people;
use core\lib\model;

class indexCtrl extends \core\mins
{
    public function index()
    {
        $model = new medoo();
        $c = $model->select('people', '*');
        var_d($c);exit;
        //$this->assign('data', $data);
        //$this->tpl('index.html');
    }
}

?>
