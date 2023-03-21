<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use App\User;
use App\Credential;
use App\Userreq;
use App\Broker;
use DB;
use File;
use App\Consumer;
use App\Consumer2;
use App\Staff;
use App\Accountant;

use App\Project;
use App\Area;
use App\Zone;
use App\Event;
use App\Historyzone;
use Carbon\Carbon;

use Illuminate\Support\Str;
use Illuminate\Http\Request;


use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\TblWidth;
use Mail;

class SaleController extends Controller
{	
   function sendMessage($mess,$role_id,$user_id) {
    print($user_id);
    $content      = array(
        "en" => $mess
    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Chi tiết",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://lopital.vn"
    ));

  if ($user_id == 0){
   $fields = array(
      'app_id' => "e935d517-019c-48b1-a3da-982624168815",
          'filters' => array(array("field" => "tag", "key" => "role", "relation" => "=", "value" => $role_id)),
          'data' => array("foo" => "bar"),
          'contents' => $content
      );
 }else{

   $fields = array(
      'app_id' => "e935d517-019c-48b1-a3da-982624168815",
          'filters' => array(array("field" => "tag", "key" => "user_id", "relation" => "=", "value" => $user_id)),
          'data' => array("foo" => "bar"),
          'contents' => $content
      );
 }
        
    
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
    // dd($response);
    
    return $response;

}

   public function alert(){


    return view('sale.alert');
   }

    public function viewAlert($id){
        $event = DB::table("zone_consumer_alert")
    ->leftJoin('zone_alert_tag', 'zone_consumer_alert.id', '=', 'zone_alert_tag.alert_id')
    ->leftJoin('zone_tag', 'zone_alert_tag.tag_id', '=', 'zone_tag.id')
    ->select("zone_consumer_alert.title as title"
      ,"zone_consumer_alert.id as id","zone_consumer_alert.content as content" ,"zone_consumer_alert.created_at as time"
              ,DB::raw("group_concat(zone_tag.name SEPARATOR ', ') as tags")
    )
    ->where("zone_consumer_alert.id",$id)
            ->groupBy('zone_consumer_alert.id')->first();



    return view('sale.alertview',compact('event'));
   }


    public function createAlert(Request $request){
   $title = $request->title;
    $tagArr = [];

    $tags = explode(",", $request->tags);

    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("zone_tag")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("zone_tag")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("zone_tag")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }foreach ($tagArr as $tag) {
      echo $tag."<br>";
    }
 $fid = DB::table("zone_consumer_alert")->insertGetId([
            'user_id' => Auth()->user()->id,
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
   
       // dd($fid);
       foreach ($tagArr as $tag) {
         # code...
       DB::table("zone_alert_tag")->insert([
            'alert_id' => $fid,
            'tag_id' => $tag

        ]);
       }


   return redirect("/icon/sale");
   }


   public function me(){
 $myzone  =DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('users', 'users.id', '=', 'zone.staff_id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
    ->select("zone_process.id as id","zone_process.curstep as curstep","zone.name as name", "consumer.name as cname", "consumer.phone_number as phone_number","users.name as sname","zone.gap as gap","zone.done as done","zone.state as state","zone.final_price as final_price")
->where("users.id",Auth()->user()->id)
     ->get();

    return view('sale.me',compact('myzone'));
   }

      public function con(){
 $myzone  =DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
     ->leftJoin('users', 'users.id', '=', 'consumer.user_id')
    ->select("zone_process.id as id","zone_process.curstep as curstep","zone.name as name",
"zone.acreage as acreage","zone.done as done","zone.dept as dept","zone.deposit_date as deposit_date",
        "zone.state as state")
->where("users.id",Auth()->user()->id)
     ->get();
// dd($myzone);
    return view('sale.con',compact('myzone'));
   }

   public function index(){
      if(!$this->checkLead()){
        return redirect("/");
      }

    // $zone  = DB::table("zone_process")
    //  ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
    //  ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
    //  ->leftJoin('staff_process_step', 'zone_process.process_id', '=', 'staff_process_step.process_id')
    //  ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
    // ->select("zone_process.id as id","zone.name as name", "consumer.name as cname", "consumer.phone_number as phone_number","staff_step.name as status")->where("zone_process.curstep","=","staff_process_step.step_id")->get();


      $step_count  = DB::table("staff_process_step")->where("process_id",3)->count();

      $myzone  =DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('users', 'users.id', '=', 'zone.staff_id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
    ->select("zone_process.id as id","zone_process.curstep as curstep","zone.name as name", "consumer.name as cname", "consumer.phone_number as phone_number","users.name as sname","zone.state as state","zone.gap as gap","zone.done as done","zone.final_price as final_price")
->where("zone.state","<","3")
->where("zone.state",">","0")
->where("users.id",Auth()->user()->id)
     ->get();



      $zone  =DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('users', 'users.id', '=', 'zone.staff_id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
    ->select("zone_process.id as id","zone_process.curstep as curstep","zone.name as name", "consumer.name as cname", "consumer.phone_number as phone_number","users.name as sname","zone.state as state","zone.gap as gap","zone.done as done","zone.final_price as final_price","zone_process.created_at as time")
->where("zone.state","<","3")
->where("zone.state",">","0")
     ->get();

     // dd($zone);

     $zone_complete  = DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('users', 'users.id', '=', 'zone.staff_id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
    ->select("zone_process.id as id","zone_process.curstep as curstep","zone.name as name", "consumer.name as cname", "consumer.phone_number as phone_number","users.name as sname","zone.gap as gap","zone.done as done","zone.final_price as final_price","zone_process.created_at as time")
->where("zone.state","3")
     ->get();

$zone_del = DB::table("zone_process")
->rightJoin('zone_backup', function ($join) {
        $join->on('zone_backup.id', '=', DB::raw('zone_process.zone_id * -1'));
    })
     ->leftJoin('users', 'users.id', '=', 'zone_backup.staff_id')
     ->leftJoin('consumer', 'zone_backup.consumer_id', '=', 'consumer.id')
    ->select("zone_backup.id as id","zone_process.curstep as curstep","zone_backup.name as name", "consumer.name as cname", "consumer.phone_number as phone_number","users.name as sname","zone_backup.gap as gap","zone_backup.done as done","zone_backup.final_price as final_price")
     ->get();

    // dd($step_count);
    return view('sale.index',compact('myzone','zone','zone_complete',"zone_del",'step_count'));
  }

   public function view($index){
      


    $infomation  = DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
     ->leftJoin('users', 'zone.staff_id', '=', 'users.id')

     ->leftJoin('staff_process_step', 'zone_process.process_id', '=', 'staff_process_step.process_id')
     ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
     ->where("zone_process.id",$index)
    ->select("zone_process.id as id","zone.name as name", "consumer.id as cid",
      "consumer.name as cname", "consumer.phone_number as phone_number", "consumer.identify_card as identify_card",
      "consumer.birth_date as birth_date",
      "consumer.iden_date as iden_date",
      "consumer.iden_location as iden_location",
      "consumer.married as married",
      "consumer.married_role as married_role",
      "consumer.address as address"
      ,"consumer.email as email"
      ,"users.name as sname"
      ,"users.phone as sphone"
    ,"staff_step.name as status")->first();

    $consumer2 = Consumer2::where("consumer_id",$infomation->cid)->first();




    // $infomation = DB::table("zone")
    // ->leftJoin('consumer', 'consumer.zone_id', '=', 'zone.id')


    $process_id = DB::table("zone_process")->where("id",$index)->first()->process_id;

      $lock =   DB::table("staff_process_lock")->where('process_id', $process_id)->get();

    $zone_id = DB::table("zone_process")->where("id",$index)->first()->zone_id;
    $zone = DB::table("zone")->where("id",$zone_id)->first();
// dd($zone);
    $staff =  DB::table("staff")->where("id",$zone_id)->first();
try{
$cid = DB::table("consumer")->where("user_id",Auth()->user()->id)->first()->id;
}catch (\Exception $e) { 
    $cid =-1;
}
if(!$this->checkMap() && $cid != $zone->consumer_id){
        return redirect()->back()->with("warning","Bạn không có quyền xem chi tiết lô này");
      }

    $curstep = DB::table("zone_process")->where("id",$index)->first()->curstep;
    $pays = DB::table("zone_pay")->where("zone_id",$zone_id)->get();
  $zone_cmt = DB::table("zone_comments")->where("zone_id",$zone_id)->get();

    return view('sale.view', compact("infomation","process_id",'zone_id','index',"curstep","pays","zone","staff","consumer2","zone_cmt","lock"));
  }

   public function update($index){
      if(!$this->checkLead()){
        return redirect()->back();
      }


    $infomation  = DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
     ->leftJoin('users', 'zone.staff_id', '=', 'users.id')

     ->leftJoin('staff_process_step', 'zone_process.process_id', '=', 'staff_process_step.process_id')
     ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
     ->where("zone_process.id",$index)
    ->select("zone_process.id as id","zone.name as name", "consumer.id as cid",
      "consumer.name as cname", "consumer.phone_number as phone_number", "consumer.identify_card as identify_card",
      "consumer.birth_date as birth_date",
      "consumer.iden_date as iden_date",
      "consumer.iden_location as iden_location",
      "consumer.married as married",
      "consumer.married_role as married_role",
      "consumer.address as address"
      ,"consumer.email as email"
      ,"users.name as sname"
      ,"users.phone as sphone"
    ,"staff_step.name as status")->first();

    $consumer2 = Consumer2::where("consumer_id",$infomation->cid)->first();


    $process_id = DB::table("zone_process")->where("id",$index)->first()->process_id;


    $zone_id = DB::table("zone_process")->where("id",$index)->first()->zone_id;
    $zone = DB::table("zone")->where("id",$zone_id)->first();
// dd($zone);
    $staff =  DB::table("staff")->where("id",$zone_id)->first();

    $curstep = DB::table("zone_process")->where("id",$index)->first()->curstep;
    $pays = DB::table("zone_pay")->where("zone_id",$zone_id)->get();

    $consumers = Consumer::get();

    return view('sale.trans', compact("infomation","process_id",'zone_id','index',"curstep","pays","zone","staff","consumer2","consumers"));
  }

    public function transfer($index){
      if(!$this->checkLead()){
        return redirect()->back();
      }


    $infomation  = DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
     ->leftJoin('users', 'zone.staff_id', '=', 'users.id')

     ->leftJoin('staff_process_step', 'zone_process.process_id', '=', 'staff_process_step.process_id')
     ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
     ->where("zone_process.id",$index)
    ->select("zone_process.id as id","zone.name as name", "consumer.id as cid",
      "consumer.name as cname", "consumer.phone_number as phone_number", "consumer.identify_card as identify_card",
      "consumer.birth_date as birth_date",
      "consumer.iden_date as iden_date",
      "consumer.iden_location as iden_location",
      "consumer.married as married",
      "consumer.married_role as married_role",
      "consumer.address as address"
      ,"consumer.email as email"
      ,"users.name as sname"
      ,"users.phone as sphone"
    ,"staff_step.name as status")->first();


    $process_id = DB::table("zone_process")->where("id",$index)->first()->process_id;


    $zone_id = DB::table("zone_process")->where("id",$index)->first()->zone_id;
    $zone = DB::table("zone")->where("id",$zone_id)->first();
// dd($zone);
    $staff =  DB::table("staff")->where("id",$zone_id)->first();

    $curstep = DB::table("zone_process")->where("id",$index)->first()->curstep;
    $pays = DB::table("zone_pay")->where("zone_id",$zone_id)->get();

    $consumers = Consumer::get();

    return view('sale.transfer', compact("infomation","process_id",'zone_id','index',"curstep","pays","zone","staff","consumers"));
  }


    public function viewByZone($index){
    $zone = DB::table("zone")->where("id",$index)->first();

      // if(!$this->checkLead() && $zone->staff_id != Auth()->user()->id){
      //   return redirect()->back()->with("warning","Bạn không có quyền xem chi tiết lô này");
      // }

  try{
    $infomation  = DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
     ->leftJoin('users', 'zone.staff_id', '=', 'users.id')
     ->leftJoin('staff_process_step', 'zone_process.process_id', '=', 'staff_process_step.process_id')
     ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
     ->where("zone.id",$index)
    ->select("zone_process.id as id","zone.name as name", "consumer.id as cid",
      "consumer.name as cname", "consumer.phone_number as phone_number", "consumer.identify_card as identify_card",
      "consumer.birth_date as birth_date",
      "consumer.iden_date as iden_date",
      "consumer.iden_location as iden_location",
      "consumer.married as married",
      "consumer.married_role as married_role",
      "consumer.address as address"
      ,"consumer.email as email"
      ,"users.name as sname"
      ,"users.phone as sphone"
    ,"staff_step.name as status")->first();

    $consumer2 = Consumer2::where("consumer_id",$infomation->cid)->first();

    $process_id = DB::table("zone_process")->where("zone_id",$index)->first()->process_id;
    // dd($process_id);
      $lock =   DB::table("staff_process_lock")->where('process_id', $process_id)->get();
    $zone_id = DB::table("zone_process")->where("zone_id",$index)->first()->zone_id;
    $zone = DB::table("zone")->where("id",$zone_id)->first();

    $staff =  DB::table("staff")->where("id",$zone_id)->first();
    $curstep = DB::table("zone_process")->where("zone_id",$index)->first()->curstep;

    $pays = DB::table("zone_pay")->where("zone_id",$zone_id)->get();

    $index = DB::table("zone_process")->where("zone_id",$index)->first()->id;
    }

    
    catch (\Exception $e) { 
        $area_id = DB::table("zone")->where("id",$index)->first()->area_id;
        return Redirect()->back()->with('warning', 'Khu đất chưa thực hiện giao dịch');
    }

  try{ 
$cid = DB::table("consumer")->where("user_id",Auth()->user()->id)->first()->id;
   } catch (\Exception $e) { 
       $cid = -1;
    }
if(!$this->checkMap() && $cid != $zone->consumer_id){
        return redirect()->back()->with("warning","Bạn không có quyền xem chi tiết lô này");
      }
  $zone_cmt = DB::table("zone_comments")->where("zone_id",$zone_id)->get();

    return view('sale.view', compact("infomation","process_id",'zone_id','index',"curstep","pays","zone","staff","consumer2","zone_cmt","lock"));
  }

   public function viewBackupZone($index){
    $zone = DB::table("zone_backup")->where("id",$index)->first();
      if(!$this->checkLead()){
        return redirect()->back()->with("warning","Bạn không có quyền xem chi tiết lô này");
      }

  // try{
    $infomation  = DB::table("zone_process")
    ->leftJoin('zone_backup', function ($join) {
        $join->on('zone_backup.id', '=', DB::raw('zone_process.zone_id * -1'));
    })
     ->leftJoin('consumer', 'zone_backup.consumer_id', '=', 'consumer.id')
     ->leftJoin('users', 'zone_backup.staff_id', '=', 'users.id')
     ->leftJoin('staff_process_step', 'zone_process.process_id', '=', 'staff_process_step.process_id')
     ->leftJoin('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
     ->where("zone_backup.id",$index)
    ->select("zone_process.id as id","zone_backup.name as name", "consumer.id as cid",
      "consumer.name as cname", "consumer.phone_number as phone_number", "consumer.identify_card as identify_card",
      "consumer.birth_date as birth_date",
      "consumer.iden_date as iden_date",
      "consumer.iden_location as iden_location",
      "consumer.married as married",
      "consumer.married_role as married_role",
      "consumer.address as address"
      ,"consumer.email as email"
      ,"users.name as sname"
      ,"users.phone as sphone"
    ,"staff_step.name as status")->first();

    // dd($infomation);

    $consumer2 = Consumer2::where("consumer_id",$infomation->cid)->first();

    $process_id = DB::table("zone_process")->where("zone_id",$index*-1)->first()->process_id;
    // dd($process_id);
      $lock =   DB::table("staff_process_lock")->where('process_id', $process_id)->get();

    $zone_id = $index*-1;
    $staff =  DB::table("staff")->where("id",0)->first();
    $curstep = DB::table("zone_process")->where("zone_id",$zone_id)->first()->curstep;

    $pays = DB::table("zone_pay")->where("zone_id",$zone_id)->get();

    $index = DB::table("zone_process")->where("zone_id",$zone_id)->first()->id;
    // }

    
    // catch (\Exception $e) { 
    //     return Redirect()->back()->with('warning', 'Khu đất chưa thực hiện giao dịch');
    // }

  try{ 
$cid = DB::table("consumer")->where("user_id",Auth()->user()->id)->first()->id;
   } catch (\Exception $e) { 
       $cid = -1;
    }
if(!$this->checkMap() && $cid != $zone->consumer_id){
        return redirect()->back()->with("warning","Bạn không có quyền xem chi tiết lô này");
      }
  $zone_cmt = DB::table("zone_comments")->where("zone_id",$index*-1)->get();

    return view('sale.viewbk', compact("infomation","process_id",'zone_id','index',"curstep","pays","zone","staff","consumer2","zone_cmt","lock"));
  }


    public function createCustomer($id){

        $cid  = DB::table("zone_process")
         ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')->where("zone_process.id",$id)
         ->select("zone.consumer_id as consumer_id")->first()->consumer_id;

        $consumer = DB::table("consumer")->where("id",$cid)->first();
        User::where("email", $consumer->email)->where("role_id",27)->delete();


            $new_user = new User();
            $new_user->name = $consumer->name;
            $new_user->email = $consumer->email;
            $new_user->phone = $consumer->phone_number;
            $new_user->identify = $consumer->identify_card;


            $new_user->iden_date = $consumer->iden_date;

            $new_user->iden_location = $consumer->iden_location;

            $new_user->tax_code = "00000";

            $new_user->birth_date = $consumer->birth_date;

            $new_user->role_id = 27;

            $pass = Str::random(25);
            // $new_user->password = Hash::make($pass);
            $new_user->password = Hash::make("123456");

          
            $new_user->save();
            DB::table("consumer")->where("id",$cid)->update(["user_id"=>$new_user->id]);

            // $data = array('mypass'=>$pass,"myemail"=>$consumer->email,"email"=>$consumer->email);
            // // dd($data);
            //       Mail::send('consumer', $data, function($message) use ($data)  {
            //          $message->to($data['email'], 'thông báo tài khoản cho khách hàng')->subject
            //             ('Thông báo tài khoản cho khách hàng');
            //          $message->from('automail.lopital@gmail.com','Lopital');
            //       });
      
        return redirect()->back()->with("notification","Đã tạo tài khoản thành công");

    }

        public function createCustomerByZone($id){

        $cid  = DB::table("zone")->where("zone.id",$id)
         ->select("zone.consumer_id as consumer_id")->first()->consumer_id;

        $consumer = DB::table("consumer")->where("id",$cid)->first();
        User::where("email", $consumer->email)->where("role_id",27)->delete();


            $new_user = new User();
            $new_user->name = $consumer->name;
            $new_user->email = $consumer->email;
            $new_user->phone = $consumer->phone_number;
            $new_user->identify = $consumer->identify_card;


            $new_user->iden_date = $consumer->iden_date;

            $new_user->iden_location = $consumer->iden_location;

            $new_user->tax_code = "00000";

            $new_user->birth_date = $consumer->birth_date;

            $new_user->role_id = 27;

            $pass = Str::random(25);
            // $new_user->password = Hash::make($pass);
            $new_user->password = Hash::make("123456");

          
            $new_user->save();
            DB::table("consumer")->where("id",$cid)->update(["user_id"=>$new_user->id]);

            // $data = array('mypass'=>$pass,"myemail"=>$consumer->email,"email"=>$consumer->email);
            // // dd($data);
            //       Mail::send('consumer', $data, function($message) use ($data)  {
            //          $message->to($data['email'], 'thông báo tài khoản cho khách hàng')->subject
            //             ('Thông báo tài khoản cho khách hàng');
            //          $message->from('automail.lopital@gmail.com','Lopital');
            //       });
      
        return redirect()->back()->with("notification","Đã tạo tài khoản thành công");

    }

 

public function bigProcessList(){
    $processes = DB::table("big_process")->get();

    return json_encode($processes);
  }

  public function bigProcessDetail($id){
     $processes = DB::table("big_process_step")
     ->leftJoin('big_process', 'big_process_step.process_id', '=', 'big_process.id')
    ->leftJoin('big_step', 'big_process_step.step_id', '=', 'big_step.id')
    ->where([['big_process.id',$id]])
    ->select("big_process_step.id as ps_id", "big_process.id as pid", "big_step.id as sid"
    ,"big_process.name as process_name", "big_step.name as step_name","big_process_step.pos as pos"
    ,"big_step.state as state")->get();

    return json_encode($processes);
  }

	public function legalList($id,$type){
     $big_step_array = DB::table("big_process_step")
     ->leftJoin('big_process', 'big_process_step.process_id', '=', 'big_process.id')
    ->leftJoin('big_step', 'big_process_step.step_id', '=', 'big_step.id')
    ->where([['big_process.id',$id]])->pluck('big_step.id')->toArray();

     $process_id = DB::table("big_step_to_process")
     ->leftJoin('process', 'big_step_to_process.process_id', '=', 'process.id')
    ->leftJoin('big_step', 'big_step_to_process.big_step_id', '=', 'big_step.id')
    ->whereIn('big_step.id',$big_step_array)->pluck('process.id')->toArray();


    $step_id = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->whereIn('process.id',$process_id)->pluck('step.id')->toArray();


    $task =DB::table("step_innertask")->whereIn('step_id',$step_id)->where('legal_type',$type)->get();

    $substep_id = DB::table("substep")
    ->whereIn('step_id',$step_id)->pluck('substep.id')->toArray();


    $subtask =DB::table("step_innertask")->whereIn('subtep_id',$substep_id)->where('legal_type',$type)->get();


     return (json_encode([json_encode($task),json_encode($subtask)]));
}
public function processList(){
    $processes = DB::table("process")->get();
    return json_encode($processes);
}
  public function processOnBigStepList($id){
     $processes = DB::table("big_step_to_process")
     ->leftJoin('process', 'big_step_to_process.process_id', '=', 'process.id')
    ->leftJoin('big_step', 'big_step_to_process.big_step_id', '=', 'big_step.id')
    ->where([['big_step.id',$id]])
    ->select("process.name as name", "process.curstep as curstep", "process.id as id"
    ,"process.state as state")->get();

    return json_encode($processes);
  }
   public function processIndexDetail($id){
    $processes = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$id]])
    ->select("process_step.id as ps_id", "process.id as pid", "step.id as sid"
    ,"process.name as process_name", "step.name as step_name","process_step.pos as pos"
    ,"step.state as state")->get();
    
    $curstep_before = DB::table("process")->where("id",$id)->first()->curstep;

    $curstep = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$id],['process_step.pos',$curstep_before]])->first()->step_id;

    return json_encode([$processes,$curstep]);
  }

   public function processDetail($id,$zone_id){
    $processes = DB::table("staff_process_step")
     ->leftJoin('staff_process', 'staff_process_step.process_id', '=', 'staff_process.id')
    ->Join('staff_step', 'staff_process_step.step_id', '=', 'staff_step.id')
    ->leftJoin('zone_step', 'zone_step.step_id', '=', 'staff_step.id')
    ->where([['staff_process.id',$id]])
    ->where([['zone_step.zone_id',$zone_id]])
    ->select("staff_process.id as pid", "staff_step.id as sid", "staff_step.name as step_name","zone_step.status as status",
      "staff_step.pay_flag as case"
    )
    ->orderBy('staff_process_step.pos', 'asc')
    ->get();

    return json_encode($processes);
  }

  public function stepDetail($id,$zone_id){
   $step = DB::table("staff_step_task")
    ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
    ->leftJoin('staff_step', 'staff_step_task.step_id', '=', 'staff_step.id')
    ->leftJoin('zone_task', 'staff_task.id', '=', 'zone_task.task_id')
    ->where([['staff_step.id',$id]])
    ->where('zone_task.status',"<>",5)
    ->where([['zone_task.zone_id',$zone_id]])
    ->select("zone_task.id as id","staff_task.name as name","staff_task.type as type",
      "staff_task.url as url","zone_task.des as des","zone_task.status as status",
      "zone_task.start_date as start_date","zone_task.end_date as end_date"
      )->orderBy('staff_step_task.pos', 'ASC')->get();

    return (json_encode([0,json_encode($step)]));
    


    // return json_encode($processes);
  }

     public function stepDetail2($id){
    $substep_count = DB::table("substep")
    ->where([['step_id',$id]])->count();
    if ($substep_count > 0){
        $data = [];
        $data[] = 1;
        $substeps = DB::table("substep")
    ->where([['step_id',$id]])->get();
    foreach ($substeps as $substep) {
      // print_r("____________________________________");
       // $substep_innertask = DB::table("substep_innertask")->where([['substep_id',$substep->id]])->get();
       // $substep_outertask = DB::table("substep_outnertask")->where([['substep_id',$substep->id]])->get();
       // $substep_processtask = DB::table("substep_process")->where([['substep_id',$substep->id]])->get();
       $temp = [];
       $temp[] = $substep->id;
       $temp[] = $substep->name;
       $temp[] = $substep->state;
       $temp[] = $substep->des;
       $temp[] = $substep->legal;

       // $temp[] = json_encode($substep_innertask);
       // $temp[] = json_encode($substep_outertask);
       // $temp[] = json_encode($substep_processtask);

       $data[] = $temp;
     } 

        return json_encode($data);
    }else{
     $inner_step= DB::table("step_innertask")->where([['step_id',$id]])->get();


    $outer_step= DB::table("step_outnertask")->where([['step_id',$id]])->get();


    $process_step= DB::table("step_process")->where([['step_id',$id]])->get();


    return (json_encode([0,json_encode($inner_step),json_encode($outer_step),json_encode($process_step)]));
    }


    // return json_encode($processes);
  }
  public function substepDetail($id){
   $supstep = DB::table("substep_task")
    ->leftJoin('task', 'substep_task.task_id', '=', 'task.id')
    ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
    ->where([['substep.id',$id]])
    ->select("task.id as id","task.name as name","task.file_flag as file_flag","task.url as url",
    "task.des as des","task.legal as legal","task.status as status","task.type as type",
    "task.department_id as department_id","task.legal_type as legal_type","task.start_date as start_date","task.duration as duration"
    )->get();


    return json_encode($supstep);


  }
  public function staffTasks($id){
     $task1 = DB::table("step_outnertask")->get();
     $task2 = DB::table("substep_outnertask")->get();
     return (json_encode([json_encode($task1),json_encode($task2)]));
  }
   public function addTaskFile(Request $request)
    {
      $id =  $request->step_id;
      $type = $request->type;
      $index = $request->index;

      // }
       $table  = "zone_task";

      $destinationPath = public_path().'/files/system/';
      $i = 0;


                try{

      foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->route('sale-view', ['id' => $index])->with('warning',' Tệp tin không đúng định dạng !');;

      }
      $path = $file->store('system');

      $url = Storage::url($path);

      $i = $i +1;
       DB::table("zone_task_url")->insert([
            'url' => $url,
            'task_id'=>$id,
            'image_id'=>$i,
        ]);



      }
    }
catch (\Exception $e) { 
    return Redirect()->route('sale-view', ['id' => $index])->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
               }
      // print_r(DB::table( $table)->where('id', $id)->first());

      DB::table($table)->where('id', $id)->update([
            // 'url' => $url,
            'status'=>1
        ]);

    $zone_id = DB::table($table)->where('id', $id)->first()->zone_id;
    $zone_name = Zone::where("id",$zone_id)->first()->name;


    $task_id = DB::table($table)->where('id', $id)->first()->task_id;
    $task_name = DB::table("staff_task")->where("id",$task_id)->first()->name;

    // $step =  DB::table($table)->where('id', $id)->first()->step;
    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;

    $response = $this->sendMessage("Căn hộ ".$zone_name. " đã cập nhật ".$task_name ,$depart,0);
   
    $event  = new Event();
   $event->title = "Căn hộ ".$zone_name;
    $event->type = 1;
    $event->description = "Đã  cập nhật ".$task_name;
    // $data = json_decode($response, true);
    $event->permiss = 0;
    $event->user_id = Auth()->user()->id;

    $event->save();

      $task_id = DB::table($table)->where('id', $id)->first()->task_id;
      $zone_id = DB::table($table)->where('id', $id)->first()->zone_id;

      $steps = DB::table("staff_step_task")
      ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
      ->leftJoin('staff_step', 'staff_step_task.step_id', '=', 'staff_step.id')
      ->where([['staff_task.id',$task_id]])
      ->pluck('staff_step.id')->toArray();

      foreach ($steps as $step) {
try{
       $count = DB::table("zone_step")
      ->leftJoin('staff_step_task', 'staff_step_task.step_id', '=', 'zone_step.id')
      ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
    ->leftJoin('zone_task', 'staff_task.id', '=', 'zone_task.task_id')
      ->where([['zone_task.zone_id',$zone_id]])
      ->where([['zone_step.step_id',$step]])->where([['zone_task.status',0]])->count();
      // echo($zone_id."<br>");
      // echo($step."<br>");
      // print($count."<br>");
      if($count == 0){
          $pay_flag = DB::table("staff_step")->where("id",$step)->first()->pay_flag;
          if($pay_flag ==0){
          DB::table("zone_step")->where("step_id",$step)
          ->where("zone_id",$zone_id)
          ->update([
              'status' => 1
          ]);


    $step_name = DB::table("staff_step")->where("id",$step)->first()->name;
    $response = $this->sendMessage("Căn hộ ".$zone_name. " đã hoàn thành ".$step_name ,$depart,0);
   
    $event  = new Event();
   $event->title = "Căn hộ ".$zone_name;
    $event->type = 1;
    $event->description = "Đã hoàn thành ".$step_name;
    // $data = json_decode($response, true);
    $event->permiss = 0;
    $event->user_id = Auth()->user()->id;

    $event->save();

      $curstep = DB::table("zone_process")->where("zone_id",$zone_id)->first()->curstep;
       DB::table("zone_process")->where("zone_id",$zone_id)->update([
              'curstep' => $curstep + 1
          ]);
       $cpid = DB::table("zone_process")->where("zone_id",$zone_id)->first()->process_id;

       $process_step_count = DB::table("staff_process_step")->where("process_id",$cpid)->count();

       if ($process_step_count  <= $curstep+1){
           DB::table("zone")->where("id",$zone_id)->update([
              'state' => 3
          ]);
       }
     }else{
          $pay_check = DB::table("zone_pay")->where("zone_id",$zone_id)->where("url",null)->count();
          if($pay_check ==0){
                DB::table("zone_step")->where("step_id",$step)
          ->where("zone_id",$zone_id)
          ->update([
              'status' => 1
          ]);

      $curstep = DB::table("zone_process")->where("zone_id",$zone_id)->first()->curstep;
       DB::table("zone_process")->where("zone_id",$zone_id)->update([
              'curstep' => $curstep + 1
          ]);
       $cpid = DB::table("zone_process")->where("zone_id",$zone_id)->first()->process_id;

       $process_step_count = DB::table("staff_process_step")->where("process_id",$cpid)->count();

       if ($process_step_count  <= $curstep+1){
           DB::table("zone")->where("id",$zone_id)->update([
              'state' => 3
          ]);
       }
        $step_name = DB::table("staff_step")->where("id",$step)->first()->name;
    $response = $this->sendMessage("Căn hộ ".$zone_name. " đã hoàn thành ".$step_name ,$depart,0);
   
    $event  = new Event();
   $event->title = "Căn hộ ".$zone_name;
    $event->type = 1;
    $event->description = "Đã hoàn thành ".$step_name;
    // $data = json_decode($response, true);
    $event->permiss = 0;
    $event->user_id = Auth()->user()->id;

    $event->save();

        }
     }
      // dd("???");
      }
    }catch (\Exception $e) { 
    return Redirect()->back()->with('notification',' Đã cập nhật tệp thư mục!');
               }


    }



    return Redirect()->route('sale-view', ['id' => $index])->with('notification',' Đã cập nhật tệp thư mục!');
  }

  public function PayBack(Request $request){
       $destinationPath = public_path().'/files/system/';
      $file_name = $request->file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->route('sale-view', ['id' => $index])->with('warning',' Tệp tin không đúng định dạng !');;

      }
      $path = $request->file->store('system');

      $url = Storage::url($path);

      DB::table($table)->where('id', $id)->update([
            'url' => $url
        ]);
      $zone_id = DB::table($table)->where('id', $id)->first()->zone_id;
      $zone = $zone_name = Zone::where("id",$zone_id)->first();
$pay = DB::table($table)->where('id', $id)->first();
 Zone::where("id",$zone_id)->update([
            'done' => floatval($zone->done) + floatval($pay->money),
            "dept" => floatval($zone->dept) - floatval($pay->money)
        ]);

    $zone_name = Zone::where("id",$zone_id)->first()->name;
    $step =  DB::table($table)->where('id', $id)->first()->step;
    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;

    $response = $this->sendMessage("Căn hộ ".$zone_name. " đã thanh toán tiến độ  đợt ".$step ,$depart,0);
   
    $event  = new Event();
   $event->title = "Căn hộ ".$zone_name;
    $event->type = 1;
    $event->description = "Đã thanh toán tiến độ  đợt ".$step;
    // $data = json_decode($response, true);
    $event->permiss = 0;
    $event->user_id = Auth()->user()->id;

    $event->save();

  }



  public function addPayFile(Request $request)
    {
      $id =  $request->step_id;
      $type = $request->type;
      $index = $request->index;

      // }
       $table  = "zone_pay";



      $steps = DB::table("staff_step_task")
      ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
      ->leftJoin('staff_step', 'staff_step_task.step_id', '=', 'staff_step.id')
      ->where("staff_step.pay_flag",">",0)
      ->pluck('staff_step.id')->toArray();

      foreach ($steps as $step) {

       $count = DB::table("zone_step")
      ->leftJoin('staff_step_task', 'staff_step_task.step_id', '=', 'zone_step.id')
      ->leftJoin('staff_task', 'staff_step_task.task_id', '=', 'staff_task.id')
    ->leftJoin('zone_task', 'staff_task.id', '=', 'zone_task.task_id')
      ->where([['zone_task.zone_id',$zone_id]])
      ->where([['zone_step.step_id',$step]])->where([['zone_task.status',0]])->count();
      // echo($zone_id."<br>");
      // echo($step."<br>");
      // print($count."<br>");
      if($count == 0){
          $pay_flag = DB::table("staff_step")->where("id",$step)->first()->pay_flag;
          if($pay_flag ==0){
          DB::table("zone_step")->where("step_id",$step)
          ->where("zone_id",$zone_id)
          ->update([
              'status' => 1
          ]);

      $curstep = DB::table("zone_process")->where("zone_id",$zone_id)->first()->curstep;
       DB::table("zone_process")->where("zone_id",$zone_id)->update([
              'curstep' => $curstep + 1
          ]);
       $cpid = DB::table("zone_process")->where("zone_id",$zone_id)->first()->process_id;

       $process_step_count = DB::table("staff_process_step")->where("process_id",$cpid)->count();

       if ($process_step_count  <= $curstep+1){
           DB::table("zone")->where("id",$zone_id)->update([
              'state' => 3
          ]);
       }
     }else{

          $pay_check = DB::table("zone_pay")->where("zone_id",$zone_id)->where("url",null)->count();
          if($pay_check ==0){
                DB::table("zone_step")->where("step_id",$step)
          ->where("zone_id",$zone_id)
          ->update([
              'status' => 1
          ]);

      $curstep = DB::table("zone_process")->where("zone_id",$zone_id)->first()->curstep;
       DB::table("zone_process")->where("zone_id",$zone_id)->update([
              'curstep' => $curstep + 1
          ]);
       $cpid = DB::table("zone_process")->where("zone_id",$zone_id)->first()->process_id;

       $process_step_count = DB::table("staff_process_step")->where("process_id",$cpid)->count();

       if ($process_step_count  <= $curstep+1){
           DB::table("zone")->where("id",$zone_id)->update([
              'state' => 3
          ]);
       }
       
        }
     }
      // dd("???");
      }
      break;
    }


    return Redirect()->route('sale-view', ['id' => $index])->with('notification',' Đã cập nhật tệp thư mục!');;
  }

     public function updateInnerTask(Request $request)
    {
      $id =  $request->id;
      $type = $request->type;
      $index = $request->index;
      // if ($type == 0){
      //   $table = "step_innertask";
      // }else{
      //   $table = "substep_innertask";
      // }
       $table  = "task";

      $file_flag = DB::table($table)->where('id', $id)->first()->file_flag;
      $cur_url = DB::table($table)->where('id', $id)->first()->url;
      $cur_url = DB::table($table)->where('id', $id)->first()->url;
      if ($file_flag == 0){
      DB::table($table)->where('id', $id)->update([
            'status' => 1
        ]);


        // return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật trạng thái thành công!');

      }else{
      if($cur_url != null && strlen($cur_url) >2){
      DB::table($table)->where('id', $id)->update([
            'status' => 1
        ]);
       
      }else{
        return Redirect()->route('process-view', ['id' => $index])->with('warning',' Cập nhận trạng thái thất bại do chưa có file !');
      }
        $steps = DB::table("step_task")
      ->leftJoin('task', 'step_task.task_id', '=', 'task.id')
      ->leftJoin('step', 'step_task.step_id', '=', 'step.id')
      ->where([['task.id',$id]])
      ->pluck('step.id')->toArray();

      foreach ($steps as $step) {
      $count = DB::table("step_task")
      ->leftJoin('task', 'step_task.task_id', '=', 'task.id')
      ->leftJoin('step', 'step_task.step_id', '=', 'step.id')
      ->where([['step.id',$step]])->where([['task.type',0],['task.status',0]])->count();

      if($count == 0){
          DB::table("step")->where("id",$step)->update([
              'state' => 2
          ]);
        }
      }

      $substep = DB::table("substep_task")
      ->leftJoin('task', 'substep_task.task_id', '=', 'task.id')
      ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
      ->where([['task.id',$id]])
      ->pluck('substep.id')->toArray();
      print_r($substep);
      foreach ($substep as $step) {
      $count = DB::table("substep_task")
      ->leftJoin('task', 'substep_task.task_id', '=', 'task.id')
      ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
      ->where([['substep.id',$step]])->where([['task.type',0],['task.status',0]])->count();
      print_r($count);

      if($count == 0){
          DB::table("substep")->where("id",$step)->update([
              'state' => 2
          ]);
        }
      }
        
      }


    return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật trạng thái thành công!');
  }
public function addStaffFile(Request $request)
    {
      $id =  $request->step_id;
      $type = $request->type;
      $index = $request->index;
      if ($type == 0){
        $table = "step_outnertask";
      }else{
        $table = "substep_outnertask";

      }
      $destinationPath = public_path().'/files/system/';
      $file_name = $request->file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->route('process-index')->with('warning',' Tệp tin khống đúng định dạng !');;

      }
      $request->file->move($destinationPath, $file_name);

      // print_r(DB::table( $table)->where('id', $id)->first());

      DB::table($table)->where('id', $id)->update([
            'url' => '/files/system/'.$file_name
        ]);


    return Redirect()->route('personal-job')->with('notification',' Đã cập nhật tệp thư mục!');;
  }
  public function updateStaffTask(Request $request)
    {
      $id =  $request->id;
      $type = $request->type;
      $index = $request->index;
      // if ($type == 0){
      //   $table = "step_outnertask";
      // }else{
      //   $table = "substep_outnertask";

      // }

       $table  = "task";
      $file_flag = DB::table($table)->where('id', $id)->first()->file_flag;
      $cur_url = DB::table($table)->where('id', $id)->first()->url;
      $cur_url = DB::table($table)->where('id', $id)->first()->url;
      if ($file_flag == 0){
      DB::table($table)->where('id', $id)->update([
            'status' => 1
        ]);
        return Redirect()->route('personal-job')->with('notification',' Đã cập nhật trạng thái thành công!');;

      }else{
      if($cur_url != null && strlen($cur_url) >2){
      DB::table($table)->where('id', $id)->update([
            'status' => 1
        ]);
      }else{
        return Redirect()->route('personal-job')->with('warning',' Cập nhận trạng thái thất bại do chưa có file !');
      }
        
      }


    return Redirect()->route('personal-job')->with('notification',' Đã cập nhật trạng thái thành công!');;
  }


  public function updateOutnerDepartment(Request $request)
    {
      $id =  $request->id;
      $department_id =  $request->department_id;
      $type = $request->type;
      $index = $request->index;
      // if ($type == 0){
      //   $table = "step_outnertask";
      // }else{
      //   $table = "substep_outnertask";

      // }

       $table  = "task";
      DB::table($table)->where('id', $id)->update([
            'department_id' => $department_id
        ]);


    return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã phân công nhiệm vụ thành công !');;
  }
  public function updateInnerDepartment(Request $request)
    {
      $id =  $request->id;
      $department_id =  $request->department_id;
      $type = $request->type;
      $index = $request->index;
      // if ($type == 0){
      //   $table = "step_innertask";
      // }else{
      //   $table = "substep_innertask";

      // }

       $table  = "task";

      DB::table($table)->where('id', $id)->update([
            'department_id' => $department_id
        ]);


    return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã phân công nhiệm vụ thành công !');;
  }
  // public function updateStepStatus(Request $request)
  //   {
  //     $id =  $request->step_id;
  //     $index = $request->index;
  //     $type = $request->type;

  //     if ($type == 0){
  //   $step_innertask = DB::table("step_innertask")->where([['type',0],['status',0],['step_id',$id]])->count();
  //   if ($step_innertask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn thành các điều kiện bắt buộc');
  //   }
  //  $step_outertask = DB::table("step_outnertask")->where([['type',0],['status',0],['step_id',$id]])->count();
  //   if ($step_outertask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn thành các điều kiện bắt buộc');
  //   }
  //  $step_processtask = DB::table("step_process")->where([['type',0],['status',0],['step_id',$id]])->count();
  //   if ($step_processtask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn thành các điều kiện bắt buộc');
  //   }

  //   $step_innertask = DB::table("step_innertask")->where([['type',1],['status',0],['step_id',$id]])->count();
  //   if ($step_innertask > 0 ){
  //    DB::table("step")->where('id', $id)->update([
  //           'state' => 3
  //       ]);
  //      return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');
  //   }
  //  $step_outertask = DB::table("step_outnertask")->where([['type',1],['status',0],['step_id',$id]])->count();
  //   if ($step_outertask > 0 ){
  //    DB::table("step")->where('id', $id)->update([
  //           'state' => 3
  //       ]);
  //      return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');
  //   }
  //  $step_processtask = DB::table("step_process")->where([['type',1],['status',0],['step_id',$id]])->count();
  //   if ($step_processtask > 0 ){
  //    DB::table("step")->where('id', $id)->update([
  //           'state' => 3
  //       ]);
  //      return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');
  //   }


  //    DB::table("step")->where('id', $id)->update([
  //           'state' => 2
  //       ]);

  //   return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');

  //     }else{
  //   $substep_innertask = DB::table("substep_innertask")->where([['type',0],['status',0],['substep_id',$id]])->count();
  //   if ($substep_innertask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn thành các điều kiện bắt buộc');
  //   }
  //  $substep_outertask = DB::table("substep_outnertask")->where([['type',0],['status',0],['substep_id',$id]])->count();
  //   if ($substep_outertask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn thành các điều kiện bắt buộc');
  //   }
  //  $substep_processtask = DB::table("substep_process")->where([['type',0],['status',0],['substep_id',$id]])->count();
  //   if ($substep_processtask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn thành các điều kiện bắt buộc');
  //   }

  //   $substep_innertask = DB::table("substep_innertask")->where([['type',1],['status',0],['substep_id',$id]])->count();
  //   if ($substep_innertask > 0 ){
  //    DB::table("substep")->where('id', $id)->update([
  //           'state' => 3
  //       ]);
  //      return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');
  //   }
  //  $substep_outertask = DB::table("substep_outnertask")->where([['type',1],['status',0],['substep_id',$id]])->count();
  //   if ($substep_outertask > 0 ){
  //    DB::table("substep")->where('id', $id)->update([
  //           'state' => 3
  //       ]);
  //      return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');
  //   }
  //  $substep_processtask = DB::table("substep_process")->where([['type',1],['status',0],['substep_id',$id]])->count();
  //   if ($substep_processtask > 0 ){
  //    DB::table("substep")->where('id', $id)->update([
  //           'state' => 3
  //       ]);
  //      return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');
  //   }

  //   $curstep = DB::table("process")->where("id",$index)->first()->curstep;
  //   DB::table("process")->where('id', $index)->update([
  //           'curstep' => $curstep + 1
  //       ]);
  //    DB::table("substep")->where('id', $id)->update([
  //           'state' => 2
  //       ]);
  //      return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');


  //     }

  //     DB::table($table)->where('id', $id)->update([
  //           'department_id' => $department_id
  //       ]);


  //   return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã phân công nhiệm vụ thành công !');
  // }
  //  public function updateFinalStatus(Request $request)
  //   {
  //     $id =  $request->step_id;
  //     $index = $request->index;
  //     $type = $request->type;

  //     if ($type == 0){
  //   $step_innertask = DB::table("step_innertask")->where([['type',1],['status',0],['step_id',$id]])->count();
  //   if ($step_innertask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn tất toàn bộ điều kiện !');
  //   }
  //  $step_outertask = DB::table("step_outnertask")->where([['type',1],['status',0],['step_id',$id]])->count();
  //   if ($step_outertask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn tất toàn bộ điều kiện !');
  //   }
  //  $step_processtask = DB::table("step_process")->where([['type',1],['status',0],['step_id',$id]])->count();
  //   if ($step_processtask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn tất toàn bộ điều kiện !');
  //   }

    
  //    DB::table("step")->where('id', $id)->update([
  //           'state' => 2
  //       ]);

  //   return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');

  //     }else{
  //   $substep_innertask = DB::table("substep_innertask")->where([['type',1],['status',0],['substep_id',$id]])->count();
  //   if ($substep_innertask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn tất toàn bộ điều kiện !');
  //   }
  //  $substep_outertask = DB::table("substep_outnertask")->where([['type',1],['status',0],['substep_id',$id]])->count();
  //   if ($substep_outertask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn tất toàn bộ điều kiện !');
  //   }
  //  $substep_processtask = DB::table("substep_process")->where([['type',1],['status',0],['substep_id',$id]])->count();
  //   if ($substep_processtask > 0 ){
  //      return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn tất toàn bộ điều kiện !');
  //   }

    
  //    DB::table("substep")->where('id', $id)->update([
  //           'state' => 2
  //       ]);
  //      return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');


  //     }

  //     DB::table($table)->where('id', $id)->update([
  //           'department_id' => $department_id
  //       ]);


  //   return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã phân công nhiệm vụ thành công !');




  // }
  public function updateTaskInfo(Request $request){
    DB::table("task")->where('id', $request->id)->update([
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'more' => $request->moreinfo,
        ]);
       return Redirect()->route('process-view', ['id' => $request->index])->with('notification',' Đã cập nhật thông tin thành công !');
  }

  public function updateStepStatus(Request $request)
    {
      $id =  $request->step_id;
      $index = $request->index;
      $type = $request->type;

      if ($type == 0){
    // $step_innertask = DB::table("step_innertask")->where([['type',0],['status',0],['step_id',$id]])->count();

    $step = DB::table("step_task")
    ->leftJoin('task', 'step_task.task_id', '=', 'task.id')
    ->leftJoin('step', 'step_task.step_id', '=', 'step.id')
    ->where([['step.id',$id]])->where([['task.type',0],['task.status',0]])->count();

    if ($step > 0 ){
       return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn thành các điều kiện bắt buộc');
    }

 $supstep = DB::table("substep_task")
    ->leftJoin('task', 'substep_task.task_id', '=', 'task.id')
    ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
    ->where([['substep.id',$id]])->where([['task.type',0],['task.status',0]])->count();
    if ($supstep > 0 ){
     DB::table("step")->where('id', $id)->update([
            'state' => 3
        ]);
       return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');
    }

     DB::table("step")->where('id', $id)->update([
            'state' => 2
        ]);

    return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');

      }else{
     $step = DB::table("step_task")
    ->leftJoin('task', 'step_task.task_id', '=', 'task.id')
    ->leftJoin('step', 'step_task.step_id', '=', 'step.id')
    ->where([['step.id',$id]])->where([['task.type',1],['task.status',0]])->count();
    if ($step > 0 ){
       return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn thành các điều kiện bắt buộc');
    }
   
 $supstep = DB::table("substep_task")
    ->leftJoin('task', 'substep_task.task_id', '=', 'task.id')
    ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
    ->where([['substep.id',$id]])->where([['task.type',1],['task.status',0]])->count();


    if ($supstep > 0 ){
     DB::table("substep")->where('id', $id)->update([
            'state' => 3
        ]);
       return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');
    }

    $curstep = DB::table("process")->where("id",$index)->first()->curstep;
    DB::table("process")->where('id', $index)->update([
            'curstep' => $curstep + 1
        ]);
     DB::table("substep")->where('id', $id)->update([
            'state' => 2
        ]);
       return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');


      }

      DB::table($table)->where('id', $id)->update([
            'department_id' => $department_id
        ]);


    return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã phân công nhiệm vụ thành công !');
  }
   public function updateFinalStatus(Request $request)
    {
      $id =  $request->step_id;
      $index = $request->index;
      $type = $request->type;

      if ($type == 0){
    
     $step = DB::table("step_task")
    ->leftJoin('task', 'step_task.task_id', '=', 'task.id')
    ->leftJoin('step', 'step_task.step_id', '=', 'step.id')
    ->where([['step.id',$id]])->where([['task.type',1],['task.status',0]])->count();
     if ($step > 0 ){
       return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn tất toàn bộ điều kiện !');
    }

    
     DB::table("step")->where('id', $id)->update([
            'state' => 2
        ]);

    return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');

      }else{
    
    $supstep = DB::table("substep_task")
    ->leftJoin('task', 'substep_task.task_id', '=', 'task.id')
    ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
    ->where([['substep.id',$id]])->where([['task.type',1],['task.status',0]])->count();

    if ($supstep > 0 ){
       return Redirect()->route('process-view', ['id' => $index])->with('warning',' Chưa hoàn tất toàn bộ điều kiện !');

    
     DB::table("substep")->where('id', $id)->update([
            'state' => 2
        ]);
       return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật chiến lược !');


      }

    }
  }

  public function getPay($index, $id){

      if(!$this->checkSaleMap()){
        return redirect("/");
      }

    $pay_info = DB::table("zone_pay")->where("id",$id)->first();
    $zid = $pay_info->zone_id;
    // dd($zid);
    if ($zid < 0 ){
        $zone = DB::table("zone_backup")->where("id",$zid*-1)->first();

        // dd($zone);
    }else{
        $zone = DB::table("zone")->where("id",$zid)->first();
    }

    $pay_detail = DB::table("zone_pay_detail")->where("pay_id",$id)->get()->where("status","1");

    return view('sale.pay',compact("index","zone",'pay_info','pay_detail','id',"zid"));

  }
  public function endPay($id){

  if(!$this->checkSaleMap()){
    return redirect("/");
  }

  $pay = DB::table("zone_pay_detail")->where("pay_id",$id)->get();

  $pay_total = 0;
  foreach ($pay as $pay) {
   $pay_total =  $pay_total + floatval($pay->money);
  }
  $pay_init =  floatval(DB::table("zone_pay")->where("id",$id)->first()->money);

  if ($pay_total - $pay_init > 10 ||  $pay_init - $pay_total < 10 ){

    DB::table("zone_pay")->where("id",$id)->update([
        "status"=>1
      ]);
    
    return redirect()->back()->with("notification","Đã kết thúc đợt thanh toán thành công");
  }else{
      return redirect()->back()->with("warning","Vui lòng kiểm tra vì tiền không khớp");
  }
}
  public function deletePay($id){

  if(!$this->checkSaleMap()){
    return redirect("/");
  }

  DB::table("zone_pay_detail")->where("id",$id)->update([
      "status"=>0
    ]);

    $pay_detail = DB::table("zone_pay_detail")->where("id",$id)->first();
    $pay_info = DB::table("zone_pay")->where("id",$pay_detail->pay_id)->first();

    $zone = DB::table("zone")->where("id",$pay_info->zone_id)->first();


   Zone::where("id",$zone->id)->update([
            'done' => floatval($zone->done) - floatval($pay_detail->money),
            "dept" => floatval($zone->dept) + floatval($pay_detail->money)
    ]);


  return redirect()->back()->with("notification","Đã xóa đợt thành toán");

  }

  public function deleteGap($id){

  if(!$this->checkSaleMap()){
    return redirect("/");
  }

  DB::table("zone_gap")->where("id",$id)->delete();


  return redirect()->back()->with("notification","Đã xóa đợt thành toán");

  }

  public function addPay(Request $request){

      if(!$this->checkSaleMap()){
        return redirect("/");
      }

    DB::table("zone_pay_detail")->insert([
      "pay_id"=>$request->id,
      "money"=>$request->amount,
      "date"=>$request->date
    ]);

      $zone_id =  DB::table("zone_pay")->where("id",$request->id)->first()->zone_id;

      $zone = DB::table("zone")->where("id",$zone_id)->first();


       DB::table("zone_noti")->insert([
            'zone_id' => $zone_id,
            'user_id'=>$zone->staff_id,
            'content'=>"Đã cập nhật thanh toán căn ".$zone->name
        ]);
        $comsumer_id = DB::table("consumer")->where("id",$zone->consumer_id)
        ->first()->user_id;
        if($comsumer_id > 0){
        DB::table("zone_noti")->insert([
            'zone_id' => $zone_id,
            'user_id'=>$comsumer_id,
            'content'=>"Đã cập nhật thanh toán căn ".$zone->name
        ]);
    }

        $users = DB::table("users")->where("role_id",2)->where("status",1)->get();

    foreach($users as $user){
        DB::table("zone_noti")->insert([
            'zone_id' => $zone_id,
            'user_id'=>$user->id,
            'content'=>"Đã cập nhật thanh toán căn ".$zone->name
        ]);
    }


    $pay_info = DB::table("zone_pay")->where("id",$request->id)->first();
    $zone = DB::table("zone")->where("id",$pay_info->zone_id)->first();
    // dd($zone);
    Zone::where("id",$zone->id)->update([
            'done' => floatval($zone->done) + floatval($request->amount),
            "dept" => floatval($zone->dept) - floatval($request->amount)
    ]);

    $response = $this->sendMessage("Căn hộ ".$zone->name. " đã thanh toán tiến độ  đợt ".$pay_info->step."(Số tiền ".$request->amount.")" ,1,0);
   
    $event  = new Event();
   $event->title = "Căn hộ ".$zone->name;
    $event->type = 1;
    $event->description = "Đã thanh toán tiến độ  đợt ".$pay_info->step."(Số tiền ".$request->amount.")";
    // $data = json_decode($response, true);
    $event->permiss = 0;
    $event->user_id = Auth()->user()->id;

    $event->save();


    return redirect()->back()->with("notification","Đã thêm đợt thanh toán");

  }



  public function getGap($index){

      if(!$this->checkSaleMap()){
        return redirect("/");
      }

    $zone_id = DB::table("zone_process")->where("id",$index)->first()->zone_id;

    $zone = DB::table("zone")->where("id",$zone_id)->first();

    $gap = DB::table("zone_gap")->where("zone_id",$zone_id)->get();

    return view('sale.gap',compact("index","zone",'gap'));

  }
 public function addGap(Request $request){

      if(!$this->checkSaleMap()){
        return redirect("/");
      }

    DB::table("zone_gap")->insert([
      "zone_id"=>$request->id,
      "money"=>$request->amount,
      "date"=>$request->date
    ]);


   //  $response = $this->sendMessage("Căn hộ ".$zone->name. " đã thanh toán tiến độ  đợt ".$pay_info->step."(Số tiền ".$request->amount.")" ,1,0);
   
   //  $event  = new Event();
   // $event->title = "Căn hộ ".$zone->name;
   //  $event->type = 1;
   //  $event->description = "Đã thanh toán tiến độ  đợt ".$pay_info->step."(Số tiền ".$request->amount.")";
   //  // $data = json_decode($response, true);
   //  $event->permiss = 0;
   //  $event->user_id = Auth()->user()->id;

   //  $event->save();


    return redirect()->back()->with("notification","Đã cập nhật hoa hồng");

  }



   public function getFileTask($index, $id){

      if(!$this->checkSaleMap()){
        return redirect("/");
      }

    $zone_task = DB::table("zone_task")
    ->where("id",$id)->first();

    $task_id = $zone_task->task_id;

    $zone_id = $zone_task->zone_id;

    $task =  DB::table("staff_task")->where("id", $task_id)->first();
    if($zone_id > 0){
    $zone = DB::table("zone")->where("id",$zone_id)->first();
}else{
    $zone = DB::table("zone_backup")->where("id",$zone_id*-1)->first();

}
    $file = DB::table("zone_task_url")->where("task_id",$id)->get();

    return view('sale.file',compact("index","zone",'task','file','id',"zone_id"));
    
   
  }


   public function getFileTaskIcon($index, $id){
      if(!$this->checkSaleMap()){
        return redirect("/");
      }


    $zone_task = DB::table("zone_task")
    ->where("id",$id)->first();

    $task_id = $zone_task->task_id;

    $zone_id = $zone_task->zone_id;

    $task =  DB::table("staff_task")->where("id", $task_id)->first();

    $zone = DB::table("zone")->where("id",$zone_id)->first();

    $file = DB::table("zone_task_url")->where("task_id",$id)->get();

    return view('sale.file-icon',compact("index","zone",'task','file','id'));

  }

  function editTaskFile(Request $request){
      if(!$this->checkSaleMap()){
        return redirect("/");
      }

    // dd($request->id);
  $i = DB::table("zone_task_url")->where("task_id",$request->id)->count();

// try{
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->route('sale-file', ['id' => $request->id])->with('warning',' Tệp tin không đúng định dạng !');

      }
      $path = $file->store('system');

      $url = Storage::url($path);

      $i = $i +1;
       DB::table("zone_task_url")->insert([
            'url' => $url,
            'task_id'=>$request->id,
            'image_id'=>$i,
        ]);



      }

      $zone_id =  DB::table("zone_task")->where("id",$request->id)->first()->zone_id;

      $zone = DB::table("zone")->where("id",$zone_id)->first();

        DB::table("zone_noti")->insert([
            'zone_id' => $zone_id,
            'user_id'=>$zone->staff_id,
            'content'=>"Đã cập nhật tiến độ căn ".$zone->name
        ]);

      $comsumer_id = DB::table("consumer")->where("id",$zone->consumer_id)
        ->first()->user_id;
        if($comsumer_id > 0){
        DB::table("zone_noti")->insert([
            'zone_id' => $zone_id,
            'user_id'=>$comsumer_id,
            'content'=>"Đã cập nhật thanh toán căn ".$zone->name
        ]);
    }

        $users = DB::table("users")->where("role_id",2)->where("status",1)->get();

    foreach($users as $user){
        DB::table("zone_noti")->insert([
            'zone_id' => $zone_id,
            'user_id'=>$user->id,
            'content'=>"Đã cập nhật tiến độ căn ".$zone->name
        ]);
    }


//         }
// catch (\Exception $e) { 
//     return Redirect()->route('sale-file', ['index' => $request->index,'id' => $request->id])->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
//                }

 return Redirect()->route('sale-file', ['index' => $request->index,'id' => $request->id])->with('notification',' Đã thêm tệp tin thành công !');

}
  


function DeleteFileTask($index,$id){
      if(!$this->checkLead()){
        return redirect("/");
      }

  $tid = DB::table("zone_task_url")->where("id",$id)->first()->task_id;
       DB::table("zone_task_url")->where("id",$id)->delete();
 return Redirect()->route('sale-file', ['index' => $index,'id' => $tid])->with('notification',' Đã xóa tệp tin !');

}

    public function updateSale(Request $req){
// try{
      if(!$this->checkSaleMap()){
        return redirect("/");
      }

      // dd($req->trans_type);
      if ($req->con_id > 0){

        // dd("okjoe");




        $consumer_id = $req->con_id;

         Consumer::where('id',$consumer_id )->update([
            'name' => $req->cname1,
            'birth_date' => $req->birth_day1,
            'phone_number' => $req->cphone1,
            "email" => $req->cemail1,
            "married" => $req->married,
            "married_role" => $req->married_role,
            "identify_card" => $req->cidentify1,
            "iden_date" => $req->ciden_date1,
            "iden_location" => $req->clocation1,
            "address" => $req->caddress1
        ]);


        $consumer = Consumer::where("id",$req->con_id)->first();
        $count =Consumer2::where("consumer_id",$consumer_id)->count();
        if($count > 0 ){
        $consumer2 = Consumer2::where("consumer_id",$consumer_id)->first();
         Consumer2::where('consumer_id', $consumer_id)->update([
           'name' => $req->cname1,
            'birth_date' => $req->birth_day2,
            'phone_number' => $req->cphone2,
            "email" => $req->cemail2,
            "identify_card" => $req->cidentify2,
            "iden_date" => $req->ciden_date2,
            "iden_location" => $req->clocation2,
            "address" => $req->caddress2
        ]);
        }else{
          
      if( $consumer->married == 2){
        $new_consumer2 = new Consumer2();
         $new_consumer2->consumer_id = $consumer_id;
         $new_consumer2->name = $req->cname2;
          $new_consumer2->birth_date = $req->birth_day2;
          $new_consumer2->phone_number = $req->cphone2;
          $new_consumer2->email = $req->cemail2;


          $new_consumer2->identify_card = $req->cidentify2;
          $new_consumer2->iden_date = $req->ciden_date2;
          $new_consumer2->iden_location = $req->clocation2;

          $new_consumer2->address = $req->caddress2;
          $new_consumer2->save();

          $consumer2 = $new_consumer2;

        }
      }
        

      }else{

      $flag = Consumer::where("identify_card",$req->cidentify1)->count();

      // if($flag > 0){

      //  return redirect()->back()->with("warning","Đã trùng chứng minh thư");
      

      //    $consumer = Consumer::where("identify_card",$req->cidentify1)->first();
      //    $consumer_id = $consumer->id;

      //    Consumer::where('id',$consumer_id )->update([
      //      'name' => $req->cname1,
      //      'birth_date' => $req->birth_day1,
      //      'phone_number' => $req->cphone1,
      //      "email" => $req->cemail1,
      //      "married" => $req->married,
      //      "married_role" => $req->married_role,
      //      "identify_card" => $req->cidentify1,
      //      "iden_date" => $req->ciden_date1,
      //      "iden_location" => $req->clocation1,
      //      "address" => $req->caddress1
      //  ]);
      //  $count = Consumer2::where("consumer_id",$consumer_id)->count();
     
      //  if($count > 0 ){
      //  $consumer2 = Consumer2::where("consumer_id",$consumer_id)->first();
      //   Consumer2::where('consumer_id', $consumer_id)->update([
      //     'name' => $req->cname2,
      //      'birth_date' => $req->birth_day2,
      //      'phone_number' => $req->cphone2,
      //      "email" => $req->cemail2,
      //      "identify_card" => $req->cidentify2,
      //      "iden_date" => $req->ciden_date2,
      //      "iden_location" => $req->clocation2,
      //      "address" => $req->caddress2
      //  ]);
      //  }else{

      // if( $consumer->married == 2){
      //  $new_consumer2 = new Consumer2();
      //   $new_consumer2->consumer_id = $consumer_id;
      //   $new_consumer2->name = $req->cname2;
      //    $new_consumer2->birth_date = $req->birth_day2;
      //    $new_consumer2->phone_number = $req->cphone2;
      //    $new_consumer2->email = $req->cemail2;


      //    $new_consumer2->identify_card = $req->cidentify2;
      //    $new_consumer2->iden_date = $req->ciden_date2;
      //    $new_consumer2->iden_location = $req->clocation2;

      //    $new_consumer2->address = $req->caddress2;
      //    $new_consumer2->save();

      //    $consumer2 = $new_consumer2;

      //  }
      // }
      // }else{

          if(strlen($req->cname1) > 200){
            return Redirect()->back()->with('warning',' Tên khách hàng quá dài ');
          }

          if(strlen($req->cphone1) > 15){
            return Redirect()->back()->with('warning',' Số điện thoại quá dài ');
          }
          if(strlen($req->cidentify1) > 15){
            return Redirect()->back()->with('warning',' Chứng minh thư quá dài ');
          }
          // print($req->identify);
          // dd(strlen($req->phone));
           $new_consumer = new Consumer();
            $new_consumer->name = $req->cname1;
            $new_consumer->birth_date = $req->birth_day1;
            $new_consumer->phone_number = $req->cphone1;
            $new_consumer->email = $req->cemail1;


            $new_consumer->married = $req->married;
            $new_consumer->married_role = $req->married_role;

            $new_consumer->identify_card = $req->cidentify1;
            $new_consumer->iden_date = $req->ciden_date1;
            $new_consumer->iden_location = $req->clocation1;

            $new_consumer->address = $req->caddress1;
            $new_consumer->save();
            $consumer = $new_consumer;
            $consumer_id = $new_consumer->id;
      
         DB::table("consumer_history")->insert([
            'zone_id' => $req->zone_id,
            'name' => $req->cname1,
            'birth_date' => $req->birth_day1,
            'phone_number' => $req->cphone1,
            "email" => $req->cemail1,
            "married" => $req->married,
            "married_role" => $req->married_role,
            "identify_card" => $req->cidentify1,
            "iden_date" => $req->ciden_date1,
            "iden_location" => $req->clocation1,
            "address" => $req->caddress1
        ]);

      if( $req->married == 2){
        $new_consumer2 = new Consumer2();
         $new_consumer2->consumer_id = $consumer_id;
         $new_consumer2->name = $req->cname2;
          $new_consumer2->birth_date = $req->birth_day2;
          $new_consumer2->phone_number = $req->cphone2;
          $new_consumer2->email = $req->cemail2;


          $new_consumer2->identify_card = $req->cidentify2;
          $new_consumer2->iden_date = $req->ciden_date2;
          $new_consumer2->iden_location = $req->clocation2;

          $new_consumer2->address = $req->caddress2;
          $new_consumer2->save();

          $consumer2 = $new_consumer2;
// }
      }
    }
  
      Zone::where('id', $req->zone_id)->update([
            'consumer_id' => $consumer_id,
        ]);
    
$now = Carbon::now();





// echo $now->year;
// echo $now->month;
// echo $now->weekOfYear;
    $zone = Zone::where('id', $req->zone_id)->first();

     if($zone->acreage > 120){
      
  $con_price = "1,636,685,000 ";
  $con_value = 1636685000;

     }else{
  $con_price = "1,558,055,000"; 
  $con_value = 1558055000;
     }

     // dd($zone->unit_price);
$unit_price = number_format(intval($zone->unit_price), 0, ",", ".");

                      

                

   
        return Redirect("/chatify/zone-sale/".$req->zone_id)->with('notification', 'cập nhật thông tin thành công');
    
  }
function convert_number_to_words($number) {
 
    $hyphen      = ' ';
    $conjunction = ' ';
    $separator   = ' ';
    $negative    = 'âm ';
    $decimal     = ' phẩy ';
    $one     = 'mốt';
    $ten         = 'lẻ';
    $dictionary  = array(
    0                   => 'Không',
    1                   => 'Một',
    2                   => 'Hai',
    3                   => 'Ba',
    4                   => 'Bốn',
    5                   => 'Năm',
    6                   => 'Sáu',
    7                   => 'Bảy',
    8                   => 'Tám',
    9                   => 'Chín',
    10                  => 'Mười',
    11                  => 'Mười một',
    12                  => 'Mười hai',
    13                  => 'Mười ba',
    14                  => 'Mười bốn',
    15                  => 'Mười lăm',
    16                  => 'Mười sáu',
    17                  => 'Mười bảy',
    18                  => 'Mười tám',
    19                  => 'Mười chín',
    20                  => 'Hai mươi',
    30                  => 'Ba mươi',
    40                  => 'Bốn mươi',
    50                  => 'Năm mươi',
    60                  => 'Sáu mươi',
    70                  => 'Bảy mươi',
    80                  => 'Tám mươi',
    90                  => 'Chín mươi',
    100                 => 'trăm',
    1000                => 'ngàn',
    1000000             => 'triệu',
    1000000000          => 'tỷ',
    1000000000000       => 'nghìn tỷ',
    1000000000000000    => 'ngàn triệu triệu',
    1000000000000000000 => 'tỷ tỷ'
    );
     
    if (!is_numeric($number)) {
      return false;
    }
     
    // if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
    //  // overflow
    //  trigger_error(
    //  'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
    //  E_USER_WARNING
    //  );
    //  return false;
    // }
     
    if ($number < 0) {
      return $negative . $this->convert_number_to_words(abs($number));
    }
     
    $string = $fraction = null;
     
    if (strpos($number, '.') !== false) {
      list($number, $fraction) = explode('.', $number);
    }
     
    switch (true) {
      case $number < 21:
        $string = $dictionary[$number];
      break;
      case $number < 100:
        $tens   = ((int) ($number / 10)) * 10;
        $units  = $number % 10;
        $string = $dictionary[$tens];
        if ($units) {
          $string .= strtolower( $hyphen . ($units==1?$one:$dictionary[$units]) );
        }
      break;
      case $number < 1000:
        $hundreds  = $number / 100;
        $remainder = $number % 100;
        $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
        if ($remainder) {
          $string .= strtolower( $conjunction . ($remainder<10?$ten.$hyphen:null) . $this->convert_number_to_words($remainder) );
        }
      break;
      default:
        $baseUnit = pow(1000, floor(log($number, 1000)));
        $numBaseUnits = (int) ($number / $baseUnit);
        $remainder = $number - ($numBaseUnits*$baseUnit);
        $string = $this->convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
        if ($remainder) {
          $string .= strtolower( $remainder < 100 ? $conjunction : $separator );
          $string .= strtolower( $this->convert_number_to_words($remainder) );
        }
      break;
    }
     
    if (null !== $fraction && is_numeric($fraction)) {
      $string .= $decimal;
      $words = array();
      foreach (str_split((string) $fraction) as $number) {
        $words[] = $dictionary[$number];
      }
      $string .= implode(' ', $words);
    }
     
    return $string;
  }


    public function postZoneComment(Request $request){
        // dd($request->zone_id);
       $zone =  DB::table("zone")->where("id",$request->zone_id)->first();

    try{
$cid = DB::table("consumer")->where("user_id",Auth()->user()->id)->first()->id;
}catch (\Exception $e) { 
    $cid =-1;
}
if(!$this->checkMap() && $cid != $zone->consumer_id){
        return redirect()->back()->with("warning","Bạn không có quyền bình luận");
      }

      $job_id  = DB::table("zone_comments")->insertGetId([
          'user_id' =>  Auth()->user()->id,
          'zone_id' => $request->zone_id,
          'content' => $request->content,
      ]);

         if ($request->file !== null){
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
      
      DB::table('zone_comments_url')->insert([
            'cmt_id' => $job_id,
            'url' => $url
        ]);
}
}

      $zone_name  = $zone->name;

        $response = $this->sendMessage("Cập nhật bình luận mới: ".$zone_name ,0,Auth::user()->id);
   
      $event  = new Event();
     $event->title = "Cập nhật bình luận";
      $event->type = 0;
      $event->description = $zone_name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = Auth()->user()->id;

      $event->save();

       return Redirect()->back()->with('notification',' Đã thêm bình luận thành công');
    }
 function pinMess($id){
    $message = DB::table('zone_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("zone_messages")->where("id",$id)->update(["pin"=>1]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    
    // }else{
    //             return redirect("/");

    // }
  }
function unpinMess($id){
    $message = DB::table('zone_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("zone_messages")->where("id",$id)->update(["pin"=>0]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }


function addZoneAlert($id){
    $alert = DB::table('zone_staff_alert')->where("zone_id",$id)
    ->where("user_id",Auth()->user()->id)
    ->first();
    if($alert == null){
    DB::table("zone_staff_alert")->insert([
        "seen"=>0,
        "zone_id"=>$id,
        "user_id"=>Auth()->user()->id
    ]);
    }else{
    DB::table("zone_staff_alert")->where("zone_id",$id)
    ->where("user_id",Auth()->user()->id)
    ->update(["seen"=>0]);

    }

         return Redirect()->back()->with('notification',' Đã thêm thông báo!');

  }

function removeZoneAlert($id){
    DB::table("zone_staff_alert")->where("zone_id",$id)
    ->where("user_id",Auth()->user()->id)
    ->update(["seen"=>1]);

         return Redirect()->back()->with('notification',' Đã thêm thông báo!');

  }

  function removeConsumerAlert($id){
    DB::table("consumer_noti")->where("consumer_id",$id)
    ->where("user_id",Auth()->user()->id)
    ->update(["seen"=>1]);

         return Redirect()->back()->with('notification',' Đã thêm thông báo!');

  }


   function saveMess($id){
    $message = DB::table('zone_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    if(strlen($message->attachment) > 0){
    DB::table("zone_messages")->where("id",$id)->update(["storage"=>1]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
     }
      return Redirect()->back()->with('warning',' Minh chứng buộc phải có tệp đính kèm!');

    // }else{
    //             return redirect("/");

    // }
  }
function unsaveMess($id){
    $message = DB::table('zone_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("zone_messages")->where("id",$id)->update(["storage"=>0]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }

}
