<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBook extends Model
{
    use HasFactory;

    protected $table = 'room_book';
    protected $primaryKey = 'id';
    protected $fillable = ['arrival_date','departure_date','adults','children','name','phone','email','room_id'];
}
