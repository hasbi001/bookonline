<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['id', 'code', 'title', 'year_release', 'writer', 'stock', 'created_at', 'updated_at'];
    protected $table = 'book';
}
