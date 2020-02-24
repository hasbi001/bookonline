<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use App\Models\Member;
use App\Models\Book;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;

class PinjamController extends Controller
{
    /*
      status
      0 = wait
      1 = approve
      2 = rejected
      3 = come back
    */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.pinjam.index');
    }

     public function LoadData(Request $request)
    {
        $book = DB::table('book')
                   ->select('*');

        return datatables()->of($book)
                            ->addIndexColumn()
                            ->make(true);
    }

    public function create() {
      $optbook = Book::getOption();
      return view('member.pinjam.create',['optbook'=>$optbook]);
    } 

    public function store(Request $request) {

       $validatedData = Validator::make($request->all(), [ 'book_id' => 'required',
            'startdate' => 'required|date',
            'enddate' => 'required|date' ]);
         
        if($validatedData->fails()) {
          return redirect()->route('pinjam.pengajuan')->withErrors($validatedData)->withInput();
        }
        else
        {
            Pinjam::create([
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'startdate' => date_format(date_create($request->startdate),'Y-m-d'),
                'enddate' => date_format(date_create($request->enddate),'Y-m-d'),
              ]);   

            return redirect('/member')->with('message', 'Pengajuan peminjaman buku anda telah disimpan. mohon tunggu proses approval');;     
        }
    } 

    public function LoadDataPinjam(Request $request)
    {
       $pinjam = DB::table('pinjam')
                   ->select('*')->where('user_id',$request->userid)->whereIn('status', [0,1,3])->orderBy('status', 'asc');

        return datatables()->of($pinjam)
          ->addColumn('action', function($row){
              return $btn = '<a href="javascript:void(0)" id="btnpinjam_'.$row->id.'" class="btn btn-primary" onclick="comeback('.$row->id.')">Return </a> ';
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

    public function update(Request $request)
    {
      $model = Pinjam::find($request->id);
      $model->status = 3;
      $model->returndate = date("Y-m-d H:i:s");
      if($model->save()){
          $book = Book::find($model->book_id);
          $book->stock = $book->stock + 1;
          $book->save();
          return response()->json(['status' => 200, 'message'=>'success']);
      }
      else
      {
         return response()->json(['status' => 401, 'message'=>'data has not change, try again! ']);
      } 
    }
}
