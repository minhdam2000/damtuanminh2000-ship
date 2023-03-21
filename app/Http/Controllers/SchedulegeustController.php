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
use App\Job;
use App\Jobmoniters;
use App\Staff;
use App\Accountant;
use App\Department;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class SchedulegeustController extends Controller
{	
        function detail($token){

            $id =  DB::table("schedule")->where("token",$token)->first()->id;
            if(Auth::user()) {  

                  $job_user = DB::table("schedule")->where("id",$id)->first()->user_id;

             if($job_user == Auth()->user()->id){
                DB::table("schedule_user")->where("schedule_id",$id)->update(["seen" =>1]);
             }
                DB::table("schedule_user")->where("schedule_id",$id)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
              // dd();
              // if($this->checkLead()){
                 DB::table("job_noti")->where("job_id",$id)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
              // }

              $chat = DB::table("job_comments")->where("job_id",$id)->get();

              $schedule = DB::table("schedule")
            ->leftJoin('schedule_user', 'schedule_user.schedule_id', '=', 'schedule.id')
                    ->leftJoin('users', 'users.id', '=', 'schedule_user.user_id')
                    ->select("schedule.id as id",
                            "schedule.last_id as last_id",
                        "schedule.user_id as user_id","schedule.title as title","schedule.content as content","schedule.status as status"
                      ,"schedule.start_date as start_date","schedule.end_date as end_date")
                    // ->select(DB::raw("count(users.id)"))
                    ->groupBy('schedule.id')
                    ->where("schedule.id", $id)->first();
                    
                $files = DB::table("schedule_file")  ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
                 ->select("schedule_file.id as id",
                    "schedule_file.user_id as user_id",
                            "schedule_file.title as title",
                            "schedule_file.type as type",
                            "schedule_file.url as url",
                            "schedule_file.created_at as time",
                        "users.name as uname")

                ->where("schedule_id",$id)->get();

               $messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time","schedule_messages.pin as pin"
                      ,"users.name as name","users.avatar as avatar")
                    ->where("schedule_messages.schedule_id", $id)
                ->orderBy('schedule_messages.created_at', 'asc')->get();
            $chat_id  =  DB::table("schedule_messages")->orderBy('created_at', 'desc')->first()->id;
            // dd($chat_id);
            $sub_chat_id  =  DB::table("schedule_sub_messages")->orderBy('created_at', 'desc')->first()->id;
                try{
            $chat_pin  =  DB::table("schedule_messages")->where("schedule_id", $id)
            ->where("pin",1)
            ->orderBy('created_at', 'desc')->get();

            }catch (\Exception $e) {
                $chat_id =0;
            }
            $attachment = DB::table("schedule_messages")->where("schedule_id", $id) ->where("attachment","<>", "NULL")->get();


               $mids = DB::table("schedule_messages") ->where("schedule_id", $id)->pluck('id')->toArray();
            $subattachment = DB::table("schedule_sub_messages")->whereIn("messages_id",$mids) ->where("attachment","<>", "NULL")->get();
            // dd($attachment);
                 return view('schedule.detail', compact('schedule','chat','files',"chat_id","messages","attachment","chat_pin","sub_chat_id","subattachment"));

            }
            // if(!isset(Cookie::get('guest_name'))){

            // }

              $job_user = DB::table("schedule")->where("id",$id)->first()->user_id;


              $chat = DB::table("job_comments")->where("job_id",$id)->get();

              $schedule = DB::table("schedule")
            ->leftJoin('schedule_user', 'schedule_user.schedule_id', '=', 'schedule.id')
                    ->leftJoin('users', 'users.id', '=', 'schedule_user.user_id')
                    ->select("schedule.id as id",
                            "schedule.last_id as last_id",
                        "schedule.user_id as user_id","schedule.title as title","schedule.content as content","schedule.status as status"
                      ,"schedule.start_date as start_date","schedule.end_date as end_date")
                    // ->select(DB::raw("count(users.id)"))
                    ->groupBy('schedule.id')
                    ->where("schedule.id", $id)->first();
                    
                $files = DB::table("schedule_file")  ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
                 ->select("schedule_file.id as id",
                    "schedule_file.user_id as user_id",
                            "schedule_file.title as title",
                            "schedule_file.type as type",
                            "schedule_file.url as url",
                            "schedule_file.created_at as time",
                        "users.name as uname")

                ->where("schedule_id",$id)->get();

               $messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar")
                    ->where("schedule_messages.schedule_id", $id)
                ->orderBy('schedule_messages.created_at', 'asc')->get();
                try{
            $chat_id  =  DB::table("schedule_messages")->orderBy('created_at', 'desc')->first()->id;
            }catch (\Exception $e) {
                $chat_id =0;
            }
            $attachment = DB::table("schedule_messages")->where("schedule_id", $id) ->where("attachment","<>", "NULL")->get();

            $sub_chat_id  =  DB::table("schedule_sub_messages")->orderBy('created_at', 'desc')->first()->id;
           
            $chat_pin  =  DB::table("schedule_messages")->where("schedule_id", $id)
            ->where("pin",1)
            ->orderBy('created_at', 'desc')->get();
            // dd($attachment);

                $mids = DB::table("schedule_messages") ->where("schedule_id", $id)->pluck('id')->toArray();
            $subattachment = DB::table("schedule_sub_messages")->whereIn("messages_id",$mids) ->where("attachment","<>", "NULL")->get();
                 return view('schedule.guest-detail', compact('schedule','chat','files',"chat_id","messages","attachment","sub_chat_id","chat_pin","subattachment"));


        }
    public function login(){
        $name = $_COOKIE['guest_name'];
        $id = DB::table("schedule_guest")->insertGetId(["name"=>$name]);
    setcookie("guest_id", $id, time()+3600*24, "/", false);
        // echo $_COOKIE['guest_id'];
        // dd("DKM coookire");
        return Redirect()->back();
    // dd($value);

    }
    
    public function getFile($id){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
        $type = 2;
        $schedule = DB::table("schedule")
        ->where("id",$id)->first();
        $file = DB::table("schedule_file")->where("schedule_id",$id)->get();
        return view('schedule.file',compact('schedule','file','id','type'));

    }

     function addFile(Request $request){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
            $title = $request->title;
          $i = DB::table("schedule_file")->where("schedule_id",$request->id)->count();
          try{
        foreach ($request->file as $file) {
              $file_name = $file->getClientOriginalName();
              if(strlen($file_name) < 2){
            return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

              }
              if(strlen($title) < 2){
                    $title = $file_name;
              }
              // dd($title);
              $path = $file->store('system');

              $url = Storage::url($path);

              $i = $i +1;

               DB::table("schedule_file")->insert([
                    'url' => $url,
                    'title'=>$title,
                    'schedule_id'=>$request->id,
                    'image_id'=>$i,
                    'user_id'=>$_COOKIE['guest_id']*-1,
                    'type'=>$request->type,
                ]);



              }

                  $schedule = DB::table("schedule")->where("id",$request->id)->first();


        $sids =  DB::table("schedule_user")->where("schedule_id",$request->id)->pluck('user_id')->toArray();
          foreach ($sids as $sid) {
                  DB::table('job_noti')->insert([
                  'job_id' => $schedule->id,
                  'user_id' => $sid
              ]);

          if($schedule->root_id > 0){
                   DB::table('job_noti')->insert([
              'job_id' => $schedule->root_id,
              'user_id' => $sid
          ]);
          if ($schedule->root_id != $schedule->last_id){
                DB::table('job_noti')->insert([
                'job_id' => $schedule->last_id,
                'user_id' => $sid
                ]);
            }
        }

              }

         $lead = $this->getLead();
        foreach ($lead as $lid) {
             if($sids != null){
        if (in_array($lid, $sids)) {
            continue;
        }
    }
    
          DB::table('job_noti')->insert([
          'job_id' => $schedule->id,
          'user_id' => $lid
      ]);
           DB::table('job_noti')->insert([
              'job_id' => $schedule->root_id,
              'user_id' => $lid
          ]);
          if($schedule->root_id > 0){
          if ($schedule->root_id != $schedule->last_id){
                DB::table('job_noti')->insert([
                'job_id' => $schedule->last_id,
                'user_id' => $lid
                ]);
        }
    }

      }
      


                }
        catch (\Exception $e) { 
            return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
                       }

         return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

        }
          function editFileName(Request $request){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
             DB::table('schedule_file')
                      ->where('id', $request->id)
                      ->update(['title' => $request->title]);

         return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

        }
            


        function DeleteFileProcess($id){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
          if(!$this->checkLead()){
                return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
        }

          // $tid = DB::table("schedule_file")->where("id",$id)->first()->task_id;
               DB::table("schedule_file")->where("id",$id)->delete();
         return Redirect()->back()->with('notification',' Đã xóa tệp tin !');

        }

function messSaveDB(Request $req){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
        DB::table("schedule_messages")->insert([
            "schedule_id"=>$req->id,
            "user_id"=>$_COOKIE['guest_id']*-1,
            "body"=>$req->mess
        ]);


        DB::table('job_noti')->where("job_id",$req->id)->delete();


           $schedule = DB::table("schedule")->where("id",$req->id)->first();


        $sids =  DB::table("schedule_user")->where("schedule_id",$req->id)->pluck('user_id')->toArray();
          foreach ($sids as $sid) {
                  DB::table('job_noti')->insert([
                  'job_id' => $req->id,
                  'user_id' => $sid
              ]);

          if($schedule->root_id > 0){
                   DB::table('job_noti')->insert([
              'job_id' => $schedule->root_id,
              'user_id' => $sid
          ]);
          if ($schedule->root_id != $schedule->last_id){
                DB::table('job_noti')->insert([
                'job_id' => $schedule->last_id,
                'user_id' => $sid
                ]);
            }
        }

              }

         $lead = $this->getLead();
        foreach ($lead as $lid) {
             if($sids != null){
        if (in_array($lid, $sids)) {
            continue;
        }
    }
    
          DB::table('job_noti')->insert([
          'job_id' => $req->id,
          'user_id' => $lid
      ]);
           DB::table('job_noti')->insert([
              'job_id' => $schedule->root_id,
              'user_id' => $lid
          ]);
          if($schedule->root_id > 0){
          if ($schedule->root_id != $schedule->last_id){
                DB::table('job_noti')->insert([
                'job_id' => $schedule->last_id,
                'user_id' => $lid
                ]);
        }
    }

      }




    }
  


function upload(Request $req){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
          try{
        $id_list = [];
        foreach ($req->file as $file) {
            if(strlen($req->name) > 0){
              $file_name = $req->name;
            }else{
              $file_name = $file->getClientOriginalName();
          }
              if(strlen($file_name) < 2){
            return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

              }
              $path = $file->store('system');
              $url = Storage::url($path);
               $id = DB::table("schedule_messages")->insertGetId([
                    "schedule_id"=>$req->id,
                    "user_id"=>$_COOKIE['guest_id']*-1,
                    "body"=>$file_name,
                    "attachment"=>$url
                ]);
               $id_list[] = $id;

              }
                }
        catch (\Exception $e) { 
            return 0;
                       }

                         $schedule_messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar")
                    ->whereIn("schedule_messages.id",$id_list)
                ->orderBy('schedule_messages.created_at', 'asc')->get();


            return json_encode($schedule_messages);




}

function getMess($sid,$id){

    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
        $schedule_messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar")
                    ->where("schedule_messages.id",">",$id)->where("user_id","<>",$_COOKIE['guest_id']*-1)
                    ->where("schedule_messages.schedule_id", $sid)
                ->orderBy('schedule_messages.created_at', 'asc')->get();

        $id  =  DB::table("schedule_messages")
                    ->where("schedule_messages.schedule_id", $sid)->orderBy('created_at', 'desc')->first()->id;

        return json_encode([$schedule_messages,$id]);
}


 function loadSubMess($id){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
            $data = DB::table("schedule_sub_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
                    ->select("schedule_sub_messages.id as id","schedule_sub_messages.user_id as user_id",
                            "schedule_sub_messages.body as body",
                        "schedule_sub_messages.attachment as attachment","schedule_sub_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar")
                    ->where("schedule_sub_messages.messages_id", $id)
                ->orderBy('schedule_sub_messages.created_at', 'asc')->get();
            return json_encode($data);
        }

        function getSubMess($mid,$id){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }

        $schedule_messages = DB::table("schedule_sub_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
                    ->select("schedule_sub_messages.id as id","schedule_sub_messages.user_id as user_id",
                            "schedule_sub_messages.body as body",
                        "schedule_sub_messages.attachment as attachment","schedule_sub_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar")
                    ->where("schedule_sub_messages.id",">",$id)->where("user_id","<>",Auth()->user()->id)
                    ->where("schedule_sub_messages.messages_id", $mid)
                ->orderBy('schedule_sub_messages.created_at', 'asc')->get();

        $id  =  DB::table("schedule_sub_messages")
                    ->where("schedule_sub_messages.messages_id", $mid)->orderBy('created_at', 'desc')->first()->id;

        return json_encode([$schedule_messages,$id]);
}

function subUpload(Request $req){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
          try{
        $id_list = [];
        foreach ($req->file as $file) {
              $file_name = $file->getClientOriginalName();
              if(strlen($file_name) < 2){
            return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

              }
              $path = $file->store('system');
              $url = Storage::url($path);
               $id = DB::table("schedule_sub_messages")->insertGetId([
                    "messages_id"=>$req->id,
                    "user_id"=>$_COOKIE['guest_id']*-1,
                    "body"=>$file_name,
                    "attachment"=>$url
                ]);
               $id_list[] = $id;

              }
                }
        catch (\Exception $e) { 
            return 0;
                       }

                         $schedule_messages = DB::table("schedule_sub_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
                    ->select("schedule_sub_messages.id as id","schedule_sub_messages.user_id as user_id",
                            "schedule_sub_messages.body as body",
                        "schedule_sub_messages.attachment as attachment","schedule_sub_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar")
                    ->whereIn("schedule_sub_messages.id",$id_list)
                ->orderBy('schedule_sub_messages.created_at', 'asc')->get();


            return json_encode($schedule_messages);




}
   function messSaveSubDB(Request $req){
    if(!isset($_COOKIE['guest_id'])){
        return 0;
    }
        $mid =  DB::table("schedule_sub_messages")->insertGetId([
            "messages_id"=>$req->id,
            "user_id"=>$_COOKIE['guest_id']*-1,
            "body"=>$req->mess
        ]);


        DB::table('job_noti')->where("job_id",$req->id)->delete();


           $schedule = DB::table("schedule")->where("id",$req->id)->first();


        $sids =  DB::table("schedule_user")->where("schedule_id",$req->id)->pluck('user_id')->toArray();
          foreach ($sids as $sid) {
                  DB::table('job_noti')->insert([
                  'job_id' => $req->id,
                  'user_id' => $sid
              ]);

          if($schedule->root_id > 0){
                   DB::table('job_noti')->insert([
              'job_id' => $schedule->root_id,
              'user_id' => $sid
          ]);
          if ($schedule->root_id != $schedule->last_id){
                DB::table('job_noti')->insert([
                'job_id' => $schedule->last_id,
                'user_id' => $sid
                ]);
            }
        }

              }

         $lead = $this->getLead();
        foreach ($lead as $lid) {
             if($sids != null){
        if (in_array($lid, $sids)) {
            continue;
        }
    }
    
          DB::table('job_noti')->insert([
          'job_id' => $req->id,
          'user_id' => $lid
      ]);
           DB::table('job_noti')->insert([
              'job_id' => $schedule->root_id,
              'user_id' => $lid
          ]);
          if($schedule->root_id > 0){
          if ($schedule->root_id != $schedule->last_id){
                DB::table('job_noti')->insert([
                'job_id' => $schedule->last_id,
                'user_id' => $lid
                ]);
        }
    }

      }
      return $mid;



    }

    function loadGuest($id){
          $uid1 = DB::table("schedule_messages") ->where("schedule_id", $id)->where("user_id", "<",0)->pluck('user_id')->toArray(); 

          $mid = DB::table("schedule_messages") ->where("schedule_id", $id)->pluck('id')->toArray(); 


          // dd($mid);
          $uid2 = DB::table("schedule_sub_messages") ->whereIn("messages_id", $mid)->where("user_id", "<",0)->pluck('user_id')->toArray(); 

          $arrays = array_merge($uid1, $uid2 );
          // dd($arrays);

          $final_array = [];
          foreach($arrays as $num) {
            $final_array[]= $num*-1;
        }

          $guest = DB::table("schedule_guest")->whereIn("id",$final_array)->get();
          return $guest;
    } 


}