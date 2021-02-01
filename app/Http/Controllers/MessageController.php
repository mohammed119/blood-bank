<?php

namespace App\Http\Controllers;

use App\Client;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $records=Message::with('client')->where(function ($query)use($request){
        $records=Message::where(function ($query)use($request){
            if($request->input('client_id')){
                $query->where('client_id',$request->client_id);
            }
            if ($request->has('keyword')) {
                $query->where(function ($query) use ($request) {
                    $query->where('message_name', 'like', '%' . $request->keyword . '%');
                    $query->orWhere('message_content', 'like', '%' . $request->keyword . '%');
                });
            }
        })->latest()->paginate(20);
         //dd($records);
        return view('message.index',compact('records','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model=Message::findOrFail($id);
        return view('message.show',compact('model'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Message::findOrFail($id);
        $record->delete();
        flash()->success('Deleted');
        return back();
    }
}
