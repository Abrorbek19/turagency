<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class CategoryTitle extends Model
{
    use HasFactory,Translatable;

    protected $table ='category_title';
    protected $primaryKey = 'id';
    protected $fillable = ['category','title','description','content'];

    protected $translatable = ['title','description','content'];

}
