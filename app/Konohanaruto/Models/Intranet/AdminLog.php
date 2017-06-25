<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model
{
    protected $table = 'admin_action_log';
    public $timestamps = false;
    
    public function writeAdminActionLog($data)
    {
        foreach ($data as $k => $value) {
            $this->$k = $value;
        }
        return $this->save();
    }
}