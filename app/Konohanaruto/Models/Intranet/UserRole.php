<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'permissions';
    protected $primaryKey = 'permission_id';
    public $timestamps = false;
}