<?php

namespace app\service;

use core\lib\model;
use app\biz\people;

class main extends model
{
    /*
     * 获取列表数据
     *
     * @return mix
     */
    public function lists()
    {
        $res = $this->select($this->table, ['name', 'year']);
        return $res;
    }

    /*
     * 获取单个数据
     *
     * @return mix
     */
    public function getOne()
    {
        $biz = new people();

        $res = $this->get($biz->table, ['name'], ['year' => 24]);
        return $res;
    }
}
