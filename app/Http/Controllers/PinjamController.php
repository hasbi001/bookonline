<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pinjam;
use App\Models\Member;
use App\Models\Book;
use DB;
use Auth;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pinjam.index');
    }

     public function LoadData(Request $request)
    {
        $book = DB::table('book')
                   ->select('*');

        return datatables()->of($book)
                            ->addColumn('action', function($row){
                                return $btn = '<a href="'.route('pinjam.pengajuan',['id' => $row->id]).'" class="btn btn-primary">Pinjam</a> ';
                            })
                            ->rawColumns(['action'])
                            ->addIndexColumn()
                            ->make(true);
    }

    public function create() {
       return view('pinjam.create');
    } 
    public function store(Request $request) {

       $validatedData = Validator::make($request->all(), [ 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8' ]);
         
         if($validatedData->fails()) {
          return redirect('/admin/member/create')->withErrors($validator) ->withInput();
}

       $model = new Pinjam;
       $model->user_id = Auth::user()->id;
       $model->book_id = $request->book_id;
       $model->startdate = $request->startdate;
       $model->enddate = $request->enddate;
    } 
}
