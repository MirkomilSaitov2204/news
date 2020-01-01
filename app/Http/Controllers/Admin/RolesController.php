<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Support\Facades\DB;
use Session;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('admin.roles.list')->with('roles',$roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission =  Permission::all();
        return view('admin.roles.create')->with('permission', $permission);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $role = new Role();
         $this->validate($request, [
            'name' =>'required|unique:roles',
            'description' =>'required',
            'display_name' =>'required',
            'permission' =>'required'
        ]);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->display_name = $request->display_name;
        $role->save();
            foreach($request->permission as $value){
                $role->attachPermission($value);
            }

            Session::flash('success','Role Successfully Created');
            return redirect()->route('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::all();

        return view('admin.roles.edit')->with('role', $role)->with('permission', $permission);

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

        $role = Role::find($id);
         $this->validate($request, [

            'permission' =>'required'
        ]);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->display_name = $request->display_name;
        $role->save();

        DB::table('permission_role')->where('role_id',$id)->delete();
            foreach($request->permission as $value){
                $role->attachPermission($value);
            }


        Session::flash('success','Role Successfully Updated');
        return redirect()->route('roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::where('id', $id)->delete();

        Session::flash('success','Role Successfully Deleted');
        return redirect()->route('roles');

    }
}
