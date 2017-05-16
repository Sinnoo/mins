<?php
namespace app\biz;

class people
{
    public $table;

    /*
     * 设置表名
     *
     * @return str
     */
    public function __construct()
    {
        $this->table = 'people';
    }
}
