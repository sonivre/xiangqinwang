<?php
namespace App\Konohanaruto\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class MemberTrends extends Model
{
    protected $table = 'member_trends';
    protected $primaryKey = 'trends_id';
    public $timestamps = false;
    
}