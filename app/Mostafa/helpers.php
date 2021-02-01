<?php
/**
 * Created by PhpStorm.
 * User: Me
 * Date: 3/3/2019
 * Time: 6:03 AM
 */
function responseJson($status,$message,$data=null)
{
    $response=[
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
    ];
    return response()->json($response);
}
function smsMisr($to, $message)
{
    $url = 'https://smsmisr.com/api/webapi/?';
    $push_payload = array(
        "username" => "*****",
        "password" => "*****",
        "language" => "2",
        "sender" => "ipda3",
        "mobile" => '2' . $to,
        "message" => $message,
    );
    $rest = curl_init();
    curl_setopt($rest, CURLOPT_URL, $url.http_build_query($push_payload));
    curl_setopt($rest, CURLOPT_POST, 1);
    curl_setopt($rest, CURLOPT_POSTFIELDS, $push_payload);
    curl_setopt($rest, CURLOPT_SSL_VERIFYPEER, true);  //disable ssl .. never do it online
    curl_setopt($rest, CURLOPT_HTTPHEADER,
        array(
            "Content-Type" => "application/x-www-form-urlencoded"
        ));
    curl_setopt($rest, CURLOPT_RETURNTRANSFER, 1); //by ibnfarouk to stop outputting result.
    $response = curl_exec($rest);
    curl_close($rest);
    return $response;
}


function notifyByFirebase($title,$body,$tokens,$data = [])        // paramete 5 =>>>> $type
{
// https://gist.github.com/rolinger/d6500d65128db95f004041c2b636753a
// API access key from Google FCM App Console
    // env('FCM_API_ACCESS_KEY'));
//    $singleID = 'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd';
//    $registrationIDs = array(
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
//    );
    $registrationIDs = $tokens; //ده الtoken
// prep the bundle
// to see all the options for FCM to/notification payload:
// https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support
// 'vibrate' available in GCM, but not in FCM
    $fcmMsg = array(  // هنا دي array بتاخد الbody و الtitlt
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
// I haven't figured 'color' out yet.
// On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
// On another phone, it was the color of the app icon. (ie: LG K20 Plush)
// 'to' => $singleID ;      // expecting a single ID
// 'registration_ids' => $registrationIDs ;     // expects an array of ids
// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
    $fcmFields = array(
        'registration_ids' => $registrationIDs,//هبعت لمين الtokens اللي جبناها من الquery
        'priority' => 'high',
        'notification' => $fcmMsg,//دي بتخليه يرن فالتليفون ويطلع البينات اللي فالنوتيفيكيشن لو ماشغلتش دي مش هيرن هيسمع في الbackground بس ويبدا بتاع الموبايل يهندل ويبعت اللي هو عاوزو فممكن بتاع الموبايل يقولي ماتبعتيش النوتيفيكيشن سيبيلي انا الحريه ان اخليه يرن ولا لا فممكن ان ابعت حاجتين واحده للios كده ولا كده لازم يرن عندو فاحط فيها النوتيفيكيشن وواحده للاندرويد مابعتهاش عشان هو يتحكم فيها براحتو
        'data' => $data //دي الdata عادي
   //بتاع الموبايل ممكن يسالني هتبعتيهالي نوتيفيكيشن ولا داتا فابقى عارفه هو عاوز مني ايه
    );
    $headers = array(
        'Authorization: key='.env('FIREBASE_API_ACCESS_KEY'), //fire base access key it's a key that allow me to send notification
        'Content-Type: application/json'
    );
    // if($type == 'client')
    // {
    //     $headers = array(
    //         'Authorization: key='.env('API_ACCESS_KEY_client'),
    //         'Content-Type: application/json'
    //     );
    // }
    // if($type == 'driver')
    // {
    //     $headers = array(
    //         'Authorization: key='.env('API_ACCESS_KEY_driver'),
    //         'Content-Type: application/json'
    //     );
    // }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send'); //الرابط اللي بيتبعت عليه ده الapi بتاع الfirebase اللينك بتاعو يعني
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // headers اللي بنعمل منها الاوثنتيكيشن
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields)); //دي البارامترز اللي بتتبعت في الريكويست كpost عشان ينفذلنا الريكويست اللي احنا عاوزينو انو يبعت اشعارات للناس
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
/**
 * @param $to
 * @param $message
 * @return mixed
 */



