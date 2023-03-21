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

class ScheduleController extends Controller
{	
        function detail($id){

            DB::table('job_noti')->where("job_id",$id)
            ->where("user_id",Auth()->user()->id)->update(["seen"=>1]);

            $check1 = DB::table("schedule")
            ->leftJoin('schedule_user', 'schedule_user.schedule_id', '=', 'schedule.id')
           ->where("schedule_user.schedule_id",$id)->where('schedule_user.user_id',Auth::id())->count();

             $check2 = DB::table("schedule")->where("id",$id)->where('user_id',Auth::id())->count();


            if ($check1 < 1 && $check2 < 1 && !$this->checkLead()){
             return Redirect()->back()->with('warning', 'Tài khoản không có quyền với tác vụ');
        
            }

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
            
            // dd($chat_id);
            $chat_pin  =  DB::table("schedule_messages")->where("schedule_id", $id)
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time","schedule_messages.pin as pin"
                      ,"users.name as name","users.avatar as avatar")
            ->where("pin",1)
            ->orderBy('id', 'desc')->get();
                try{
                    $chat_id  =  DB::table("schedule_messages")->orderBy('id', 'desc')->first()->id;

            }catch (\Exception $e) {
                $chat_id =0;
            }

                try{
            $sub_chat_id  =  DB::table("schedule_sub_messages")->orderBy('id', 'desc')->first()->id;

            }catch (\Exception $e) {
                $sub_chat_id = 0;
            }
            $attachment = DB::table("schedule_messages")->where("schedule_id", $id) ->where("attachment","<>", "NULL")->get();


               $mids = DB::table("schedule_messages") ->where("schedule_id", $id)->pluck('id')->toArray();
            $subattachment = DB::table("schedule_sub_messages")->whereIn("messages_id",$mids) ->where("attachment","<>", "NULL")->get();
            // dd($attachment);
          
                 return view('schedule.detail', compact('schedule','chat','files',"chat_id","messages","attachment","chat_pin","sub_chat_id","subattachment"));


        }

        function drop($id){
        //   if(!$this->checkLead()){
        //         return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
        // }
        $uid =  DB::table("schedule")->where("id",$id)->first()->user_id;
       if ($this->checkLead() || $uid  == Auth()->user()->id){
       DB::table("schedule")->where("id",$id)->update(["status"=>2]);
       DB::table("job_noti")->where("job_id",$id)->delete();


//          $sid = (!empty($_COOKIE["sid"])) ? ($_COOKIE["sid"]) : ('');

//          if($sid != ""){
//             $new_sid = "";
//             $sids = explode(",",$sid);
//             foreach($sids as $sid){
//                 if ($sid == $id){
//                     continue;
//                 }
//                 $new_sid = $new_sid.$sid.",";
//             }
//         }

// $new_sid   = substr_replace($new_sid  ,"", -1);
// setcookie("sid", $new_sid , time()+3600*24, "/", false);

//         // dd(time());
//         // setcookie("job_flag", 1, time()+3600*24, "/", false);
//     // dd($_COOKIE['job_flag']);
         return Redirect()->back()->with('notification',' Đã cập nhật trạng thái công việc !');
}else{
                return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');

}
        }

        function done($id){
          if(!$this->checkLead()){
                return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
        }
        $total = DB::table("schedule")->where("last_id",$id)->where("status","<",2)->count();
          $com = DB::table("schedule")->where("last_id",$id)->where("status",1)->count();
          if($total >0){
          $percent = round($com/$total*100,2);
        }else{
         $percent = 0;
        
        }

               $sid = (!empty($_COOKIE["sid"])) ? ($_COOKIE["sid"]) : ('');

         if($sid != ""){
            $new_sid = "";
            $sids = explode(",",$sid);
            foreach($sids as $sid){
                if ($sid == $id){
                    continue;
                }
                $new_sid = $new_sid.$sid.",";
            }
        }

$new_sid   = substr_replace($new_sid  ,"", -1);
setcookie("sid", $new_sid , time()+3600*24, "/", false);

       DB::table("schedule")->where("id",$id)->update(["status"=>1]);
    // setcookie("job_flag", 1, time()+3600*24, "/", false);

    // dd($_COOKIE['job_flag']);
         return Redirect()->back()->with('notification',' Đã cập nhật trạng thái công việc  !');

        }

        public function staff($id = 0){  
        $uid = Auth::user()->id;



        $sidB = DB::table("schedule")
        ->LeftJoin("schedule_user","schedule_user.schedule_id","schedule.id")
        ->where("schedule_user.user_id",$uid)
        ->pluck('schedule.id')->where("root_id",0)->toArray();




        $sidT = DB::table("schedule")
        ->whereIn("schedule.root_id",$sidB)
        ->pluck('schedule.id')->toArray();


      $did = DB::table("user_department")->where("user_id",Auth()->user()->id)->pluck('department_id')->toArray();

        $sidA = DB::table("schedule")
        ->LeftJoin("schedule_department","schedule_department.schedule_id","schedule.id")
        ->whereIn("schedule_department.department_id",$did)
        ->pluck('schedule.id')->toArray();

$sid = array_merge($sidA,$sidB);

// dd()
$sid2 = DB::table("schedule")
        ->where("user_id",$uid)
        ->pluck('schedule.id')->toArray();





        $curent_schedule =  DB::table("schedule")->where("root_id",0)->where("status",0)
        ->where(function($q) use ($sid, $uid) {
                    $q->whereIn("id",$sid)
                    ->orWhere('user_id', $uid);
  })->get();
      
            $complete_schedule =  DB::table("schedule")->where("root_id",0)->where("status",1) ->where(function($q) use ($sid, $uid) {
                    $q->whereIn("id",$sid)
                    ->orWhere('user_id', $uid);
  })->get();

            $stop_schedule = DB::table("schedule")->where("root_id",0)->where("status",2) ->where(function($q) use ($sid, $uid) {
                    $q->whereIn("id",$sid)
                    ->orWhere('user_id', $uid);
  })->get();



$schedule_list = array_merge($sid,$sidT);

 // dd($schedule_list);

            if($id > 0 ){
                  $mys = DB::table("schedule")->where("id",$id)->first();
                  $did = DB::table("schedule_department")->where("schedule_id",$mys->id)->pluck('department_id')->toArray();

            $dept = DB::table("department")->whereIn("id",$did)->get();
            }else{

            $dept = DB::table("department")->get();
            }


            return view('schedule.staff', compact('schedule_list','id','dept','curent_schedule','complete_schedule','stop_schedule'));
    }


    public function dept($id = 0){  
    // setcookie("job_flag", 0, time()+3600*24, "/", false);
// dd($_COOKIE['job_flag']);
        // dd($_COOKIE['job_flag']);
        if(!$this->checkLead()){
            
            return redirect("/");
        }


        $sids = DB::table("schedule_department")->where("department_id",$id)->pluck('schedule_id')->toArray();

        $curent_schedule =  DB::table("schedule")->where("building_id",0)->where("root_id",0)->where("status",0)->whereIn("id",$sids )->get();
        // dd($curent_schedule);
            $complete_schedule =  DB::table("schedule")->where("building_id",0)->where("root_id",0)->where("status",1)->whereIn("id",$sids )->get();

            $stop_schedule = DB::table("schedule")->where("root_id",0)->where("building_id",0)->where("status",2)->whereIn("id",$sids )->get();
 $schedule_list =  DB::table("schedule")->where("root_id",0)->where("building_id",0)->whereIn("id",$sids )->pluck('id')->toArray();

            // if($id > 0 ){
            //       $mys = DB::table("schedule")->where("id",$id)->first();
            //       $did = DB::table("schedule_department")->where("schedule_id",$mys->id)->pluck('department_id')->toArray();

            // $dept = DB::table("department")->whereIn("id",$did)->get();
            // }else{

            $dept = DB::table("department")->get();
            // }


            $job_users = DB::table("schedule")
            ->RightJoin('schedule_department', 'schedule.id', '=', 'schedule_department.schedule_id')
            ->RightJoin('department', 'department.id', '=', 'schedule_department.department_id')
  ->select("department.id as id", "department.name as name",
                DB::raw('sum(CASE WHEN schedule.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN schedule.status = 1 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN schedule.status = 2 THEN 1 ELSE 0 END) as s2')
            )

          ->groupBy('department.id')
                ->orderBy('department.id', 'asc')

          ->get();

 // dd($schedule_list);
            return view('schedule.dept', compact('schedule_list','id','dept','curent_schedule','complete_schedule','stop_schedule',"job_users"));
    }



    public function test($id = 0){  
    // setcookie("job_flag", 0, time()+3600*24, "/", false);
// dd($_COOKIE['job_flag']);
        // dd($_COOKIE['job_flag']);
        if(!$this->checkLead()){
            
            return redirect("/");
        }
        $curent_schedule =  DB::table("schedule")->where("building_id",0)->where("root_id",$id)->where("status",0)->get();
            $complete_schedule =  DB::table("schedule")->where("building_id",0)->where("root_id",$id)->where("status",1)->get();

            $stop_schedule = DB::table("schedule")->where("building_id",0)->where("root_id",$id)->where("status",2)->get();
 $schedule_list =  DB::table("schedule")->where("root_id",0)->where("status",0)->pluck('id')->toArray();

            if($id > 0 ){
                  $mys = DB::table("schedule")->where("building_id",0)->where("id",$id)->first();
                  $did = DB::table("schedule_department")->where("schedule_id",$mys->id)->pluck('department_id')->toArray();

            $dept = DB::table("department")->whereIn("id",$did)->get();
            }else{

            $dept = DB::table("department")->get();
            }


            $job_users = DB::table("schedule")
            ->RightJoin('schedule_department', 'schedule.id', '=', 'schedule_department.schedule_id')
            ->RightJoin('department', 'department.id', '=', 'schedule_department.department_id')
  ->select("department.id as id", "department.name as name",
                DB::raw('sum(CASE WHEN schedule.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN schedule.status = 1 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN schedule.status = 2 THEN 1 ELSE 0 END) as s2')
            )
->where("schedule.building_id",0)
          ->groupBy('department.id')
                ->orderBy('department.id', 'asc')

          ->get();
        // dd($schedule_list);

 // dd($schedule_list);
            return view('schedule.boss', compact('schedule_list','id','dept','curent_schedule','complete_schedule','stop_schedule',"job_users"));
    }

    public function getSubscheduleAsJson($id){
         $schedule =  DB::table("schedule")->where("building_id",0)->where("last_id",$id)->get();
         $dept_list = [];
         $name_list = [];
         $uname_list = [];
         $fix_list = [];
         $percent_list = [];
         $seen = [];
         foreach($schedule as $sle){
            $did = DB::table("schedule_department")->where("schedule_id",$sle->id)->pluck('department_id')->toArray();
            $dname = DB::table("department")->whereIn("id",$did)->pluck('name')->toArray();

            $html = "";
            foreach($dname as $dname){
              $html = $html . $dname . ",";
            }

            $html = substr($html, 0, -1); 
            $dept_list[] = $html; 

            $uid = DB::table("schedule_user")->where("schedule_id",$sle->id)->pluck('user_id')->toArray();
            // echo $sle->id."<br>";
            $uname = DB::table("users")->whereIn("id",$uid)->pluck('name')->toArray();

            $html = "";
            foreach($uname as $uname){
              $html = $html .$uname .",";
            }

            $html = substr($html, 0, -1); 
            $name_list[] = $html;
             $temp = "";
             if(DB::table("users")->where("id",$sle->user_id)->first()!=null){
            if(DB::table("users")->where("id",$sle->user_id)->first()->id == Auth()->user()->id || $this->checkLead()){
               $temp =  ' <span class="job-create preview sicon" data-toggle="modal" onclick="BtnJobClick(this)" data-target="#create-job" id="'.$sle->id.'"><img src="/js-css/img/icon/plus.png"></span> <a class="sicon" onclick="confirm_remove(this,'.$sle->id.') " ><span class="preview"><img src="/js-css/img/icon/stop.png"></span></a>';

   // $temp =  ' <span class="job-create preview sicon" data-toggle="modal" onclick="BtnJobClick(this)" data-target="#create-job" id="'.$sle->id.'"><img src="/js-css/img/icon/plus.png"></span> <a class="sicon" href="/schedule/done/'.$sle->id.'"> <span class="preview"><img src="/js-css/img/icon/success.png"></span></a><a class="sicon" href="/schedule/drop/'.$sle->id.'"><span class="preview"><img src="/js-css/img/icon/stop.png"></span></a>';

               // <a href="/schedule/detail/'.$sle->id.'"><span class="preview"><img src="/js-css/img/icon/eye.png"></span></a> ';
              // a= '<span style="margin-left: 2%" class="job-update preview" data-toggle="modal" data-target="#edit-job-modal" id="{{$sle->id}}"><img src="/js-css/img/icon/write.png"></span>';
            }
        }
            $fix_list[] = $temp; 

                  $total = DB::table("schedule")->where("building_id",0)->where("last_id",$sle->id)->where("status","<",2)->count();
                  $com = DB::table("schedule")->where("building_id",0)->where("last_id",$sle->id)->where("status",1)->count();


                if($total >0){
                    $percent = round($com/$total*100,2);
                }else{
                  if ($sle->status == 0){
                    $percent = 0;
                  }else{
                    $percent = 100;
                  }
                }
                $percent_list[] = $percent;

                try{
            $seen_temp = DB::table('job_noti')->where("job_id",$sle->id)
            ->where("user_id",Auth()->user()->id)->first()->seen;


              }catch (\Exception $e) {
            $seen_temp = 1;
          }

          // try{
            $jids = DB::table("schedule")->where("building_id",0)->where("last_id",$sle->id)->pluck("id")->toArray();

            $sub_seen = DB::table('job_noti')->whereIn("job_id",$jids)
            ->where("user_id",Auth()->user()->id)->where("seen","<",1)->count();

          // }catch (\Exception $e) {
          //   $sub_seen = 0;
          // }
            if($seen_temp < 1 || $sub_seen > 0){
            $seen[]= 0;
            }else{
            $seen[]= 1;

            }

         }
         // dd($name_list);
         return json_encode([$schedule,$dept_list,$name_list,$fix_list,$percent_list,$seen]);
    }

 public function getSubscheduleForStaffAsJson($id){
        $uid = Auth::user()->id;


        $sidT1 = DB::table("schedule")
        ->LeftJoin("schedule_user","schedule_user.schedule_id","schedule.id")
        ->where("schedule_user.user_id",$uid)->where("building_id",0)
        ->pluck('schedule.id')->toArray();


        $sidT2 = DB::table("schedule")
        ->where("schedule.user_id",$uid)->where("building_id",0)
        ->pluck('schedule.id')->toArray();

        $sidT = array_merge($sidT1,$sidT2);



        $list_ids = $schedule =  DB::table("schedule")->where("last_id",$id)->pluck("id")->toArray();


        $sid1 = DB::table("schedule")
        ->whereIn("last_id",$sidT)->where("building_id",0)
        ->distinct()
        ->pluck('id')
        ->toArray();

         $sid2 = DB::table("schedule")
        ->whereIn("root_id",$sidT)->where("building_id",0)
        ->distinct()
        ->pluck('id')
        ->toArray();

        $sid = array_merge($sid1,$sid2,$sidT);
        // print_r($sid);
        // dd($list_ids);
        $final_list = [];
        foreach($list_ids as $id){
            // if (in_array($id,$sid)){
                $final_list[] = $id;
            // }
        }
        // dd($final_list);
        $schedule =  DB::table("schedule")
        ->whereIn("id",$final_list)->get();

         $dept_list = [];
         $name_list = [];
         $uname_list = [];
         $fix_list = [];
         $percent_list = [];
         $seen = [];
         foreach($schedule as $sle){


            $did = DB::table("schedule_department")->where("schedule_id",$sle->id)->pluck('department_id')->toArray();
            $dname = DB::table("department")->whereIn("id",$did)->pluck('name')->toArray();

            $html = "";
            foreach($dname as $dname){
              $html = $html . $dname . ",";
            }

            $html = substr($html, 0, -1); 
            $dept_list[] = $html; 

            $uid = DB::table("schedule_user")->where("schedule_id",$sle->id)->pluck('user_id')->toArray();
            // echo $sle->id."<br>";
            $uname = DB::table("users")->whereIn("id",$uid)->pluck('name')->toArray();

            $html = "";
            foreach($uname as $uname){
              $html = $html .$uname .",";
            }

            $html = substr($html, 0, -1); 
            $name_list[] = $html;
             $temp = "";
            if(DB::table("users")->where("id",$sle->user_id)->first()->id == Auth()->user()->id || $this->checkLead()){
               $temp =  ' <span class="job-create preview sicon" data-toggle="modal" onclick="BtnJobClick(this)" data-target="#create-job" id="'.$sle->id.'"><img src="/js-css/img/icon/plus.png"></span> <a class="sicon" onclick="confirm_remove(this,'.$sle->id.') " ><span class="preview"><img src="/js-css/img/icon/stop.png"></span></a>';
            }
            $fix_list[] = $temp; 

                  $total = DB::table("schedule")->where("last_id",$sle->id)->where("status","<",2)->count();
                  $com = DB::table("schedule")->where("last_id",$sle->id)->where("status",1)->count();


                if($total >0){
                    $percent = round($com/$total*100,2);
                }else{
                  if ($sle->status == 0){
                    $percent = 0;
                  }else{
                    $percent = 100;
                  }
                }
                $percent_list[] = $percent;

                try{
            $seen_temp = DB::table('job_noti')->where("job_id",$sle->id)
            ->where("user_id",Auth()->user()->id)->first()->seen;


              }catch (\Exception $e) {
            $seen_temp = 1;
          }

          // try{
            $jids = DB::table("schedule")->where("last_id",$sle->id)->pluck("id")->toArray();

            $sub_seen = DB::table('job_noti')->whereIn("job_id",$jids)
            ->where("user_id",Auth()->user()->id)->where("seen","<",1)->count();

          // }catch (\Exception $e) {
          //   $sub_seen = 0;
          // }
            if($seen_temp < 1 || $sub_seen > 0){
            $seen[]= 0;
            }else{
            $seen[]= 1;

            }

         }
         // dd($name_list);
         return json_encode([$schedule,$dept_list,$name_list,$fix_list,$percent_list,$seen]);
    }

	public function index($id = 0){
        dd("123");
        // dd("????");
    // setcookie("job_flag", 0, time()+3600*24, "/", false);
// dd($_COOKIE['job_flag']);
            // dd(Auth::user()->role_id);
        if($this->checkLead()){
            $schedule = DB::table("schedule")->where("building_id",0)->where("root_id",$id);

            $curent_schedule =  DB::table("schedule")->where("building_id",0)->where("root_id",$id)->where("status",0)->get();
            $complete_schedule =  DB::table("schedule")->where("building_id",0)->where("root_id",$id)->where("status",1)->get();

            $stop_schedule = DB::table("schedule")->where("root_id",$id)->where("status",2)->get();
        }else{
            $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();
$curent_schedule = DB::table("schedule")->where("building_id",0)->whereIn("id",$sid)->where("root_id",$id)->where("status",0)->get();
$complete_schedule = DB::table("schedule")->where("building_id",0)>whereIn("id",$sid)->where("root_id",$id)->where("status",1)->get();
$stop_schedule = DB::table("schedule")->where("building_id",0)->whereIn("id",$sid)->where("root_id",$id)->where("status",2)->get();

        }

            if($id > 0 ){
                  $mys = DB::table("schedule")->where("id",$id)->first();
                  $did = DB::table("schedule_department")->where("schedule_id",$mys->id)->pluck('department_id')->toArray();

            $dept = DB::table("department")->whereIn("id",$did)->get();
            }else{

            $dept = DB::table("department")->get();
            }
            return view('schedule.index', compact('id','schedule',
                'curent_schedule','complete_schedule','stop_schedule'
                ,'dept'));
        
    }

    public function addNewBuild(Request $req){
      //      if(!$this->checkAdmin()){
      //   return redirect("/");
      // }

        if($req->id > 0){
            $schedule = DB::table("schedule")->where("id",$req->id)->first();
            if($schedule->root_id == 0){

                $root_id = $req->id;
            }else{
                $root_id = $schedule->root_id ;
            }


        }else{
            $root_id = 0;
        }
        // dd($req->id);
        $schedule_id = DB::table("schedule")->insertGetId([
            'root_id' => $root_id,
            'last_id' => $req->id,
            'building_id' => $req->building_id,
            'user_id' => Auth()->user()->id,
            'title' => $req->name,
            'content' => $req->des,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ]);

    // dd($_COOKIE['job_flag']);
            return Redirect()->back()->with('notification',' Đã tạo gói thầu thành công ');
            }
  
  
	public function addNew(Request $req){
      //      if(!$this->checkAdmin()){
      //   return redirect("/");
      // }

        if($req->id > 0){
            $schedule = DB::table("schedule")->where("id",$req->id)->first();
            if($schedule->root_id == 0){

                $root_id = $req->id;
            }else{
                $root_id = $schedule->root_id ;
            }


        }else{
            $root_id = 0;
        }
        // dd($req->id);
        $schedule_id = DB::table("schedule")->insertGetId([
            'root_id' => $root_id,
            'last_id' => $req->id,
            'user_id' => Auth()->user()->id,
            'title' => $req->name,
            'content' => $req->des,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ]);

  try{
        $i = 0;
        foreach ($req->file as $file) {
              $file_name = $file->getClientOriginalName();
              if(strlen($file_name) < 2){
            return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

              }
              // dd($title);
              $path = $file->store('system');

              $url = Storage::url($path);

              $i = $i +1;

               DB::table("schedule_file")->insert([
                    'url' => $url,
                    'title'=>$file_name,
                    'schedule_id'=>$schedule_id,
                    'image_id'=>$i,
                    'user_id'=>Auth()->user()->id,
                    'type'=>0,
                ]);



              }
          }
          catch(\Exception $e) { 
           $falg = 1;
                       }



    $sid_array = $req->sid;

    // dd($sid_array);
    if($sid_array != null){
      foreach ($sid_array as $sid) {
        DB::table('schedule_user')->insert([
          'schedule_id' => $schedule_id,
          'user_id' => $sid
      ]);

        DB::table('job_noti')->insert([
          'job_id' => $schedule_id,
          'user_id' => $sid
      ]);
    //       if($root_id > 0){
    //       DB::table('job_noti')->insert([
    //       'job_id' => $root_id,
    //       'user_id' => $sid
    //   ]);
    //       if ($root_id != $req->id){
    //             DB::table('job_noti')->insert([
    //             'job_id' => $req->id,
    //             'user_id' => $sid
    //             ]);
    //     }
    // }

            
        }
    }


      $lead = $this->getLead();

       foreach ($lead as $lid) {

    if($sid_array != null){
        if (in_array($lid, $sid_array)) {
            // dd("oke");
            // continue;
        }
    }
          DB::table('job_noti')->insert([
          'job_id' => $schedule_id,
          'user_id' => $lid
      ]);
    //       if($root_id > 0){
    //         DB::table('job_noti')->insert([
    //       'job_id' => $root_id,
    //       'user_id' => $lid
    //   ]);
    //       if ($root_id !== $req->id){
    //             DB::table('job_noti')->insert([
    //             'job_id' => $req->id,
    //             'user_id' => $lid
    //             ]);
    //     }
    // }

      }

    $did_array = $req->did;

    if($did_array != null){
   foreach ($did_array as $did) {
    // dd($did);
          DB::table('schedule_department')->insert([
          'schedule_id' => $schedule_id,
          'department_id' => $did
      ]);

            
        }
    }
    setcookie("job_flag", 1, time()+3600*24, "/", false);

    // dd($req->dept0_id);
    if(!is_null($req->dept_id)){
         DB::table('schedule_department')->insert([
          'schedule_id' => $schedule_id,
          'department_id' => $req->dept_id
      ]);

    }
    // dd($_COOKIE['job_flag']);
            return Redirect()->back()->with('notification',' Đã tạo công việc thành công ');
            }

	
    public function addNewStaff(Request $req){
      //      if(!$this->checkAdmin()){
      //   return redirect("/");
      // }

        if($req->id > 0){
            $schedule = DB::table("schedule")->where("id",$req->id)->first();
            if($schedule->root_id == 0){

                $root_id = $req->id;
            }else{
                $root_id = $schedule->root_id ;
            }


        }else{
            $root_id = 0;
        }
        // dd($req->id);
        $schedule_id = DB::table("schedule")->insertGetId([
            'root_id' => $root_id,
            'last_id' => $req->id,
            'user_id' => Auth()->user()->id,
            'title' => $req->name,
            'content' => $req->des,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ]);

  try{
        $i = 0;
        foreach ($req->file as $file) {
              $file_name = $file->getClientOriginalName();
              if(strlen($file_name) < 2){
            return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

              }
              // dd($title);
              $path = $file->store('system');

              $url = Storage::url($path);

              $i = $i +1;

               DB::table("schedule_file")->insert([
                    'url' => $url,
                    'title'=>$file_name,
                    'schedule_id'=>$schedule_id,
                    'image_id'=>$i,
                    'user_id'=>Auth()->user()->id,
                    'type'=>0,
                ]);



              }
          }
          catch(\Exception $e) { 
           $falg = 1;
                       }



   
    setcookie("job_flag", 1, time()+3600*24, "/", false);

    // dd($_COOKIE['job_flag']);
            return Redirect()->back()->with('notification',' Đã tạo công việc thành công ');
            }

    public function close(Request $req){
        if($req->status == 1){
             $total = DB::table("schedule")->where("last_id",$req->id)->where("status","<",2)->count();
                  $com = DB::table("schedule")->where("last_id",$req->id)->where("status",1)->count();

                  if($com > 0){
                if($total >0){
                    $percent = round($com/$total*100,2);
                }else{
                    $percent = 0;
                }
                if($percent != 100){
                     return Redirect()->back()->with('warning',' Các công việc con chưa hoàn thành ');
                }
                }
        }

            $schedule_id = DB::table("schedule")->where("id",$req->id)->where("status",0)->update([
                    'status' => $req->status
                ]);

            DB::table("job_noti")->where("job_id",$req->id)->delete();
             return Redirect()->back()->with('notification',' Đã cập nhật trạng thái ');
    }

    public function getEdit($id)
    {
        
            DB::table('job_noti')->where("job_id",$id)
            ->where("user_id",Auth()->user()->id)->update(["seen"=>1]);

            $check1 = DB::table("schedule")
            ->leftJoin('schedule_user', 'schedule_user.schedule_id', '=', 'schedule.id')
           ->where("schedule_user.schedule_id",$id)->where('schedule_user.user_id',Auth::id())->count();

             $check2 = DB::table("schedule")->where("id",$id)->where('user_id',Auth::id())->count();


            if ($check1 < 1 && $check2 < 1 && !$this->checkLead()){
             return Redirect()->back()->with('warning', 'Tài khoản không có quyền với tác vụ');
        
            }

              $job_user = DB::table("schedule")->where("id",$id)->first()->user_id;

             if($job_user == Auth()->user()->id){
                DB::table("schedule_user")->where("schedule_id",$id)->update(["seen" =>1]);
             }
                DB::table("schedule_user")->where("schedule_id",$id)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
              // dd();
              // if($this->checkLead()){
                 DB::table("job_noti")->where("job_id",$id)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
              // }

             
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
   return view('schedule.edit', compact('schedule'));

    }
  public function editBuild(Request $req){
// dd("!23");
       $schedule_id = DB::table("schedule")->where("id",$req->id)->update([
            'title' => $req->name,
            'content' => $req->des,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ]);


             return Redirect()->back()->with('notification',' Đã cập nhật trạng thái ');


}
    public function edit(Request $req){
        if($req->status > 0){
             $schedule_id = DB::table("schedule")->where("id",$req->id)->update([
            'status' => $req->status
        ]);


             $schedule_id = DB::table("schedule")->where("id",$req->id)->where("status",0)->update([
            'status' => $req->status
        ]);

             return Redirect()->back()->with('notification',' Đã tạo công việc thành công ');
        
        }

           $schedule_id = DB::table("schedule")->where("id",$req->id)->update([
            'title' => $req->name,
            'content' => $req->des,
            'start_date' => $req->start_date,
            'end_date' => $req->end_date
        ]);

           $schedule = DB::table("schedule")->where("id",$req->id)->first();


    $sid_array = $req->sid;
DB::table('schedule_user')->where("schedule_id",$req->id)->delete();
DB::table('schedule_department')->where("schedule_id",$req->id)->delete();
DB::table('job_noti')->where("job_id",$req->id)->delete();


    // dd($sid_array);


        // dd($sid_array);
    if($sid_array != null){
      foreach ($sid_array as $sid) {
          DB::table('schedule_user')->insert([
          'schedule_id' => $req->id,
          'user_id' => $sid
      ]);

            DB::table('job_noti')->insert([
                'job_id' => $req->id,
                'user_id' => $sid
            ]);


        }
    }


      $lead = $this->getLead();
       foreach ($lead as $lid) {
         if($sid_array != null){
        if (in_array($lid, $sid_array)) {
            continue;
        }
    }

          DB::table('job_noti')->insert([
          'job_id' => $req->id,
          'user_id' => $lid
      ]);
    }

      

    $did_array = $req->did;

    if($did_array != null){
   foreach ($did_array as $did) {
    // dd($did);
          DB::table('schedule_department')->insert([
          'schedule_id' => $req->id,
          'department_id' => $did
      ]);

            
        }
    }
            return Redirect("/chatify/schedule/".$req->id)->with('notification',' Đã tạo công việc thành công ');
        
        

    }
    
    public function getFile($id){
        $type = 2;
        $schedule = DB::table("schedule")
        ->where("id",$id)->first();
        $file = DB::table("schedule_file")->where("schedule_id",$id)->get();
        return view('schedule.file',compact('schedule','file','id','type'));

    }

     function addFile(Request $request){
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
                    'user_id'=>Auth()->user()->id,
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

      }
      


                }
        catch (\Exception $e) { 
            return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
                       }

         return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

        }
          function editFileName(Request $request){
             DB::table('schedule_file')
                      ->where('id', $request->id)
                      ->update(['title' => $request->title]);

         return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

        }
            


        function DeleteFileProcess($id){
          if(!$this->checkLead()){
                return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
        }

          // $tid = DB::table("schedule_file")->where("id",$id)->first()->task_id;
               DB::table("schedule_file")->where("id",$id)->delete();
         return Redirect()->back()->with('notification',' Đã xóa tệp tin !');

        }

        function getToken($id){
            $check1 = DB::table("schedule")
            ->leftJoin('schedule_user', 'schedule_user.schedule_id', '=', 'schedule.id')
           ->where("schedule_user.schedule_id",$id)->where('schedule_user.user_id',Auth::id())->count();

             $check2 = DB::table("schedule")->where("id",$id)->where('user_id',Auth::id())->count();


            if ($check1 < 1 && $check2 < 1 && !$this->checkLead()){
             return 0;
            }

            $schedule = 
            DB::table("schedule")
           ->where("id",$id)->first();

           if($schedule->token == null){
            $token = Str::random(30);
            DB::table("schedule")
           ->where("id",$id)
           ->update(["token"=>$token]);
            }else{
                $token = $schedule->token;
            }
            return $token;
        }

        function createThread($id){
            
                return view('schedule.thread', compact('id'));
        }

        function postCreateThread(Request $req){

            if($req->file != null){
             $file = $req->file;
            
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
}else{
$url ="/js-css/img/icon/users.png";
}

           $tid =  DB::table("schedule_threads")->insertGetId([
                "schedule_id" => $req->schedule_id,
                "title" => $req->name,
                "url" => $url,
                "user_id" => Auth()->user()->id,
                "open" => $req->open
            ]);


          $mid =  DB::table("schedule_sub_messages")->insertGetId([
                "messages_id" => $tid,
                "user_id" => Auth()->user()->id,
                "body" => $req->des,
            ]);

     $sid_array = $req->sid;
 DB::table('schedule_thread_user')->insert([
          'thread_id' => $tid,
          'user_id' => Auth()->user()->id
      ]);
    // dd($sid_array);
    if($sid_array != null){
      foreach ($sid_array as $sid) {
          if( Auth()->user()->id == $sid){
            continue;
        }

        DB::table('schedule_thread_user')->insert([
          'thread_id' => $tid,
          'user_id' => $sid
      ]);

        }
    }
            return Redirect("/chatify/schedule/".$req->schedule_id)->with('notification',' Đã thêm hội thoại thành công ');



        }

          function addThread($id){
            $sid = DB::table("schedule_threads")->where("id",$id)->first()->schedule_id;
                return view('schedule.thread-member', compact('id','sid'));
        }

        function postAddThread(Request $req){


   
     $sid_array = $req->sid;
    // dd($req->thread_id);
    if($sid_array != null){
      foreach ($sid_array as $sid) {
        $count = DB::table('schedule_thread_user')->where("user_id",$sid)->where("thread_id",$req->thread_id)->count();

        if( $count > 0){
            continue;
        }
        DB::table('schedule_thread_user')->insert([
          'thread_id' => $req->thread_id,
          'user_id' => $sid
      ]);

        }
    }
            return Redirect("/chatify/schedule/".$req->schedule_id)->with('notification',' Đã thêm thành viên thành công ');



        }


        function leaveThread($id){

            DB::table("schedule_thread_user")->where("thread_id",$id)->where("user_id",Auth()->user()->id)->delete();
            return Redirect()->back()->with('notification',' Đã rời khỏi cuộc trò chuyện');
        }
        function kickThread($id,$uid){
            $rid = DB::table("schedule_threads")->where("id",$id)->first()->user_id;
            if ($rid != Auth()->user()->id){
return Redirect()->back()->with('warning',' Không có quyền truy cập ');

            }
              DB::table("schedule_thread_user")->where("thread_id",$id)->where("user_id",$uid)->delete();
            
            return Redirect()->back()->with('notification',' Đã xóa thành viên ');
        }
}