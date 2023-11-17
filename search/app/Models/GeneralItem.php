<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class GeneralItem extends Model
{
    use HasFactory,Translatable;
    protected $table = 'general_item';
    protected $primaryKey = 'id';
    protected $fillable = ['title','icon'];

    protected $translatable = ['title'];
}
