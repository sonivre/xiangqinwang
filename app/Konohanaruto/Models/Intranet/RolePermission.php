<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'admin_role_permission';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    public function addData($data)
    {
        if (empty($data['granted_permissions'])) {
            return false;
        }
        
        foreach ($data['granted_permissions'] as $permissionId) {
            $status = $this->insert(array(
                'role_id' => $data['role_id'],
                'permission_id' => $permissionId
            ));
        }
        
        return $status;
    }
}