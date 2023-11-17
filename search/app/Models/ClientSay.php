<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class ClientSay extends Model
{
    use HasFactory,Translatable;
    protected $table = 'client_say';
    protected $primaryKey = 'id';
    protected $fillable =['name','description','image','date'];

    protected $translatable = ['name','description'];
}
