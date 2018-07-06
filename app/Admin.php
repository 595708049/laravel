<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /**
     * 关联到模型的数据表
     * @var string
     */
    protected $table = 'admin';
    // 主键id
    protected $primaryKey = 'id';
    
    public $incrementing = false;
    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    public function role()
    {
        return $this->belongsToMany('App\Role', 'admin_role', 'admin_id', 'role_id');
    }
}
