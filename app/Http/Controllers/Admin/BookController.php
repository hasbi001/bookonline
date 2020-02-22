<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use DB;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
             'code' => 'required|max:10|alpha_num',
             'title' => 'required|max:100',
             'year_release' => 'required|numeric',
             'writer' => 'required|max:100',
             'stock' => 'required|numeric'
         ]);
         $book = Book::create($validatedData);

         return redirect('/admin/book')->with('success', 'Book is successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Book::find($id);
        return view('admin.book.view', ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Book::find($id);
        return view('admin.book.edit', ['id' => $id, 'model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
             'code' => 'required|max:10|alpha_num',
             'title' => 'required|max:100',
             'year_release' => 'required|numeric',
             'writer' => 'required|max:100',
             'stock' => 'required|numeric'
         ]);
         
         Book::whereId($id)->update($validatedData);

         return redirect('/admin/book')->with('success', 'Book is successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect('/admin/book')->with('success', 'Book is successfully deleted');
    }

    public function LoadData(Request $request)
    {
        $book = DB::table('book')
                   ->select('*');

        return datatables()->of($book)
                            ->addColumn('action', function($row){
                                return $btn = '<a href="'.route('admin.book.edit',['id' => $row->id]).'" class="btn btn-primary">Edit</a> | <a href="'.route('admin.book.view',['id' => $row->id]).'" class="btn btn-info">View</a> | <a href="'.route('admin.book.delete',['id' => $row->id]).'" class="btn btn-danger">Delete</a>';
                            })
                            ->rawColumns(['action'])
                            ->addIndexColumn()
                            ->make(true);
    }
}
