<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class RoomComment extends Model
{
    use HasFactory,Translatable;

    protected $table = 'room_comment';
    protected $primaryKey = 'id';
    protected $fillable = ['position','comfort','price','quality','name','image','comment','date','room_id'];

    protected $translatable = ['name','comment'];
}
