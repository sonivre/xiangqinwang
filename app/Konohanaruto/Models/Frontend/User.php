<?php
namespace App\Konohanaruto\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
    
}