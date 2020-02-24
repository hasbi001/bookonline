<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use App\Models\Member;
use App\Models\Book;
use DB;

class PinjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pinjam.index');
    }

     public function LoadData(Request $request)
    {
        $book = DB::table('book')
                   ->select('*');

        return datatables()->of($book)
                            ->addColumn('action', function($row){
                                return $btn = '<a href="javascript:void(0)" class="btn btn-primary" onclick="approval('.$row->id.',1)">Approve </a> | <a href="javascript:void(0)" class="btn btn-primary" onclick="approval('.$row->id.',2)">Reject</a>';
                            })->addColumn('member', function($row){
    $member = Member::find($row->user_id);
    return $member->name;
})->addColumn('judul', function($row){
    $book = Book::find($row->book_id);
    return $book->title;
})->editColumn('status', function($row) { 
  $status = 'wait';
  if($row->status == 1) { 
   $status = 'approved';
  } else if($row->status == 2) {
    $status = 'rejected';
  } else { $status = 'wait';} 
return $status;})->rawColumns(['action', 'member', 'judul' ])->addIndexColumn()->make(true);
    }

    Public function approval(Request $request) {
    $model = Pinjam::find($request->id);
    $model->status = $request->status;
    if($model->save()){
        return response()->json(['status' => 200, 'message'=>'success']);
    }
    else
    {
       return response()->json(['status' => 401, 'message'=>'data has not change, try again! ']);
    }      
  } 
}
