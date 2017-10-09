<?php
namespace App\Konohanaruto\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class MemberAlbum extends Model
{
    protected $table = 'member_album';
    protected $primaryKey = 'album_id';
    public $timestamps = false;
    
}