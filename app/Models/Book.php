<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['id', 'code', 'title', 'year_release', 'writer', 'stock', 'created_at', 'updated_at'];
    protected $table = 'book';

    public static function getOption()
    {
    	$model = Book::all();
    	$opt = "";
    	foreach ($model as $value) {
    		if ($value->stock != 0) {
    			$opt .= "<option value='".$value->id."' >".$value->title."</option>";
    		}
    	}
    	return $opt;
    }
}
