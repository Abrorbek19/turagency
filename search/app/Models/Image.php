<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Image extends Model
{
    use HasFactory,Translatable;
    protected $table  = 'image';
    protected $primaryKey = 'id';
    protected $fillable = ['category','image','title'];

    protected $translatable = ['title'];

}
