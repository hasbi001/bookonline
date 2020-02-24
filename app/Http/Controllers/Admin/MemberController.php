<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Member;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = Validator::make($request->all(), [ 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8' ]);
         
         if($validatedData->fails()) {
          return redirect('/admin/member/create')->withErrors($validator) ->withInput();
} else {
         Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

         return redirect('/admin/member')->with('success', 'Member is successfully saved');
} 
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Member::find($id);
        return view('admin.member.view', ['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Member::find($id);
        return view('admin.member.edit', ['id' => $id, 'model' => $model]);
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
         $dataPost = array();
         $validatedData = Validator::make($request->all(), [ 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'string|min:8' ]);
         if($validatedData->fails()) {
         return redirect('/admin/member/create')->withErrors($validator) ->withInput();
         } 
         else
         {
           $dataPost = [
            'name' => $request->name,
            'email' => $request->email
        ];
           if(!empty($request->password)) {$dataPost['password'] = Hash::make($request->password);} 
           Member::where('id', $id)->update($dataPost);
          return redirect('/admin/member')->with('success', 'Member is successfully Updated');
         } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect('/admin/book')->with('success', 'Member is successfully deleted');
    }

    public function LoadData(Request $request)
    {
        $member = DB::table('member')
                   ->select('*');

        return datatables()->of($member)->addColumn('action', function($row){
                                return $btn = '<a href="'.route('admin.member.edit',['id' => $row->id]).'" class="btn btn-primary">Edit</a> | <a href="'.route('admin.member.view',['id' => $row->id]).'" class="btn btn-info">View</a> | <a href="'.route('admin.member. delete',['id' => $row->id]).'" class="btn btn-danger">Delete</a>';
                            })
                            ->rawColumns(['action'])
                            ->addIndexColumn()
                            ->make(true);
    }
}
