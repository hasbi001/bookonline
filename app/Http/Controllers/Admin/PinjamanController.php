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
        $pinjam = DB::table('pinjam')
                   ->select('*');

        return datatables()->of($pinjam)
          ->addColumn('action', function($row){
              $btn = "";
              if ($row->status == 0) {
                $btn = '<a href="javascript:void(0)" class="btn btn-primary" onclick="approval('.$row->id.',1)">Approve </a> | <a href="javascript:void(0)" class="btn btn-primary" onclick="approval('.$row->id.',2)">Reject</a>';
              }
              return $btn;
              
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
            } elseif($row->status == 2) {
              $status = 'rejected';
            } elseif ($row->status == 3) {
              $status = 'come back';
            } else { $status = 'wait';} 
              return $status;
            })->rawColumns(['action', 'member', 'judul' ])->addIndexColumn()->make(true);
    }

    Public function store(Request $request) {
      $model = Pinjam::find($request->id);
      $model->status = $request->status;
      if($model->save()){
          if ($request->status == 1) {
             $book = Book::find($model->book_id);
             if ($book->stock > 0) {
               $book->stock = $book->stock - 1;
               $book->save();
             }
          }
          return response()->json(['status' => 200, 'message'=>'success']);
      }
      else
      {
         return response()->json(['status' => 401, 'message'=>'data has not change, try again! ']);
      }      
    } 
}
