<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use  Illuminate\Http\Response;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (!auth()->user()->can('show_post'))
//        {
//            abort(403);
//        }
        $records=Post::paginate(20);
        return view('post.index',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();
        return view('post.create',compact('categories'));
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
        $this->validate($request,
            ['title'=>'required',
              'text'=>'required',
              'image'=>'required|image|mimes:png,jpeg,jpg,gif,svg|max:5120',
              'category_id'=>'required|exists:categories,id'
        ]);
        $image=$request->image;
//        dd($image->getClientOriginalExtension());
        $storedImageName=time().'.'.$image->getClientOriginalExtension();
        $destinationPath=public_path('image');
        $newImage=$request->image->move($destinationPath,$storedImageName);
//        $request->image=$image;
        $post=Post::create($request->all());
//        $post->image=$newImage;
        $post->image=$storedImageName;
        $post->save();
        flash()->success('success');
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model=Post::findOrFail($id);
        return view('post.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::pluck('name', 'id')->toArray();

        $model=Post::findOrFail($id);
        return view('post.edit',compact('model','categories'));
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
        $this->validate($request,
            ['title'=>'required',
                'text'=>'required',
                'image'=>'required|image|mimes:png,jpeg,jpg,gif,svg|max:5120',
                'category_id'=>'required|exists:categories,id'
            ]);
        $record=Post::findOrFail($id);
        $record->update($request->all());
        if ($request->hasFile('image')) {

            $image = $request->image;
//        dd($image->getClientOriginalExtension());
            $storedImageName = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('image');
            $newImage = $request->image->move($destinationPath, $storedImageName);
//            $record->image=$newImage;
            $record->image=$storedImageName;
            $record->save();
        }
        flash()->success('Edited');
//        return redirect(route('post.index'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record=Post::findOrFail($id);
        $record->delete();
        flash()->success('Deleted');
        return back();
    }
}
