<?php
namespace App\Konohanaruto\Models\Intranet;

use Illuminate\Database\Eloquent\Model;

class RegisterRevenue extends Model
{
    protected $table = 'revenue_range';
    protected $primaryKey = 'rev_id';
    public $timestamps = false;
    
}