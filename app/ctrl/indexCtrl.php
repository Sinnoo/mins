<?php
namespace app\ctrl;

class indexCtrl extends \core\mins
{
    public function index()
    {
        $model = new \core\lib\model();
        $sql = "select * from people";
        $res = $model->query($sql);
        var_d($res->fetchAll());
        
        $data = 'hello word';
        $this->assign('data', $data);
        $this->tpl('index.html');
    }
}

?>
