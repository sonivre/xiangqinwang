<?php
namespace App\Konohanaruto\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class MobileVerifyCode extends Model
{
    protected $table = 'mobile_verify_code';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
}