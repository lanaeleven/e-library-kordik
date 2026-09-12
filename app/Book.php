<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    
    protected $fillable = ['title', 'author', 'category', 'file_path', 'total_pages'];
}
