<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function getAllDataJson()
    {
        $model = Book::all();

        return $model->toJson();
    }
}
