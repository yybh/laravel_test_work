<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = ['title', 'author','num','borrow_num','location','isbn'];
}
