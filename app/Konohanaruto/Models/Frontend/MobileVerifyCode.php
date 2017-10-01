<?php
namespace App\Konohanaruto\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class MobileVerifyCode extends Model
{
    protected $table = 'mobile_verify_code';
    protected $primaryKey = 'id';
    protected $fillable = ['agent', 'mobile_number', 'code', 'type', 'add_time', 'expire_time'];
    public $timestamps = false;
}