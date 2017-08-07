<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'admin_roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;
    
    public function addRole($formData = array())
    {
        if (empty($roleName = $formData['role_name'])) {
            return false;
        }
        
        $this->action_user_id = $formData['user_id'];
        $this->role_name = $formData['role_name'];
        $this->create_time = date('Y-m-d H:i:s');
        $this->update_time = date('Y-m-d H:i:s');
        $status = $this->save();
        
        if ($status) {
            return $this->role_id;
        }
        
        return false;
    }
}