<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Jihozlar extends Model
{
    use HasFactory,Translatable;
    protected $table = 'jihozlar';
    protected $primaryKey = 'id';
    protected $fillable = ['title','icon'];

    protected $translatable = ['title'];

}
