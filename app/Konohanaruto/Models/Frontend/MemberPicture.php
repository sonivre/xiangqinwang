<?php
namespace App\Konohanaruto\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class MemberPicture extends Model
{
    protected $table = 'member_picture';
    protected $primaryKey = 'pic_id';
    public $timestamps = false;
    
}