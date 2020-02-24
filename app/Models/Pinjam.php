<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    protected $fillable = ['id', 'user_id', 'book_id', 'startdate', 'enddate', 'returndate', 'status', 'created_at', 'updated_at'];
    protected $table = 'pinjam';

   public function user() {
     return $this->belongsTo('App\Models\Member', 'user_id');
   } 
}
