<?php

namespace app\service;

use core\lib\model;
use app\biz\people;

class test extends model
{
    public function lists()
    {
        $res = $this->select($this->table, ['name', 'year']);
        return $res;
    }

    public function getOne()
    {
        //表
        $biz = new people();

        $res = $this->get($biz->table, ['name'], ['year' => 24]);
        return $res;
    }
}
