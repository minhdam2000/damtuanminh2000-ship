<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Credential;
use App\Broker;
use DB;
use File;
use App\Consumer;
use App\Staff;
use App\Accountant;

use App\Project;
use App\Area;
use App\Zone;
use App\Historyzone;

use Mail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

use Carbon\Carbon;
class NotiController extends Controller
{	
   function sendMessage2(){
        $content = array(
            "en" => 'English Message'
            );
        
         $fields = array(
        'app_id' => "e935d517-019c-48b1-a3da-982624168815",
            'filters' => array(array("field" => "tag", "key" => "test", "relation" => "=", "value" => "1")),
            'data' => array("foo" => "bar"),
            'contents' => $content
        );
        
        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic MGI3NDcwNjQtNDYxZC00ZGM0LWIzZDktOGMzZjgwODI4ZDBk'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    

  function sendMessage() {
    $content      = array(
        "en" => 'Đã kích hoa tài khoản thành công'
    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Chi tiết",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://lopital.vn"
    ));
   $fields = array(
      'app_id' => "e935d517-019c-48b1-a3da-982624168815",
          'filters' => array(array("field" => "tag", "key" => "test", "relation" => "=", "value" => "1")),
          'data' => array("foo" => "bar"),
          'contents' => $content
      );
        
    
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MGI3NDcwNjQtNDYxZC00ZGM0LWIzZDktOGMzZjgwODI4ZDBk'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
}


   public function active(){


      $fields = array( 
      'app_id' => "e935d517-019c-48b1-a3da-982624168815", 
      'identifier' => "MGI3NDcwNjQtNDYxZC00ZGM0LWIzZDktOGMzZjgwODI4ZDBk", 
      'language' => "en", 
      'timezone' => "-28800", 
      'device_type' => "5", 
      'tags' => array("test" => "bar") 
      ); 

      $fields = json_encode($fields); 
      // print("\nJSON sent:\n"); 
      // print($fields); 

      $ch = curl_init(); 
      curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/players"); 
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
      curl_setopt($ch, CURLOPT_HEADER, FALSE); 
      curl_setopt($ch, CURLOPT_POST, TRUE); 
      curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); 
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 

      $response = curl_exec($ch); 
      curl_close($ch); 

if (json_decode($response)->success == true){
           return Redirect()->back()->with('notification', 'Kích hoạt tài khoản thành công');

}else{

           return Redirect()->back()->with('warning', 'Lỗi kích hoạt');
}
$return["allresponses"] = $response; 
$return = json_encode( $return); 

print("\n\nJSON received:\n"); 
dd($return); 
print("\n");
    }



public function sendTest(){

// $zone_ids =DB::table("zone_process")->where("zone_process.zone_id","<",0)->get();
// dd($zone_ids);

// $zone_ids = DB::table("zone_process")->where("zone_process.zone_id","<",0)
// ->pluck("zone_id")->toArray();
// // dd($zone_ids);
//  DB::table('zone')->where('zone.consumer_id',327)
//  ->where('zone.id',"<>",843)
//  ->update([
//             'staff_id' => 0,
//             'consumer_id' =>0,
//             'state' => 0,
//             'lock_user' => 0,
//             'lock_time' => Carbon::now(),
//             'lock' => 0,
//             'trans_type' => 0,
//             'unit_price' => 0,
//             'final_price' => 0,
//             'real_price' => 0,
//             'price_discount' => 0,
//             'vat' => 0,
//             'done' => 0,
//             'dept' => 0,
//             'deposit' => 0,
//         ]);



// dd("stop here!");
// $users = DB::table("users")->get();

// foreach($users as $user){
//     if($user->role_id > 0){
//         $dept = DB::table("roles")->where("id",$user->role_id)->first()->department_id;
//         DB::table("user_department")->insert([
//                 "department_id"=>$dept,
//                 "user_id"=>$user->id,

//             ]);
//         DB::table("users")->where("id",$user->id)->update(["department_id"=>$dept]);
//     }
// }


// dd("stop here!");

$uids = DB::table("job_noti")->where("seen",0)->select("user_id")->distinct()->pluck('user_id')->toArray();
   // dd($uids);
             foreach($uids as $uid){
                $user =  DB::table("users")->where("id",$uid)->first();
                $data = ["email"=>$user->email];
                 Mail::send('staffmail', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');

      });
            DB::table("job_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>-1]);

             }


    dd("end")
      $uids = DB::table("file_noti")->where("seen",0)->select("user_id")->distinct()->pluck('user_id')->toArray();
   // dd($uids);
             foreach($uids as $uid){
                $user =  DB::table("users")->where("id",$uid)->first();
                $data = ["email"=>$user->email];
                 Mail::send('staffmail', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');
      });
   DB::table("file_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>-1]);

             }

              $uids = DB::table("event_noti")->where("seen",0)->select("user_id")->distinct()->pluck('user_id')->toArray();
   // dd($uids);
             foreach($uids as $uid){
                $user =  DB::table("users")->where("id",$uid)->first();
                $data = ["email"=>$user->email];
                 Mail::send('staffmail', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'Thông báo hệ thống')->subject
                        ('Thông báo hệ thống ');
                     $message->from('automail.lopital@gmail.com','Lopital');
      });
   DB::table("event_noti")->where("seen",0)->where("user_id",$uid)->update(['seen'=>-1]);

             }


dd("donae");
if (json_decode($response)->success == true){
           return Redirect()->back()->with('notification', 'Kích hoạt tài khoản thành công');

}else{

           return Redirect()->back()->with('warning', 'Lỗi kích hoạt');
}
}

public function sendTags(){


  $agent = new Agent();
$platform = $agent->platform();
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/apps/e935d517-019c-48b1-a3da-982624168815/users/'.Auth()->user()->id."PF".$platform);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

$depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
curl_setopt($ch, CURLOPT_POSTFIELDS, "{ \"tags\":{\"role\":\"".$depart."\",\"user_id\":\"".Auth()->user()->id."\"}\n}");

$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
try{

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
      $response = curl_exec($ch); 
      curl_close($ch); 
      // dd($response);


     if (json_decode($response)->success == true){
           return Redirect()->back()->with('notification', 'Kích hoạt tài khoản thành công');

}else{

           return Redirect()->back()->with('warning', 'Lỗi kích hoạt');
}
        }
catch (\Exception $e) { 
    return Redirect()->back()->with('warning', 'Vui lòng cấp quyền thống báo để tiếp tục thực hiện'); 
  }
}




}