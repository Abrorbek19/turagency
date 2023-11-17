<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class RoomFacility extends Model
{
    use HasFactory,Translatable;

    protected $table = 'room_facility';
    protected $primaryKey = 'id';
    protected $fillable = ['title','description','room_items'];

    protected $translatable = ['title','description','room_items'];
}
