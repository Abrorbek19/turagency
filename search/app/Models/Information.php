<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Information extends Model
{
    use HasFactory,Translatable;

    protected $table = 'information';
    protected $primaryKey = 'id';
    protected $fillable = ['title','address','email','phone','works_day','works_time','instagram_link','youtube_link','facebook_link','twitter_link'];

    protected $translatable = ['title','address','works_day','works_time'];
}
