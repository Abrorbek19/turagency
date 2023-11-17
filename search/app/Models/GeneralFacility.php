<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class GeneralFacility extends Model
{
    use HasFactory,Translatable;
    protected $table = 'general_facility';
    protected $primaryKey = 'id';
    protected $fillable = ['title','item'];

    protected $translatable = ['title','item'];
}
