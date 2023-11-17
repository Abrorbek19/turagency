<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Policy extends Model
{
    use HasFactory,Translatable;

    protected $table = 'policy';
    protected $primaryKey = 'id';
    protected $fillable = ['title','description','icon'];

    protected $translatable = ['title','description'];
}
