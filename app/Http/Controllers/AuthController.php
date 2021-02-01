<?php

namespace App\Http\Controllers;
use App\City;
use App\Client;
use App\Governorate;
use App\Mail\ResetPassword;
use App\Notification;
use App\Order;
use App\Token;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\str;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

//use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register (Request $request){
        $inputs=$request->all();
        $rules=[
            'name'=>'required|min:2|max:50',
            'email'=>'required|unique:clients|email',
            'phone'=>'required|unique:clients|digits_between:7,20',
            'password'=>'required|confirmed|min:5|max:50',
            'birth_date'=>'required|date|before_or_equal:today',
            'last_date_donate'=>'required|date|before_or_equal:today',
            'blood_type_id'=>'required|exists:blood_types,id',
            'city_id'=>'required|exists:cities,id'
        ];
        $validator=Validator::make($inputs,$rules);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else{
            $request->merge(['password'=>bcrypt($request->password)]);
            $client=Client::create($request->all());
            $client->api_token=str::random(60);
            $client->save();

            $client->bloodTypes()->attach($request->blood_type_id);

            $client->governorates()->attach($client->city->governorate_id);


            return responseJson(1,'تم الاضافة بنجاح',[
                'api_token'=>$client->api_token,
                'client'=>$client->load('bloodType','city','city.governorate')
            ]);
        }
    }
    public function login(Request $request){
        $inputs=$request->all();
        $rules=[
            'phone'=>'required|digits_between:7,20',
            'password'=>'required|min:5|max:50',
        ];
        $validator=Validator::make($inputs,$rules);
        if($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else{
           $client=Client::where('phone',$request->phone)->first();
           if($client) {
               if (Hash::check($request->password, $client->password)) {
                    return responseJson(1,'تم تسجيل الدخول',[
                        'api_token'=>$client->api_token,
                        'client'=>$client->load('bloodType','city','city.governorate')
                    ]);
               } else {
                   return responseJson(0, 'بيانات الدخول غير صحيحه');
               }
           }else{
               return responseJson(0,'بيانات الدخول غير صحيحه');
           }
        }
    }
    public function profile(Request $request){
        $client=$request->user();
        $inputs=$request->all();
        $rules=[
            'name'=>'min:2|max:50',
            'email'=>Rule::unique('clients')->ignore($client->id),'email',
            'birth_date'=>'date|before_or_equal:today',
            'blood_type_id'=>'exists:blood_types,id',
            'last_date_donate'=>'date|before_or_equal:today',
            'city_id'=>'exists:cities,id',
            'phone'=>Rule::unique('clients')->ignore($client->id),'digits_between:7,20',
            'password'=>'confirmed|min:5|max:50'
        ];
        $validator=Validator::make($inputs,$rules);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else{
            $client->update($request->all());
            if ($request->has('password')){
                $client->password=bcrypt($request->password);
            }
            $client->save();
            //this for upgrade many to many table to edit notification settings but we will not put it here
            // because may it destroy his already notification settings so we will put it in registeration only
//            if($request->has('governorate_id')){
//                $client->governorates()->detach();
//                $a = $client->governorates()->attach($request->governorate_id); //$a=  it will work with toggle
//            }
           // return $a;
            return responseJson(1,'data updated successfully',$client->fresh()->load('city.governorate','bloodType'));
        }
    }

    public function resetPassword(Request $request){
        $client=Client::where('phone',$request->phone)->first();
        if($client){
            $code=rand(1000,9999);
            $update=$client->update(['pin_code'=>$code]);
            if($update){
                //send sms
                //smsMisr($request->phone,'your reset code is : '.$code);
                //send mail
                Mail::to($client->email)
                    ->bcc("saraalaa11155@gmail.com")
                    ->send(new ResetPassword($code));
                return responseJson(1,'please,check your phone',['pin_code_for_test' =>$code]);
            }else{
                return responseJson(0,'حدث خطأ حاول مره اخرى');
            }
        }else{
            return responseJson(0,'لا يوجد اي حساب مرتبط بهذا الهاتف');
        }
    }
    public function newPassword(Request $request){
        $validator=Validator::make($request->all(),[
            'pin_code'=>'required',
            'password'=>'required|confirmed|min:5|max:50']);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }else{

        $client=Client::where('pin_code',$request->pin_code)->first();
//            dd($client);
            if($client){
                $client->password=bcrypt($request->password);
//                $client->password=$request->password;
                $client->pin_code=null;
                $issaved=$client->save();//error with method save
                if($issaved){
                return responseJson(1,'password changed successfully',[
                'api_token'=>$client->api_token,
//                'client'=>$client,
                'client'=>$client->load('city','city.governorate','bloodType')//error with method load
                ]);
                }else{
                    return responseJson(0,'error in saving');
                }
            }else{
                return responseJson(0,'wrong pin code');
            }
        }
    }
    public function notificationSetting(Request $request){
        $inputs=$request->all();
        $rules=[
            'blood_type.*'=>'exists:blood_types,id',
            'governorate'=>'exists:governorates,id'
        ];
        $validator=Validator::make($inputs,$rules);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else {
            //i should validate it
            $client = $request->user();
            if ($client) {
                $client->governorates()->sync($request->governorate);
                $client->bloodTypes()->sync($request->blood_type);
                return responseJson(1, 'success', [
                    'governorate' => $client->governorates,
                    'blood_type' => $client->bloodTypes,
                ]);
            } else {
                return responseJson(0, 'error');
            }
        }
    }
    public function registerNotificationSetting(Request $request){
        $inputs=$request->all();
        $rules=[
            'token'=>'required',
            'type'=>'required|in:android,ios'
        ];
        $validator=Validator::make($inputs,$rules);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else{
            Token::where('token',$request->token)->delete();
            $request->user()->tokens()->create($request->all());
            return responseJson(1,'تم التسجيل بنجاح');

        }
    }
    public function removeToken(Request $request){
        $validator=Validator::make($request->all(),['token'=>'required']);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else{
            Token::where('token',$request->token)->delete();
            return responseJson(1,'deleted successfully');
        }
    }
    public function donationRequestCreate(Request $request){
        //validation order
        $inputs=$request->all();
        $rules=[
            'name'=>'required|min:1|max:80',
            'age'=>'required|integer',
            'blood_type_id'=>'required|exists:blood_types,id',
            'bags_number'=>'required|integer',
            'hospital_name'=>'required|min:1|max:100',
            'city_id'=>'required|exists:cities,id',
            'phone'=>'required|digits_between:7,20',
            'hospital_address'=>'required',
//            'details'=>'',
//            'latitude'=>'',
//            'longitude'=>'',
        ];
        $validator=Validator::make($inputs,$rules);
        if ($validator->fails()){
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }else{
            //create order
            $order=$request->user()->orders()->create($request->all());

            //find clients which suitable for this order (in blood type and governorate) to send notification for them
            $clientsID=$order->city->governorate->clients()-> //in this line i call all clients that suitable for order in governorate
                whereHas('bloodTypes',function ($query)use($request) {
                $query->where('blood_types.id', $request->blood_type_id);
            })->pluck('clients.id')->toArray();



            if (count($clientsID)){

                $notification=Notification::create([
                    'title'=>'يوجد حالة تحتاج متبرع مناسبة لك',
                    'body'=>$request->user()->name.'يحتاج متبرع',
                    'order_id'=>$order->id
                ]);
           

                $notification->clients()->attach($clientsID);


               
                $tokens=Token::whereIn('client_id',$clientsID)->where('token','!=',null)->pluck('token')->toArray();
                if (count($tokens)){
                    $title=$notification->title;
                    $body=$notification->body;
                    $data=[
                        'order_id'=>$order->id
                    ];
                    $send=notifyByFirebase($title,$body,$tokens,$data);
                    return responseJson(1,'ok',$send);
                }else{
                    return responseJson(0,'no device (no tokens)');
                }
            }else{
                return responseJson(0,'no clients suitable for this order');
            }
        }
    }
}
