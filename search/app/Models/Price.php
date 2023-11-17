<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Price extends Model
{
    use HasFactory,Translatable;

    protected $table = 'price';
    protected $primaryKey = 'id';
    protected $fillable = ['icon','title','description'];

    protected $translatable = ['icon','title','description'];
}
