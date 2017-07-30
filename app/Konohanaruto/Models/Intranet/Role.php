<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'xqw_admin_roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;
}