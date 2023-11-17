<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Event extends Model
{
    use HasFactory,Translatable;

    protected $table = 'event';
    protected $primaryKey = 'id';
    protected $fillable = ['title','content','image','room_item'];
    protected $translatable = ['title','content','room_item'];
}
