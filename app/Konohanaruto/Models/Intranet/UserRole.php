<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'admin_user_role';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    /**
     * 插入记录
     * 
     * @return boolean
     */
    public function insertData($args)
    {
        return $this->insert($args);
    }
}