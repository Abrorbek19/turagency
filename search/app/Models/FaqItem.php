<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class FaqItem extends Model
{
    use HasFactory,Translatable;

    protected $table = 'faq_item';
    protected $primaryKey = 'id';
    protected $fillable = ['category','title','content'];

    protected $translatable = ['title','content'];
}
