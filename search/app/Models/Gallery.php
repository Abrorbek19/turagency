<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Gallery extends Model
{
    use HasFactory,Translatable;
    protected $table = 'gallery';
    protected $primaryKey = 'id';
    protected $fillable = ['title','image'];
    protected $translatable = ['title'];
}
