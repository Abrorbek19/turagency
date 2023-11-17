<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

}
