<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class RoomItem extends Model
{
    use HasFactory,Translatable;

    protected $table = 'room_items';
    protected $primaryKey = 'id';
    protected $fillable =['title'];

    protected $translatable = ['title'];
}
