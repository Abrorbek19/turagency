<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class RoomImages extends Model
{
    use HasFactory,Translatable;

    protected $table = 'room_images';
    protected $primaryKey = 'id';
    protected $fillable  = ['title','image','category'];

    protected $translatable = ['title'];
}
