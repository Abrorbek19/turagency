<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class News extends Model
{
    use HasFactory,Translatable;
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = ['title','description','content','date','person','category','tag'];

    protected $translatable = ['title','description','content','person'];
}
