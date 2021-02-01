<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        $records=Client::paginate(20);

        $records=Client::with('city')->where(function ($query)use($request){
            if($request->input('city_id')){
                $query->where('city_id',$request->city_id);
            }
            if ($request->has('name')){
                $query->where('name','like','%'.$request->name.'%');
            }
            if ($request->has('phone')){
                    $query->where('phone','like','%'.$request->phone.'%');
            }
        })->latest()->paginate(20);

        return view('client.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        $record->delete();
        flash()->success("تم الحذف بنجاح");
        return back();
        
    }

    public function activate($id){
        $client=Client::find($id);
        $client->is_active=true;
        $client->save();
        flash()->success('activated');
        return back();
    }
    public function deactivate($id){
        $client=Client::find($id);
        $client->is_active=false;
        $client->save();
        flash()->success('deactivated');
        return back();
    }
}
