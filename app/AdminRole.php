<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class AdminRole extends Model
{
    /**
     * 关联到模型的数据表
     * @var string
     */
    protected $table = 'admin_role';
    protected $primaryKey = 'id';
    public $incrementing = false;
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;
    //

}
