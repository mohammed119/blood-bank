<?php

namespace App\Http\Controllers;

use App\City;
use App\Client;
use App\ContactDetail;
use App\Governorate;
use App\Message;
use App\Order;
use App\Post;
use Illuminate\Support\Facades\Validator;

//use Dotenv\Validator;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function governorates(){
        $governorates=Governorate::all();
        return responseJson(1,'success',$governorates);
    }
    public function cities(Request $request){
        $cities=City::where(function ($query)use($request){
            if($request->has('governorate_id')){
                $query->where('governorate_id',$request->governorate_id);
            }
        })->get();
        return responseJson(1,'success',$cities);
    }
    public function posts(Request $request){
//        $posts= Post::paginate(10);
//        $posts=Post::with('category')->paginate(10);
//        return responseJson(1,'success',$posts->load('category'));
        $posts=Post::with('category')->where(function ($query)use($request){
            if($request->has('category_id')){
                $query->where('category_id',$request->category_id);
            }
            if ($request->has('keyword')){
                $query->where(function ($query)use($request){
                    $query->where('title','like','%'.$request->keyword.'%');
                    $query->orWhere('text','like','%'.$request->keyword.'%');
                });
            }
        })->latest()->paginate(10);
        return responseJson(1,'success',$posts);
    }
    public function showPost(Request $request){
        $post=Post::find($request->id);
        if($post){
            return responseJson(1,'success',$post);
        }else{
            return responseJson(0,'not found post',$post);
        }
    }
    public function configuration(){
        $data=ContactDetail::all();
        return responseJson(1,'success',$data);
    }
    public function contact(Request $request){
        $client=Client::where('api_token',$request->api_token)->first();

        $input=$request->all();
        $rules=[
            'message_name'=>'required|max:70',
            'message_content'=>'required'
        ];
        $validator=Validator::make($input,$rules);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else{
            $message=new Message();
            $message->client_id=$client->id;
            $message->message_name=$request->message_name;
            $message->message_content=$request->message_content;
            $isSaved=$message->save();
            if($isSaved){
                return responseJson(1,'success message',[
                    'name'=>$client->name,
                    'email'=>$client->email,
                    'phone'=>$client->phone,
                    'message_name'=>$message->message_name,
                    'message_content'=>$message->message_content,
                ]);
            }else{
                return responseJson(0,'error in saving');
            }
        }
    }
    public function postFavorite(Request $request){
        $inputs=$request->all();
        $rules=[
          'post_id'=>'required|exists:posts,id'
        ];
        $validator=Validator::make($inputs,$rules);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else {
            $request->user()->posts()->toggle($request->post_id);
            return responseJson(1,'success',$request->user()->posts);
        }
    }
    public function notificationList(Request $request){
//        $notifications = $request->user()->notifications()->toSql();
        $notifications = $request->user()->notifications()->with('order')->paginate(10);
        return responseJson(1,'this is a list of notification',$notifications);
    }
    public function orders(Request $request){
        $orders = Order::with('bloodType', 'city')->where(function ($query) use ($request) {
            if ($request->has('city_id')) {
                $query->where('city_id', $request->city_id);
            }
            if ($request->has('blood_type_id')) {
                $query->where('blood_type_id', $request->blood_type_id);
            }
        })->latest()->paginate(10);
        if (count($orders)>0) {
            return responseJson(1, 'list of orders', $orders);
        }else{
            return responseJson(1,'no orders',null);
        }
    }
    public function showOrder(Request $request){
        $order=Order::find($request->order_id);
        if ($order) {
            return responseJson(1,'order detail',$order->load('bloodType','city'));
        }else{
            return responseJson(0,'no order with this id');
        }
    }
}
