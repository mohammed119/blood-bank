<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records=Order::where(function ($query)use($request){
            if($request->has('name')){
                $query->where('name','like','%'.$request->name.'%');
            }
            if($request->input('city_id')){
                $query->where('city_id',$request->city_id);
            }
            if($request->input('blood_type_id')){
                $query->where('blood_type_id',$request->blood_type_id);
            }
            if ($request->has('hospital_name')){
                $query->where('hospital_name','like','%'.$request->hospital_name.'%');
            }

        })->with('client')->latest()->paginate(20);
//        dd($records);
        return view('order.index',compact('records'));
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
        $model=Order::findOrFail($id);
        return view('order.show',compact('model'));
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
        $record=Order::findOrFail($id);
        $record->delete();
        flash()->success('Deleted');
        return back();
    }
}
