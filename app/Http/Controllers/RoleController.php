<?php

namespace App\Http\Controllers;

use App\Role;
use App\Post;
use Illuminate\Http\Request;
use  Illuminate\Http\Response;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $records=Role::paginate(20);
        $records=Role::all();
        return view('role.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd('here');
        $this->validate($request,['name'=>'required|unique:roles,name',
            'permissions_list'=>'required|array']);
        $record=Role::create($request->all());
        $record->permissions()->attach($request->permissions_list);
        flash()->success('success');
        return redirect(route('role.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $records=Post::where('role_id',$id)->get();
//        return view('post.index',compact('records'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model=Role::findOrFail($id);
        return view('role.edit',compact('model'));
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
//        $user=$request->user();
//        dd($user);
//        $this->validate($request,['name'=>'required',
//            Rule::unique('roles')->ignore($user->id), //////erorrrrrrrrrrrrrrrrrrrrrrrr

        $this->validate($request,['name'=>'required|unique:roles,name,'.$id,
            'permissions_list'=>'required|array']);
        $record=Role::findOrFail($id);
        $record->update($request->all());
        $record->permissions()->sync($request->permissions_list);
        flash()->success('Edited');
        return redirect(route('role.index'));
//        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd('here');
        $record=Role::findOrFail($id);
//        dd($record);
        $record->delete();
        flash()->success('Deleted');
        return back();
    }
}
