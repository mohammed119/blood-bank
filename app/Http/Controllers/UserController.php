<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getlogin(){
        return view('user.login');
    }
    public function login(Request $request){
        $rules=[
            'email'=>'required|email',
            'password'=>'required|min:3|max:10'
        ];
        $this->validate($request,$rules);
        $user=Auth::user();

        $currentUser=User::where('email',$request->email)->first();
        if ($currentUser){

            if (Hash::check($request->password,
                $currentUser->password)){
                flash()->success('login successfully');
                return back();
            }else{
                flash()->error('wrong password');
                return back();
            }
        }
        else{
            flash()->error('wrong email');
            return back();
        }

    }
    public function changePassword(){
        return view('user.reset-password');
    }
    public function changePasswordSave(Request $request){
        $rules=[
            'old_password'=>'required',
            'password'=>'required|confirmed'
        ];
        $this->validate($request,$rules);
        $user=Auth::user();
//        if (Hash::check($request->old_password,$user->input('password'))){
        if (Hash::check($request->old_password,$user->password)){
            $user->password=bcrypt($request->old_password);
            $user->save;
            flash()->success('password changed successfully');
            return back();
        }
        else{
            flash()->error('wrong password');
            return back();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records=User::all();
        return view('user.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'email|unique:users,email',
            'password'=>'required|confirmed',
            'roles_list'=>'required'
        ]);
        $request->merge(['password' => bcrypt($request->password)]);
        $record=User::create($request->all());
        $record->roles()->attach($request->roles_list);
        flash()->success('success');
        return redirect(route('user.index'));
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
        $model=User::findOrFail($id);
        return view('user.edit',compact('model'));
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
        $this->validate($request,[
            'name'=>'required',
            'email'=>'email|unique:users,email,'.$id,
            'password'=>'confirmed',
            'roles_list'=>'required'
        ]);
        $record=User::findOrFail($id);
        $record->roles()->sync($request->roles_list);
        $request->merge(['password' => bcrypt($request->password)]);
        $record->update($request->all());
        flash()->success('Edited');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=User::findOrFail($id);
//        dd($record);
        $record->delete();
        flash()->success('Deleted');
        return back();
    }
}
