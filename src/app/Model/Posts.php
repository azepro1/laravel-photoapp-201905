<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = ['name','path', 'nickname', 'caption'];
}
