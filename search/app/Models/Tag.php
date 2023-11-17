<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Tag extends Model
{
    use HasFactory,Translatable;

    protected $table = 'tags';
    protected $primaryKey = 'id';
    protected $fillable = ['title'];

    protected $translatable = ['title'];
}
