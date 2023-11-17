<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class CommentBlog extends Model
{
    use HasFactory;

    protected $table = 'comment_blog';
    protected $primaryKey = 'id';
    protected $fillable = ['name','comment','date','status','email','blog_id'];

}
