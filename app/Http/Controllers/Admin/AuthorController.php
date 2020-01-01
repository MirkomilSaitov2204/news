<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = User::all();

        return view('admin.authors.list')->with('authors',$authors);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role =  Role::all();
        return view('admin.authors.create')->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = new User();
        $this->validate($request, [
           'name' =>'required',
           'email' =>'required|unique:users',
           'password' =>'required',
           'role' =>'required'
       ]);
       $author->name = $request->name;
       $author->email = $request->email;
       $author->password =Hash::make($request->password);
       $author->type = 2;
       $author->save();
           foreach($request->role as $value){
               $author->attachRole($value);
           }

           Session::flash('success','Authors Successfully Created');
           return redirect()->route('authors');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = User::find($id);
        $role = Role::all();

        return view('admin.authors.edit')->with('author', $author)->with('role', $role);
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
        $author = User::find($id);
        $this->validate($request, [
            'role' =>'required'
       ]);
       $author->name = $request->name;
       $author->email = $request->email;

       DB::table('role_user')->where('user_id',$id)->delete();
       $author->save();

       foreach($request->role as $value){
        $author->attachRole($value);
        }


       Session::flash('success','Authors Successfully Updated');
       return redirect()->route('authors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        Session::flash('success','Authors Successfully Updated');
        return redirect()->route('authors');


    }
}
