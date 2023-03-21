<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use DB;
use File;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

use Carbon\Carbon;
class SchedulemessController extends Controller
{	


    function messSaveDB(Request $req){
        $mid =  DB::table("schedule_messages")->insertGetId([
            "schedule_id"=>$req->id,
            "user_id"=>Auth()->user()->id,
            "body"=>$req->mess
        ]);

$startDate = Carbon::now()->addMinutes(-30);
$endDate = Carbon::now();

$count = DB::table('job_noti')->where("job_id",$req->id) ->whereBetween('updated_at', [$startDate, $endDate])->count();
// dd($count);
if($count > 0){
    return $mid;
}
        DB::table('job_noti')->where("job_id",$req->id)->delete();


           $schedule = DB::table("schedule")->where("id",$req->id)->first();


        $sids =  DB::table("schedule_user")->where("schedule_id",$req->id)->pluck('user_id')->toArray();
          foreach ($sids as $sid) {
                  DB::table('job_noti')->insert([
                  'job_id' => $req->id,
                  'user_id' => $sid
              ]);

        //   if($schedule->root_id > 0){
        //            DB::table('job_noti')->insert([
        //       'job_id' => $schedule->root_id,
        //       'user_id' => $sid
        //   ]);
        //   if ($schedule->root_id != $schedule->last_id){
        //         DB::table('job_noti')->insert([
        //         'job_id' => $schedule->last_id,
        //         'user_id' => $sid
        //         ]);
        //     }
        // }

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
          // if($schedule->root_id > 0){
          //          DB::table('job_noti')->insert([
          //             'job_id' => $schedule->root_id,
          //             'user_id' => $lid
          //         ]);
          //         if ($schedule->root_id != $schedule->last_id){
          //               DB::table('job_noti')->insert([
          //               'job_id' => $schedule->last_id,
          //               'user_id' => $lid
          //               ]);
          //       }
          //   }

      }
      return $mid;



    }

     function messSaveSubDB(Request $req){
        $mid =  DB::table("schedule_sub_messages")->insertGetId([
            "messages_id"=>$req->id,
            "user_id"=>Auth()->user()->id,
            "body"=>$req->mess
        ]);

        $schedule_id = DB::table("schedule_messages")->where("id",$req->id)->first()->schedule_id;
        DB::table('job_noti')->where("job_id",$schedule_id)->delete();


           $schedule = DB::table("schedule")->where("id",$schedule_id)->first();


        $sids =  DB::table("schedule_user")->where("schedule_id",$schedule_id)->pluck('user_id')->toArray();
          foreach ($sids as $sid) {
                  DB::table('job_noti')->insert([
                  'job_id' => $schedule_id,
                  'user_id' => $sid
              ]);

        //   if($schedule->root_id > 0){
        //            DB::table('job_noti')->insert([
        //       'job_id' => $schedule->root_id,
        //       'user_id' => $sid
        //   ]);
        //   if ($schedule->root_id != $schedule->last_id){
        //         DB::table('job_noti')->insert([
        //         'job_id' => $schedule->last_id,
        //         'user_id' => $sid
        //         ]);
        //     }
        // }

              }

         $lead = $this->getLead();
        foreach ($lead as $lid) {
             if($sids != null){
        if (in_array($lid, $sids)) {
            continue;
        }
    }
    
          DB::table('job_noti')->insert([
          'job_id' => $schedule_id,
          'user_id' => $lid
      ]);


          // if($schedule->root_id > 0){

          //              DB::table('job_noti')->insert([
          //                 'job_id' => $schedule->root_id,
          //                 'user_id' => $lid
          //             ]);
          //             if ($schedule->root_id != $schedule->last_id){
          //                   DB::table('job_noti')->insert([
          //                   'job_id' => $schedule->last_id,
          //                   'user_id' => $lid
          //                   ]);
          //           }
          //   }

      }
      return $mid;



    }

        function loadSubMess($id){
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
  
  function deleteMess($id){
    $message = DB::table('schedule_messages')->where("id",$id)->first();
    if($message->user_id == Auth()->user()->id){
    DB::table("schedule_messages")->where("id",$id)->delete();
         return Redirect()->back()->with('notification',' Đã xóa tin nhắn!');
    }else{
                return redirect("/");

    }
  }
  function pinMess($id){
    setcookie("mess_flag", 1, time()+3600*24, "/", false);
    $message = DB::table('schedule_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("schedule_messages")->where("id",$id)->update(["pin"=>1]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }
function unpinMess($id){
    setcookie("mess_flag", 1, time()+3600*24, "/", false);
    $message = DB::table('schedule_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("schedule_messages")->where("id",$id)->update(["pin"=>0]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }
 function pinMessThread($id){
    $message = DB::table('schedule_sub_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("schedule_sub_messages")->where("id",$id)->update(["pin"=>1]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }
function unpinMessThread($id){
    $message = DB::table('schedule_sub_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("schedule_sub_messages")->where("id",$id)->update(["pin"=>0]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }
  function deleteSubMess($id){
    $message = DB::table('schedule_sub_messages')->where("id",$id)->first();
    if($message->user_id == Auth()->user()->id){
    DB::table("schedule_sub_messages")->where("id",$id)->delete();
         return Redirect()->back()->with('notification',' Đã xóa tin nhắn!');
    }else{
                return redirect("/");

    }
  }
  function pinSubMess($id){
    $message = DB::table('schedule_sub_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("schedule_sub_messages")->where("id",$id)->update(["pin"=>1]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }

function getMess($sid,$id){
        // dd(">>>");
        $schedule_messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar")
                    ->where("schedule_messages.id",">",$id)->where("user_id","<>",Auth()->user()->id)
                    ->where("schedule_messages.schedule_id", $sid)
                ->orderBy('schedule_messages.id', 'asc')->get();
        // print_r($schedule_messages);
                try{
        $id  =  DB::table("schedule_messages")
                    ->where("schedule_messages.schedule_id", $sid)->orderBy('id', 'desc')->first()->id;
                    // dd($id);
  }catch (\Exception $e) {
                $id = 0;
            }
        return json_encode([$schedule_messages,$id]);
}

function getSubMess($mid,$id){

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


function upload(Request $req){
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
                    "user_id"=>Auth()->user()->id,
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


function subUpload(Request $req){
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
                    "user_id"=>Auth()->user()->id,
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


}