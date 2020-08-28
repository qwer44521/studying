<?php
namespace app\model;

use think\Model;

class Menu extends Model
{
    /**
     * 定义操作表
     * @var string
     */
    protected $table = "qs_menu";
    protected $pk = "id";
}