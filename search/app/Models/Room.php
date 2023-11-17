<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;

class Room extends Model
{
    use HasFactory,Translatable;
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $fillable = ['title','description','image','price'];


    protected $translatable = ['title','description'];



}
