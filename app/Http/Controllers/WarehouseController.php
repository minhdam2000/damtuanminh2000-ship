<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManagerStatic as Image;


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

use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Cookie;


use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use FuzzyWuzzy\Collection;



class WarehouseController extends Controller
{   

     public function tool(){   
 
    $display_data = DB::table("file_fuzzy")->where("status",0)->get();

    return view('warehouse.tool',compact('display_data'));  


     }


    public function fuzzyUpdate($id){   
 
        $check = DB::table("file_fuzzy")
            ->where("id",$id)
            ->update(["status"=>1]);
    
        return Redirect()->back()->with('notification',' Đã cập nhật !');
    }

     public function admin(){   

    $uid = Auth::user()->id;
    $rids = DB::table("user_role")->where("user_id",$uid)->pluck("role_id")->toArray();

    $dids = DB::table("roles")->whereIn("id",$rids)->pluck("department_id")->toArray();

      //    if(!$this->checkContributeMap()){
      //   return redirect("/");
      // }


    // $file = DB::table("contribute_file")
    // ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    // ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    // ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    // ->select("users.name as uname","contribute_file.name as name"
    //   ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
    //   ,"contribute_file.type as type"
    //   ,"contribute_file.open as open"
    //   ,"contribute_file.created_at as time"
    //           ,DB::raw("count(DISTINCT contribute_file.id) as num")
    //           ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    // )

    //         ->groupBy('contribute_file.name')->get();

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);

if($this->checkLead()){
     DB::table("warehouse_noti")->where("seen",0)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
  }

$private_file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('contribute_file_user', 'contribute_file.id', '=', 'contribute_file_user.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
    )
    ->Where("contribute_file.open",0)
    ->Where("contribute_file.user_id",Auth()->user()->id)
    ->orWhere("contribute_file_user.user_id",Auth()->user()->id)

            ->groupBy('contribute_file.name')->get();   


$private_file_ids = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('contribute_file_user', 'contribute_file.id', '=', 'contribute_file_user.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
    )
    ->Where("contribute_file.open",0)
    ->Where("contribute_file.user_id",Auth()->user()->id)
    ->orWhere("contribute_file_user.user_id",Auth()->user()->id)

            ->pluck("contribute_file.id")->toArray();
//dd($private_file_ids);
// dd($private_file );
$user_dept = DB::table("user_department")
                ->where("user_id", Auth()->user()->id)
                ->pluck("department_id")->toArray();

$private_dept_file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('contribute_file_department', 'contribute_file.id', '=', 'contribute_file_department.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
    )
    ->whereIn("contribute_file_department.department_id",$user_dept)
    ->Where("contribute_file.open",0)
    ->Where("contribute_file.user_id","<>",Auth()->user()->id)
    ->whereNotIn("contribute_file.id",$private_file_ids)

            ->groupBy('contribute_file.name')->get();

  
//dd($private_file );

if($this->checkLead()){
    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
    )
    ->Where("contribute_file.open",1)

            ->groupBy('contribute_file.name')->get();

  }
else{
  $fids = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->leftJoin('contribute_file_user', 'contribute_file_user.file_id', '=', 'contribute_file.id')
    ->leftJoin('contribute_file_department', 'contribute_file_department.file_id', '=', 'contribute_file.id')

    ->whereIn("contribute_file_department.department_id",$dids)
    ->orWhere("contribute_file_user.user_id",$uid)
    ->orWhere("contribute_file.open",1)
    ->distinct()->pluck("contribute_file.id")->toArray();

 $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )
    ->whereIn("contribute_file.id",$fids)
            ->groupBy('contribute_file.name')->get();

}

if($this->checkHuman()){


 $file2 = [];

// dd($file2);
       $cv = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->groupBy('files.name')->get();
}else{
  $file2  = [];
  $cv = [];
}



if($this->checkLead()){
    $schedules = DB::table("schedule")->get();
     $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
    ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
     ->select("schedule_file.id as id",
        "schedule_file.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_file.title as title",
                "schedule_file.type as type",
                "schedule_file.url as url",
                "schedule_file.created_at as time",
            "users.name as uname")
->get();


}else{
$sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();

$schedules = DB::table("schedule")->whereIn("id",$sid)->get();
  $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
    ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
     ->select("schedule_file.id as id",
        "schedule_file.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_file.title as title",
                "schedule_file.type as type",
                "schedule_file.url as url",
                "schedule_file.created_at as time",
            "users.name as uname")

     ->whereIn("schedule.id",$sid)
->get();

}
    // dd($job_files);


if($this->checkContributeMap()){
    $zone_history = DB::table("history_zone")
    ->leftJoin('zone', 'zone.id', '=', 'history_zone.zone_id')
     ->select("history_zone.id as id","zone.name as name","history_zone.description as description","history_zone.url as url",
   "history_zone.created_at as created_at")
    ->get();


    $build_history = DB::table("building_history_img")
    ->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
    ->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
     ->select("building_history_img.id as id","building_job.name as name","building_history_img.url as url",
   "building_history_img.created_at as created_at")
    ->get();
}else{
  $zone_history  = [];
  $build_history = [];
}

 $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();
        $schedule_messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
         ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time"
                       ,"users.name as name","users.avatar as avatar","schedule.title as title","schedule.id as sid")
                    ->whereIn("schedule_messages.schedule_id", $sid)
                ->orderBy('schedule_messages.created_at', 'asc')->get();
            ;
            // dd($schedule_messages);

        $tid = DB::table("schedule_thread_user")
            ->where("user_id",Auth()->user()->id)->pluck('thread_id')->toArray();

        $thread_messages = DB::table("schedule_sub_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
         ->leftJoin('schedule_threads', 'users.id', '=', 'schedule_sub_messages.messages_id')
         ->leftJoin('schedule', 'schedule.id', '=', 'schedule_threads.schedule_id')
                    ->select("schedule_sub_messages.id as id","schedule_sub_messages.user_id as user_id",
                            "schedule_sub_messages.body as body",
                        "schedule_sub_messages.attachment as attachment","schedule_sub_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar"
                       ,"schedule.title as title","schedule.id as sid")
                    ->whereIn("schedule_sub_messages.messages_id", $tid)
                    ->orWhere("open",1)
                ->orderBy('schedule_sub_messages.created_at', 'asc')->get();
            ;


        $zone_mess = [];
        if($this->checkMap()){
            $zone_mess = DB::table("zone_messages")  
            ->leftJoin('users', 'users.id', '=', 'zone_messages.user_id')
            ->leftJoin('zone', 'zone.id', '=', 'zone_messages.zone_id')
            ->leftJoin('zone_process', 'zone_process.zone_id', '=', 'zone.id')
            ->select("zone_messages.id as id","zone_messages.user_id as user_id",
                    "zone_messages.body as body",
                "zone_messages.attachment as attachment","zone_messages.created_at as time"
              ,"users.name as name","users.avatar as avatar",
                "zone.name as zname","zone_process.id as zid")
        ->orderBy('zone_messages.created_at', 'asc')->get();
            ;
        }


         $build_mess = [];
        if($this->checkMap()){
            $build_mess = DB::table("building_messages")  
            ->leftJoin('users', 'users.id', '=', 'building_messages.user_id')
            ->leftJoin('buildingg', 'buildingg.id', '=', 'building_messages.building_id')
            ->select("building_messages.id as id","building_messages.user_id as user_id",
                    "building_messages.body as body",
                "building_messages.attachment as attachment","building_messages.created_at as time"
              ,"users.name as name","users.avatar as avatar",
                "buildingg.title as btitle")
        ->orderBy('building_messages.created_at', 'asc')->get();
            ;
        }



    return view('warehouse.admin',compact("build_history",
      "tags","cv","zone_history","schedules","file",
      "schedule_files","schedule_messages","thread_messages"
      ,"zone_mess","build_mess","file2","private_file","private_dept_file"
    ));

  }


      public function index(){   

  
    $uid = Auth::user()->id;
    $rids = DB::table("user_role")->where("user_id",$uid)->pluck("role_id")->toArray();

    $dids = DB::table("roles")->whereIn("id",$rids)->pluck("department_id")->toArray();

      //    if(!$this->checkContributeMap()){
      //   return redirect("/");
      // }


    // $file = DB::table("contribute_file")
    // ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    // ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    // ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    // ->select("users.name as uname","contribute_file.name as name"
    //   ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
    //   ,"contribute_file.type as type"
    //   ,"contribute_file.open as open"
    //   ,"contribute_file.created_at as time"
    //           ,DB::raw("count(DISTINCT contribute_file.id) as num")
    //           ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    // )

    //         ->groupBy('contribute_file.name')->get();

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);

if($this->checkLead()){
     DB::table("warehouse_noti")->where("seen",0)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
  }

$private_file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('contribute_file_user', 'contribute_file.id', '=', 'contribute_file_user.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
    )
    ->Where("contribute_file.open",0)
    ->Where("contribute_file.user_id",Auth()->user()->id)
    ->orWhere("contribute_file_user.user_id",Auth()->user()->id)

            ->groupBy('contribute_file.name')->get();



$private_file_ids = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('contribute_file_user', 'contribute_file.id', '=', 'contribute_file_user.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
    )
    ->Where("contribute_file.open",0)
    ->Where("contribute_file.user_id",Auth()->user()->id)
    ->orWhere("contribute_file_user.user_id",Auth()->user()->id)

            ->groupBy('contribute_file.name')

            ->pluck("contribute_file.id")->toArray();

// dd($private_file_ids);
$user_dept = DB::table("user_department")
                ->where("user_id", Auth()->user()->id)
                ->pluck("department_id")->toArray();

$private_dept_file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('contribute_file_department', 'contribute_file.id', '=', 'contribute_file_department.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
    )
    ->whereIn("contribute_file_department.department_id",$user_dept)
    ->Where("contribute_file.open",0)
    ->Where("contribute_file.user_id","<>",Auth()->user()->id)
    ->whereNotIn("contribute_file.id",$private_file_ids)

            ->groupBy('contribute_file.name')->get();

  // $private_dept_file = [];

// dd($private_file );

if($this->checkLead()){
    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
    )
    ->Where("contribute_file.open",1)

            ->groupBy('contribute_file.name')->get();

  }
else{
  $fids = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->leftJoin('contribute_file_user', 'contribute_file_user.file_id', '=', 'contribute_file.id')
    ->leftJoin('contribute_file_department', 'contribute_file_department.file_id', '=', 'contribute_file.id')

    ->whereIn("contribute_file_department.department_id",$dids)
    ->orWhere("contribute_file_user.user_id",$uid)
    ->orWhere("contribute_file.open",1)
    ->distinct()->pluck("contribute_file.id")->toArray();

 $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.origin_name as origin_name"
      ,"contribute_file.user_id as user_id"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )
    ->whereIn("contribute_file.id",$fids)
            ->groupBy('contribute_file.name')->get();

}

if($this->checkHuman()){


 $file2 = [];

// dd($file2);
       $cv = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->groupBy('files.name')->get();
}else{
  $file2  = [];
  $cv = [];
}



if($this->checkLead()){
    $schedules = DB::table("schedule")->get();
     $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
    ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
     ->select("schedule_file.id as id",
        "schedule_file.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_file.title as title",
                "schedule_file.type as type",
                "schedule_file.url as url",
                "schedule_file.created_at as time",
            "users.name as uname")
->get();


}else{
$sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();

$schedules = DB::table("schedule")->whereIn("id",$sid)->get();
  $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
    ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
     ->select("schedule_file.id as id",
        "schedule_file.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_file.title as title",
                "schedule_file.type as type",
                "schedule_file.url as url",
                "schedule_file.created_at as time",
            "users.name as uname")

     ->whereIn("schedule.id",$sid)
->get();

}
    // dd($job_files);


if($this->checkContributeMap()){
    $zone_history = DB::table("history_zone")
    ->leftJoin('zone', 'zone.id', '=', 'history_zone.zone_id')
     ->select("history_zone.id as id","zone.name as name","history_zone.description as description","history_zone.url as url",
   "history_zone.created_at as created_at")
    ->get();


    $build_history = DB::table("building_history_img")
    ->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
    ->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
     ->select("building_history_img.id as id","building_job.name as name","building_history_img.url as url",
   "building_history_img.created_at as created_at")
    ->get();

   $build_file = DB::table("building_files")
    ->leftJoin('building_file_tags', 'building_files.id', '=', 'building_file_tags.file_id')
    ->leftJoin('tags', 'building_file_tags.tag_id', '=', 'tags.id')
    ->select("building_files.name as name","building_files.created_at as time"
        ,"building_files.id as id","building_files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->groupBy('building_files.name')->get();

}else{
  $zone_history  = [];
  $build_history = [];
  $build_file  = [];
}

 $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();
        $schedule_messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
         ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time"
                       ,"users.name as name","users.avatar as avatar","schedule.title as title","schedule.id as sid")
                    ->whereIn("schedule_messages.schedule_id", $sid)
                ->orderBy('schedule_messages.created_at', 'asc')->get();
            ;
            // dd($schedule_messages);

        $tid = DB::table("schedule_thread_user")
            ->where("user_id",Auth()->user()->id)->pluck('thread_id')->toArray();

        $thread_messages = DB::table("schedule_sub_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
         ->leftJoin('schedule_threads', 'users.id', '=', 'schedule_sub_messages.messages_id')
         ->leftJoin('schedule', 'schedule.id', '=', 'schedule_threads.schedule_id')
                    ->select("schedule_sub_messages.id as id","schedule_sub_messages.user_id as user_id",
                            "schedule_sub_messages.body as body",
                        "schedule_sub_messages.attachment as attachment","schedule_sub_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar"
                       ,"schedule.title as title","schedule.id as sid")
                    ->whereIn("schedule_sub_messages.messages_id", $tid)
                    ->orWhere("open",1)
                ->orderBy('schedule_sub_messages.created_at', 'asc')->get();
            ;


        $zone_mess = [];
        if($this->checkMap()){
            $zone_mess = DB::table("zone_messages")  
            ->leftJoin('users', 'users.id', '=', 'zone_messages.user_id')
            ->leftJoin('zone', 'zone.id', '=', 'zone_messages.zone_id')
            ->leftJoin('zone_process', 'zone_process.zone_id', '=', 'zone.id')
            ->select("zone_messages.id as id","zone_messages.user_id as user_id",
                    "zone_messages.body as body",
                "zone_messages.attachment as attachment","zone_messages.created_at as time"
              ,"users.name as name","users.avatar as avatar",
                "zone.name as zname","zone_process.id as zid")
        ->orderBy('zone_messages.created_at', 'asc')->get();
            ;
        }


         $build_mess = [];
        if($this->checkMap()){
            $build_mess = DB::table("building_messages")  
            ->leftJoin('users', 'users.id', '=', 'building_messages.user_id')
            ->leftJoin('buildingg', 'buildingg.id', '=', 'building_messages.building_id')
            ->select("building_messages.id as id","building_messages.user_id as user_id",
                    "building_messages.body as body",
                "building_messages.attachment as attachment","building_messages.created_at as time"
              ,"users.name as name","users.avatar as avatar",
                "buildingg.title as btitle")
        ->orderBy('building_messages.created_at', 'asc')->get();
            ;
        }



    $tag_groups = DB::table("tag_group")->get();
     $tag_groups_arr = [];
    foreach($tag_groups as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(";",DB::table("tags")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
        $tag_groups_arr[$tag->id]=$data;
    }


    return view('warehouse.index',compact("build_history",
      "tags","cv","zone_history","schedules","file",
      "schedule_files","schedule_messages","thread_messages"
      ,"zone_mess","build_mess","file2","private_file","private_dept_file",
      "tag_groups_arr","build_file"
    ));

  }


    public function list(){

        if(!$this->checkContributeMap()){
            return redirect("/");
        }
        $projects = Project::get();
        return view('warehouse.project', compact('projects'));
    }

public function sreach(){

    return view('warehouse.sreach');
  }


public function detail($id)
{

 


    $name = DB::table("contribute_file")->where("id",$id)->first()->name;
    $files = DB::table("contribute_file")->where("name",$name)->get();
    return view('warehouse.detail', compact('name','files',"id"));
}
  public function dataAll(){   

    $uid = Auth::user()->id;
    $rids = DB::table("user_role")->where("user_id",$uid)->pluck("role_id")->toArray();

    $dids = DB::table("roles")->whereIn("id",$rids)->pluck("department_id")->toArray();

      //    if(!$this->checkContributeMap()){
      //   return redirect("/");
      // }


    // $file = DB::table("contribute_file")
    // ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    // ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    // ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    // ->select("users.name as uname","contribute_file.name as name"
    //   ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
    //   ,"contribute_file.type as type"
    //   ,"contribute_file.open as open"
    //   ,"contribute_file.created_at as time"
    //           ,DB::raw("count(DISTINCT contribute_file.id) as num")
    //           ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    // )

    //         ->groupBy('contribute_file.name')->get();

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);

if($this->checkLead()){
     DB::table("warehouse_noti")->where("seen",0)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
  }


if($this->checkLead()){
    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.name')->get();

  }
else{
  $fids = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->leftJoin('contribute_file_user', 'contribute_file_user.file_id', '=', 'contribute_file.id')
    ->leftJoin('contribute_file_department', 'contribute_file_department.file_id', '=', 'contribute_file.id')

    ->whereIn("contribute_file_department.department_id",$dids)
    ->orWhere("contribute_file_user.user_id",$uid)
    ->orWhere("contribute_file.open",1)
    ->distinct()->pluck("contribute_file.id")->toArray();

 $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )
    ->whereIn("contribute_file.id",$fids)
            ->groupBy('contribute_file.name')->get();

}


if($this->checkHuman()){


 $file2 = DB::table("legal_process")
    ->leftJoin('legal_process_file', 'legal_process.id', '=', 'legal_process_file.lp_id')
    ->select("legal_process.title as name","legal_process_file.title as fname","legal_process_file.id as id", "legal_process_file.url as url","legal_process_file.created_at as created_at")
    ->get();

// dd($file2);
    $cv = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->groupBy('files.id')->get();
}else{
  $file2  = [];
  $cv = [];
}


if($this->checkLead()){
    $schedules = DB::table("schedule")->get();

    $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
    ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
     ->select("schedule_file.id as id",
        "schedule_file.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_file.title as title",
                "schedule_file.type as type",
                "schedule_file.url as url",
                "schedule_file.created_at as time",
            "users.name as uname")
->get();


    $schedule_attachment = DB::table("schedule_messages")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
     ->select("schedule_messages.id as id",
        "schedule_messages.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_messages.body as title",
                "schedule_messages.attachment as url",
                "schedule_messages.created_at as time",
            "users.name as uname")
    ->where("schedule_messages.attachment","<>", "NULL")->get();

    $schedule_subattachment = DB::table("schedule_sub_messages")
    ->leftJoin('schedule_messages', 'schedule_messages.id', '=', 'schedule_sub_messages.messages_id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
     ->select("schedule_sub_messages.id as id",
        "schedule_sub_messages.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_sub_messages.body as title",
                "schedule_sub_messages.attachment as url",
                "schedule_sub_messages.created_at as time",
            "users.name as uname")
    ->where("schedule_sub_messages.attachment","<>", "NULL")->get();
}else{
$sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();

$schedules = DB::table("schedule")->whereIn("id",$sid)->get();

    $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
    ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
     ->select("schedule_file.id as id",
        "schedule_file.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_file.title as title",
                "schedule_file.type as type",
                "schedule_file.url as url",
                "schedule_file.created_at as time",
            "users.name as uname")
->whereIn("schedule.id",$sid)->get();


  $schedule_attachment = DB::table("schedule_messages")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
     ->select("schedule_messages.id as id",
        "schedule_messages.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_messages.body as title",
                "schedule_messages.attachment as url",
                "schedule_messages.created_at as time",
            "users.name as uname")
    ->where("schedule_messages.attachment","<>", "NULL")->whereIn("schedule.id",$sid)->get();

    $schedule_subattachment = DB::table("schedule_sub_messages")
    ->leftJoin('schedule_threads', 'schedule_sub_messages.id', '=', 'schedule_threads.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_threads.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
     ->select("schedule_sub_messages.id as id",
        "schedule_sub_messages.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_sub_messages.body as title",
                "schedule_sub_messages.attachment as url",
                "schedule_sub_messages.created_at as time",
            "users.name as uname")
    ->where("schedule_sub_messages.attachment","<>", "NULL")->whereIn("schedule.id",$sid)->get();

}
    // dd($job_files);


if($this->checkContributeMap()){
    $zone_history = DB::table("history_zone")
    ->leftJoin('zone', 'zone.id', '=', 'history_zone.zone_id')
     ->select("history_zone.id as id","zone.name as name","history_zone.description as description","history_zone.url as url",
   "history_zone.created_at as created_at")
    ->get();


    $build_history = DB::table("building_history_img")
    ->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
    ->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
     ->select("building_history_img.id as id","building_job.name as name","building_history_img.url as url",
   "building_history_img.created_at as created_at")
    ->get();
}else{
  $zone_history  = [];
  $build_history = [];
}

    return view('warehouse.fileall',compact("build_history",
      "tags","cv","zone_history","schedules","file",
      "schedule_files","schedule_attachment","schedule_subattachment","file2"
    ));

  }

   public function dataImgAll(){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }

    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize"
      ,"contribute_file.type as type"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
    ->where("contribute_file.url","like","%.png%")
    ->orWhere("contribute_file.url","like","%.jpeg%")
    ->orWhere("contribute_file.url","like","%.jpg%")
    ->get();


    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


    return view('warehouse.fileall-img',compact('file',"tags"));

  }

     public function ImageList(){
      //    if(!$this->checkContributeMap()){
      //   return redirect("/");
      // }

    $uid = Auth::user()->id;
    $rids = DB::table("user_role")->where("user_id",$uid)->pluck("role_id")->toArray();

    $dids = DB::table("roles")->whereIn("id",$rids)->pluck("department_id")->toArray();

if($this->checkLead()){
    $query = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
    ->where("contribute_file.url","like","%.png%")
    ->orWhere("contribute_file.url","like","%.jpeg%")
    ->orWhere("contribute_file.url","like","%.jpg%");
}else{
      $fids = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->leftJoin('contribute_file_user', 'contribute_file_user.file_id', '=', 'contribute_file.id')
    ->leftJoin('contribute_file_department', 'contribute_file_department.file_id', '=', 'contribute_file.id')

    ->whereIn("contribute_file_department.department_id",$dids)
    ->orWhere("contribute_file_user.user_id",$uid)
    ->orWhere("contribute_file.open",1)
    ->distinct()->pluck("contribute_file.id")->toArray();

$query = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
    ->whereIn("contribute_file.id",$fids)
    ->where(function($q) {
     $q->where("contribute_file.url","like","%.png%")
    ->orWhere("contribute_file.url","like","%.jpeg%")
    ->orWhere("contribute_file.url","like","%.jpg%");
  });



}
// dd($query->get());

if($this->checkContributeMap()){
$process_file = DB::table("building_history_img")
->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
->leftJoin('users', 'users.id', '=', 'building_history.user_id')
->leftJoin('building_history_tag', 'building_history_tag.history_id', '=', 'building_history.id')
->leftJoin('tags', 'building_history_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","building_job.name as name",
"building_history.id as id","building_job.level as type","building_history_img.url as url"
  ,"building_history_img.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('building_history.id')
    ->where("building_history_img.url","like","%.png%")
    ->orWhere("building_history_img.url","like","%.jpeg%")
    ->orWhere("building_history_img.url","like","%.jpg%");



$zone_file = DB::table("history_zone")
->leftJoin('users', 'users.id', '=', 'history_zone.user_id')
->leftJoin('history_zone_tag', 'history_zone_tag.history_id', '=', 'history_zone.id')
->leftJoin('tags', 'history_zone_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","history_zone.description as name",
"history_zone.id as id",DB::raw('-1 as type'),"history_zone.url as url"
  ,"history_zone.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('history_zone.id')
    ->where("history_zone.url","like","%.png%")
    ->orWhere("history_zone.url","like","%.jpeg%")
    ->orWhere("history_zone.url","like","%.jpg%");
    }else{
$process_file = DB::table("building_history_img")
->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
->leftJoin('users', 'users.id', '=', 'building_history.user_id')
->leftJoin('building_history_tag', 'building_history_tag.history_id', '=', 'building_history.id')
->leftJoin('tags', 'building_history_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","building_job.name as name",
"building_history.id as id","building_job.level as type","building_history_img.url as url"
  ,"building_history_img.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('building_history.id')
    ->where("building_history.id",-1);



$zone_file = DB::table("history_zone")
->leftJoin('users', 'users.id', '=', 'history_zone.user_id')
->leftJoin('history_zone_tag', 'history_zone_tag.history_id', '=', 'history_zone.id')
->leftJoin('tags', 'history_zone_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","history_zone.description as name",
"history_zone.id as id",DB::raw('-1 as type'),"history_zone.url as url"
  ,"history_zone.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('history_zone.id')
    ->where("history_zone.id",-1);

    }

if($this->checkLead()){
   $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule_file_tag', 'schedule_file_tag.schedule_id', '=', 'schedule_file.id')
    ->leftJoin('tags', 'schedule_file_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
      ->select("users.name as uname","schedule_file.title as name",
"schedule_file.id as id",DB::raw('-1 as type'),"schedule_file.url as url"
  ,"schedule_file.url as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_file.id')
    ->where("schedule_file.url","like","%.png%")
    ->orWhere("schedule_file.url","like","%.jpeg%")
    ->orWhere("schedule_file.url","like","%.jpg%");


    $schedule_attachment = DB::table("schedule_messages")
    ->leftJoin('schedule_messages_tag', 'schedule_messages_tag.message_id', '=', 'schedule_messages.id')
    ->leftJoin('tags', 'schedule_messages_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
      ->select("users.name as uname","schedule_messages.body as name",
"schedule_messages.id as id",DB::raw('-2 as type'),"schedule_messages.attachment as url"
  ,"schedule_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_messages.id')
    ->where("schedule_messages.attachment","<>", "NULL")
    ->where("schedule_messages.attachment","like","%.png%")
    ->orWhere("schedule_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_messages.attachment","like","%.jpg%");

    $schedule_subattachment = DB::table("schedule_sub_messages")
    ->leftJoin('schedule_sub_messages_tag', 'schedule_sub_messages_tag.message_id', '=', 'schedule_sub_messages.id')
    ->leftJoin('tags', 'schedule_sub_messages_tag.tag_id', '=', 'tags.id')
      ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
      ->select("users.name as uname","schedule_sub_messages.body as name",
"schedule_sub_messages.id as id",DB::raw('-1 as type'),"schedule_sub_messages.attachment as url"
  ,"schedule_sub_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_sub_messages.id')
    ->where("schedule_sub_messages.attachment","<>", "NULL")
    ->where("schedule_sub_messages.attachment","like","%.png%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpg%");
}else{
    $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();

$schedules = DB::table("schedule")->whereIn("id",$sid)->get();

   $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule_file_tag', 'schedule_file_tag.schedule_id', '=', 'schedule_file.id')
    ->leftJoin('tags', 'schedule_file_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
      ->select("users.name as uname","schedule_file.title as name",
"schedule_file.id as id",DB::raw('-1 as type'),"schedule_file.url as url"
  ,"schedule_file.url as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_file.id')
->whereIn("schedule.id",$sid)
->where(function($q) {
     $q->where("schedule_file.url","like","%.png%")
    ->orWhere("schedule_file.url","like","%.jpeg%")
    ->orWhere("schedule_file.url","like","%.jpg%");
  });

    $schedule_attachment = DB::table("schedule_messages")
    ->leftJoin('schedule_messages_tag', 'schedule_messages_tag.message_id', '=', 'schedule_messages.id')
    ->leftJoin('tags', 'schedule_messages_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
      ->select("users.name as uname","schedule_messages.body as name",
"schedule_messages.id as id",DB::raw('-2 as type'),"schedule_messages.attachment as url"
  ,"schedule_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_messages.id')
->whereIn("schedule.id",$sid)
    ->where("schedule_messages.attachment","<>", "NULL")
    ->where(function($q) {
     $q->where("schedule_messages.attachment","like","%.png%")
    ->orWhere("schedule_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_messages.attachment","like","%.jpg%");
  });

    $schedule_subattachment = DB::table("schedule_sub_messages")
    ->leftJoin('schedule_threads', 'schedule_threads.id', '=', 'schedule_sub_messages.messages_id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_threads.schedule_id')
    ->leftJoin('schedule_sub_messages_tag', 'schedule_sub_messages_tag.message_id', '=', 'schedule_sub_messages.id')
    ->leftJoin('tags', 'schedule_sub_messages_tag.tag_id', '=', 'tags.id')
      ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
      ->select("users.name as uname","schedule_sub_messages.body as name",
"schedule_sub_messages.id as id",DB::raw('-2 as type'),"schedule_sub_messages.attachment as url"
  ,"schedule_sub_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_sub_messages.id')
->whereIn("schedule.id",$sid)
    ->where("schedule_sub_messages.attachment","<>", "NULL")
    ->where(function($q) {
     $q->where("schedule_sub_messages.attachment","like","%.png%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpg%");
  });

}
        $query = $query->union($process_file)->union($zone_file)
        ->union($schedule_attachment)
        ->union($schedule_files)
        ->union($schedule_subattachment);
// hàm phân trang 
    $file = $query->paginate(24);
    $menu = $query->paginate(24);


    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


    return view('warehouse.img-list',compact('file',"tags","menu"));

  }

public function ImageListInput(Request $request){

    // dd("????");

      //    if(!$this->checkContributeMap()){
      //   return redirect("/");
      // }
    // dd($request->type);


    $uid = Auth::user()->id;
    $rids = DB::table("user_role")->where("user_id",$uid)->pluck("role_id")->toArray();

    $dids = DB::table("roles")->whereIn("id",$rids)->distinct()->pluck("department_id")->toArray();


    if($request->type == 2){
      Cookie::queue('find', $request->tags, 10);
      return redirect()->to("/warehouse/data");

    }

    $tagArr = [];
    $raw = "abcljklrdtfq";
    $tags = explode(",", $request->tags);
    if (count($tags) < 2){
    $raw  =  $request->tags;
    $tags = explode(" ", $request->tags);
    }

    foreach ($tags as $tag) {
       $count = DB::table("tags")->where("name",$raw)->count();
       if($count > 0){

        $find = DB::table("tags")->where("name",$raw)->pluck('id')->toArray();
        // print_r($find);
        // echo "<br>";
        foreach ($find as $word) {  
          if (!in_array($word, $tagArr)){
            $tagArr[] = $word;
          }
        }
       }
    }

    foreach ($tags as $tag) {
       $tagStr = "%".$tag."%";
       // dd($tag)
       $count = DB::table("tags")->where("name","like",$tagStr)->count();
       if($count > 0){

        $find = DB::table("tags")->where("name","like",$tagStr)->pluck('id')->toArray();
        // print_r($find);
        // echo "<br>";
        foreach ($find as $word) {  
if (!in_array($word, $tagArr)){
            $tagArr[] = $word;
          }
        }
       }
    }

    // echo "????";
    // print_r($tagArr);

    // // dd($tags);

    // print_r($tagArr);
    $file = "";


if($this->checkLead()){
    $array = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize","tags.id as tags"

    )

    ->whereIn("tags.id",$tagArr)
    ->where(function($q) {
          $q->where("contribute_file.url","like","%.png%")
    ->orWhere("contribute_file.url","like","%.jpeg%")
    ->orWhere("contribute_file.url","like","%.jpg%");
  })

    ->orWhere("contribute_file.name","like","%".$request->tags."%")
    ->distinct()->pluck('contribute_file.id')->toArray();

 }else{
    // dd($dids)
  //       $array = DB::table("contribute_file")
  //   ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
  //   ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
  //   ->leftJoin('contribute_file_user', 'contribute_file_user.file_id', '=', 'contribute_file.id')
  //   ->leftJoin('contribute_file_department', 'contribute_file_department.file_id', '=', 'contribute_file.id')
  //   ->select("contribute_file.name as name"
  //     ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
  //     "contribute_file.url_resize as url_resize","tags.id as tags"

  //   )
  //   ->where(function ($q) use ($dids,$uid) {
  //     $q
  //   ->orWhere("contribute_file.open",1)
  //   ->orWhere("contribute_file_department.department_id",$dids)
  //   ->orWhere("contribute_file_user.user_id",$uid);
  // })

  //   ->where(function ($q) use ($tagArr) {
  //     $q->whereIn('tags.id',$tagArr);
  // })

  //   ->where(function($q) {
  //   $q->where("contribute_file.url","like","%.png%")
  //   ->orWhere("contribute_file.url","like","%.jpeg%")
  //   ->orWhere("contribute_file.url","like","%.jpg%");
  // })

    // ->orWhere("contribute_file.name","like","%".$request->tags."%")
    // ->distinct()->pluck('contribute_file.id')->toArray();
    // dd($array);
    $array = [];
 }

  $query = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')  ->leftJoin('contribute_file_user', 'contribute_file_user.file_id', '=', 'contribute_file.id')
    ->leftJoin('contribute_file_department', 'contribute_file_department.file_id', '=', 'contribute_file.id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
     ->whereIn("contribute_file.id",$array);
// dd($query->get());
if($this->checkContributeMap()){
$process_id =  DB::table("building_history")
->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
->leftJoin('building_history_tag', 'building_history_tag.history_id', '=', 'building_history.id')
->leftJoin('tags', 'building_history_tag.tag_id', '=', 'tags.id')
    
    ->whereIn("tags.id",$tagArr)
    ->orWhere("building_job.name","like","%".$request->tags."%")->distinct()->pluck('building_history.id')->toArray();
}else{
    $process_id  = [];
}
// $process_id[] = -1;

$process_file = DB::table("building_history_img")
->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
->leftJoin('users', 'users.id', '=', 'building_history.user_id')
->leftJoin('building_history_tag', 'building_history_tag.history_id', '=', 'building_history.id')
->leftJoin('tags', 'building_history_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","building_job.name as name",
"building_history.id as id","building_job.level as type","building_history_img.url as url"
  ,"building_history_img.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('building_history.id')->whereIn("building_history.id",$process_id);
            ;

if($this->checkContributeMap()){
$zone_id =  DB::table("history_zone")
->leftJoin('history_zone_tag', 'history_zone_tag.history_id', '=', 'history_zone.id')
->leftJoin('tags', 'history_zone_tag.tag_id', '=', 'tags.id')
    ->orWhere("history_zone.description","like","%".$request->tags."%")
    
    ->whereIn("tags.id",$tagArr)->distinct()->pluck('history_zone.id')->toArray();
}else{
    $zone_id  = [];
}
// dd($zone_id);
// $zone_id[] = -1;

$zone_file = DB::table("history_zone")
->leftJoin('users', 'users.id', '=', 'history_zone.user_id')
->leftJoin('history_zone_tag', 'history_zone_tag.history_id', '=', 'history_zone.id')
->leftJoin('tags', 'history_zone_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","history_zone.description as name",
"history_zone.id as id",DB::raw('-1 as type'),"history_zone.url as url"
  ,"history_zone.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('history_zone.id')
->whereIn("history_zone.id",$zone_id);




$sids_user = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();




$sids = DB::table("schedule_file")
    ->leftJoin('schedule_file_tag', 'schedule_file_tag.schedule_id', '=', 'schedule_file.id')
    ->leftJoin('tags', 'schedule_file_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
 ->groupBy('schedule_file.id')
    ->whereIn("tags.id",$tagArr)
    ->where(function($q) {
     $q->where("schedule_file.url","like","%.png%")
    ->orWhere("schedule_file.url","like","%.jpeg%")
    ->orWhere("schedule_file.url","like","%.jpg%");
  })
    ->orWhere("schedule_file.title","like","%".$request->tags."%")
    ->orWhere("schedule_file.url","like","%".$request->tags."%")
    ->orWhere("schedule.title","like","%".$request->tags."%")
    ->orWhere("schedule.content","like","%".$request->tags."%")
    ->distinct()->pluck('schedule_file.id')->toArray();


  $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule_file_tag', 'schedule_file_tag.schedule_id', '=', 'schedule_file.id')
    ->leftJoin('tags', 'schedule_file_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
->select("users.name as uname","schedule_file.title as name",
"schedule_file.id as id",DB::raw('-2 as type'),"schedule_file.url as url"
  ,"schedule_file.url as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_file.id')
    ->whereIn("schedule_file.id",$sids);

if(!$this->checkLead()){
 $schedule_files =  $schedule_files->whereIn("schedule.id",$sids_user);

}
 // dd($sids);


    $said = DB::table("schedule_messages")
    ->leftJoin('schedule_messages_tag', 'schedule_messages_tag.message_id', '=', 'schedule_messages.id')
    ->leftJoin('tags', 'schedule_messages_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
       ->whereIn("tags.id",$tagArr)
    ->where(function($q) {
     $q->where("schedule_messages.attachment","like","%.png%")
    ->orWhere("schedule_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_messages.attachment","like","%.jpg%");
  })
    ->orWhere("schedule_messages.body","like","%".$request->tags."%")
    ->orWhere("schedule_messages.attachment","like","%".$request->tags."%")
    ->orWhere("schedule.title","like","%".$request->tags."%")
    ->orWhere("schedule.content","like","%".$request->tags."%")
    ->distinct()->pluck('schedule_messages.id')->toArray();

  $schedule_attachment = DB::table("schedule_messages")
    ->leftJoin('schedule_messages_tag', 'schedule_messages_tag.message_id', '=', 'schedule_messages.id')
    ->leftJoin('tags', 'schedule_messages_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
->select("users.name as uname","schedule_messages.body as name",
"schedule_messages.id as id",DB::raw('-3 as type'),"schedule_messages.attachment as url"
  ,"schedule_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_messages.id')
    ->whereIn("schedule_messages.id",$said);

// dd( $schedule_attachment->get());
if(!$this->checkLead()){
 $schedule_attachment =  $schedule_attachment->whereIn("schedule.id",$sids_user);

}

    $sisids = DB::table("schedule_sub_messages")
    ->leftJoin('schedule_threads', 'schedule_threads.id', '=', 'schedule_sub_messages.messages_id')
    ->leftJoin('schedule_sub_messages_tag', 'schedule_sub_messages_tag.message_id', '=', 'schedule_sub_messages.id')
    ->leftJoin('tags', 'schedule_sub_messages_tag.tag_id', '=', 'tags.id')
      ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
    ->where(function($q) {
     $q->where("schedule_sub_messages.attachment","like","%.png%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpg%");
  })
    ->orWhere("schedule_sub_messages.body","like","%".$request->tags."%")
    ->orWhere("schedule_sub_messages.attachment","like","%".$request->tags."%")
    ->orWhere("schedule_threads.title","like","%".$request->tags."%")
    ->distinct()->pluck('schedule_sub_messages.id')->toArray();

  $schedule_subattachment = DB::table("schedule_sub_messages")
    ->leftJoin('schedule_threads', 'schedule_threads.id', '=', 'schedule_sub_messages.messages_id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_threads.schedule_id')
    ->leftJoin('schedule_sub_messages_tag', 'schedule_sub_messages_tag.message_id', '=', 'schedule_sub_messages.id')
    ->leftJoin('tags', 'schedule_sub_messages_tag.tag_id', '=', 'tags.id')
      ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
->select("users.name as uname","schedule_sub_messages.body as name",
"schedule_sub_messages.id as id",DB::raw('-4 as type'),"schedule_sub_messages.attachment as url"
  ,"schedule_sub_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_sub_messages.id')
    ->whereIn("schedule_sub_messages.id",$sisids);

// dd( $schedule_attachment->get());
if(!$this->checkLead()){
 $schedule_subattachment =  $schedule_subattachment->whereIn("schedule.id",$sids_user);

}

    if ($file == ""){
        if($query->count()> 0 ){
          $file = $query;
      }
         if($process_file->count()> 0 ){
          if ($file == ""){
$file = $process_file;
          }else{
      $file = $query->union($process_file);
        }
    }
      if($zone_file->count()> 0 ){
          if ($file == ""){
          $file = $zone_file;
                    }else{
                $file = $query->union($zone_file);
              }
      }

      if($schedule_files->count()> 0 ){
          if ($file == ""){
          $file = $schedule_files;
                    }else{
                $file = $query->union($schedule_files);
              }
      }
      
     if($schedule_attachment->count()> 0 ){
              if ($file == ""){
              $file = $schedule_attachment;
                        }else{
                    $file = $query->union($schedule_attachment);
                  }
          }
      

       if($schedule_subattachment->count()> 0 ){
          if ($file == ""){
          $file = $schedule_subattachment;
                    }else{
                $file = $query->union($schedule_subattachment);
              }
      }
      

    }else{
  if($query->count()> 0 ){
      $file = $file->union($query);
    }

         if($process_file->count()> 0 ){
      $file = $file->union($process_file);
    }
      if($zone_file->count()> 0 ){
      $file = $file->union($zone_file);
    };

       if($schedule_files->count()> 0 ){
      $file = $file->union($schedule_files);
    };

    

    
    }
    if($file ==""){
        // dd("hower");
   if($this->checkLead()){
    $query = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
    ->where("contribute_file.url","like","%.png%")
    ->orWhere("contribute_file.url","like","%.jpeg%")
    ->orWhere("contribute_file.url","like","%.jpg%");
}else{
      $fids = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->leftJoin('contribute_file_user', 'contribute_file_user.file_id', '=', 'contribute_file.id')
    ->leftJoin('contribute_file_department', 'contribute_file_department.file_id', '=', 'contribute_file.id')

    ->whereIn("contribute_file_department.department_id",$dids)
    ->orWhere("contribute_file_user.user_id",$uid)
    ->orWhere("contribute_file.open",1)
    ->distinct()->pluck("contribute_file.id")->toArray();

$query = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
    ->whereIn("contribute_file.id",$fids)
    ->where(function($q) {
     $q->where("contribute_file.url","like","%.png%")
    ->orWhere("contribute_file.url","like","%.jpeg%")
    ->orWhere("contribute_file.url","like","%.jpg%");
  });


}


if($this->checkContributeMap()){
$process_file = DB::table("building_history_img")
->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
->leftJoin('users', 'users.id', '=', 'building_history.user_id')
->leftJoin('building_history_tag', 'building_history_tag.history_id', '=', 'building_history.id')
->leftJoin('tags', 'building_history_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","building_job.name as name",
"building_history.id as id","building_job.level as type","building_history_img.url as url"
  ,"building_history_img.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('building_history.id')
    ->where("building_history_img.url","like","%.png%")
    ->orWhere("building_history_img.url","like","%.jpeg%")
    ->orWhere("building_history_img.url","like","%.jpg%");



$zone_file = DB::table("history_zone")
->leftJoin('users', 'users.id', '=', 'history_zone.user_id')
->leftJoin('history_zone_tag', 'history_zone_tag.history_id', '=', 'history_zone.id')
->leftJoin('tags', 'history_zone_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","history_zone.description as name",
"history_zone.id as id",DB::raw('-1 as type'),"history_zone.url as url"
  ,"history_zone.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('history_zone.id')
    ->where("history_zone.url","like","%.png%")
    ->orWhere("history_zone.url","like","%.jpeg%")
    ->orWhere("history_zone.url","like","%.jpg%");
    }else{
$process_file = DB::table("building_history_img")
->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
->leftJoin('users', 'users.id', '=', 'building_history.user_id')
->leftJoin('building_history_tag', 'building_history_tag.history_id', '=', 'building_history.id')
->leftJoin('tags', 'building_history_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","building_job.name as name",
"building_history.id as id","building_job.level as type","building_history_img.url as url"
  ,"building_history_img.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('building_history.id')
    ->where("building_history.id",-1);



$zone_file = DB::table("history_zone")
->leftJoin('users', 'users.id', '=', 'history_zone.user_id')
->leftJoin('history_zone_tag', 'history_zone_tag.history_id', '=', 'history_zone.id')
->leftJoin('tags', 'history_zone_tag.tag_id', '=', 'tags.id')
->select("users.name as uname","history_zone.description as name",
"history_zone.id as id",DB::raw('-1 as type'),"history_zone.url as url"
  ,"history_zone.url_small as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('history_zone.id')
    ->where("history_zone.id",-1);

    }

if($this->checkLead()){
   $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule_file_tag', 'schedule_file_tag.schedule_id', '=', 'schedule_file.id')
    ->leftJoin('tags', 'schedule_file_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
      ->select("users.name as uname","schedule_file.title as name",
"schedule_file.id as id",DB::raw('-1 as type'),"schedule_file.url as url"
  ,"schedule_file.url as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_file.id')
    ->where("schedule_file.url","like","%.png%")
    ->orWhere("schedule_file.url","like","%.jpeg%")
    ->orWhere("schedule_file.url","like","%.jpg%");


    $schedule_attachment = DB::table("schedule_messages")
    ->leftJoin('schedule_messages_tag', 'schedule_messages_tag.message_id', '=', 'schedule_messages.id')
    ->leftJoin('tags', 'schedule_messages_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
      ->select("users.name as uname","schedule_messages.body as name",
"schedule_messages.id as id",DB::raw('-2 as type'),"schedule_messages.attachment as url"
  ,"schedule_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_messages.id')
    ->where("schedule_messages.attachment","<>", "NULL")
    ->where("schedule_messages.attachment","like","%.png%")
    ->orWhere("schedule_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_messages.attachment","like","%.jpg%");

    $schedule_subattachment = DB::table("schedule_sub_messages")
    ->leftJoin('schedule_sub_messages_tag', 'schedule_sub_messages_tag.message_id', '=', 'schedule_sub_messages.id')
    ->leftJoin('tags', 'schedule_sub_messages_tag.tag_id', '=', 'tags.id')
      ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
      ->select("users.name as uname","schedule_sub_messages.body as name",
"schedule_sub_messages.id as id",DB::raw('-2 as type'),"schedule_sub_messages.attachment as url"
  ,"schedule_sub_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_sub_messages.id')
    ->where("schedule_sub_messages.attachment","<>", "NULL")
    ->where("schedule_sub_messages.attachment","like","%.png%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpg%");
}else{
    $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();

$schedules = DB::table("schedule")->whereIn("id",$sid)->get();

   $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule_file_tag', 'schedule_file_tag.schedule_id', '=', 'schedule_file.id')
    ->leftJoin('tags', 'schedule_file_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
      ->select("users.name as uname","schedule_file.title as name",
"schedule_file.id as id",DB::raw('-1 as type'),"schedule_file.url as url"
  ,"schedule_file.url as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_file.id')
->whereIn("schedule.id",$sid)
->where(function($q) {
     $q->where("schedule_file.url","like","%.png%")
    ->orWhere("schedule_file.url","like","%.jpeg%")
    ->orWhere("schedule_file.url","like","%.jpg%");
  });

    $schedule_attachment = DB::table("schedule_messages")
    ->leftJoin('schedule_messages_tag', 'schedule_messages_tag.message_id', '=', 'schedule_messages.id')
    ->leftJoin('tags', 'schedule_messages_tag.tag_id', '=', 'tags.id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
      ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
      ->select("users.name as uname","schedule_messages.body as name",
"schedule_messages.id as id",DB::raw('-2 as type'),"schedule_messages.attachment as url"
  ,"schedule_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_messages.id')
->whereIn("schedule.id",$sid)
    ->where("schedule_messages.attachment","<>", "NULL")
    ->where(function($q) {
     $q->where("schedule_messages.attachment","like","%.png%")
    ->orWhere("schedule_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_messages.attachment","like","%.jpg%");
  });

    $schedule_subattachment = DB::table("schedule_sub_messages")
    ->leftJoin('schedule_threads', 'schedule_threads.id', '=', 'schedule_sub_messages.messages_id')
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_threads.schedule_id')
    ->leftJoin('schedule_sub_messages_tag', 'schedule_sub_messages_tag.message_id', '=', 'schedule_sub_messages.id')
    ->leftJoin('tags', 'schedule_sub_messages_tag.tag_id', '=', 'tags.id')
      ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
      ->select("users.name as uname","schedule_sub_messages.body as name",
"schedule_sub_messages.id as id",DB::raw('-2 as type'),"schedule_sub_messages.attachment as url"
  ,"schedule_sub_messages.attachment as url_resize"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
 ->groupBy('schedule_sub_messages.id')
->whereIn("schedule.id",$sid)
    ->where("schedule_sub_messages.attachment","<>", "NULL")
    ->where(function($q) {
     $q->where("schedule_sub_messages.attachment","like","%.png%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpeg%")
    ->orWhere("schedule_sub_messages.attachment","like","%.jpg%");
  });

}
 // dd($zone_file->get() );
      $file = $query;
      if($process_file->count()> 0 ){
      $file = $file->union($process_file);
    }
      if($zone_file->count()> 0 ){
      $file = $file->union($zone_file);
    }

     
       if($schedule_files->count()> 0 ){
      $file = $file->union($schedule_files);
    }

       if($schedule_attachment->count()> 0 ){
      $file = $file->union($schedule_attachment);
    }

       if($schedule_subattachment->count()> 0 ){
      $file = $file->union($schedule_subattachment);
    }



    }

    $final = $file->paginate(24);
    $menu = $file->paginate(24);
    $file = $final;
    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);

    $find = $request->tags;


    return view('warehouse.img-list',compact('menu','file',"tags","find"));

  }

      public function data($id){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }


    $project = DB::table("projects")
    ->where("id",$id)->first();
    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
    ->where("project_id",$id)->get();

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


    return view('warehouse.file',compact('project','file','id',"tags"));

  }

   public function dataImg($id){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }


    $project = DB::table("projects")
    ->where("id",$id)->first();
    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize"
      ,"contribute_file.type as type"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.id')
    ->where("contribute_file.url","like","%.png%")
    ->orWhere("contribute_file.url","like","%.jpeg%")
    ->orWhere("contribute_file.url","like","%.jpg%")
    ->where("project_id",$id)
    ->get();

    // dd($file);

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


    return view('warehouse.file-img',compact('project','file','id',"tags"));

  }


 function editPrivateFile(Request $request){
    $title = $request->title;
    $tagArr = [];

    $tags = explode(",", $request->tags);

    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("tags")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }foreach ($tagArr as $tag) {
      echo $tag."<br>";
    }
    // dd($tagArr);

    // dd($request->all());
  $i = DB::table("contribute_file")->where("project_id",$request->id)->count();
  // try{

  // dd($request->file);
  $files = ($request->file);
  // dd($request->file);
foreach ($files as $file) {

  // dd($request->file);
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }

      if(strlen($title) < 2){
        $title =  $file_name;
      }

      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);
      // dd($url);

      $temp = explode("/", $url);
      $temp = end($temp);
 try{
      $img = Image::make($file)
      ->resize(300, 300)->stream();



      $path = Storage::disk('public')->put($temp, $img);
        }catch (\Exception $e) { 
          $path = 1;
               }

       // dd("123");
      // $img = Image::make($file)
      // ->resize(300, 300)->stream();



      // $path = Storage::disk('public')->put($temp, $img);


      $i = $i +1;

       $fid = DB::table("contribute_file")->insertGetId([
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
            'type' => 0,
            'user_id' => Auth()->user()->id,
            'name'=>$title,
            'project_id'=>0,
            'open'=>0
        ]);
       // dd($fid);
       foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $fid,
            'tag_id' => $tag

        ]);
       }
}
 
 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}

 function addFile(Request $request){
  $root_file = DB::table("contribute_file")->where("id",$request->root_id)->first();

  $files = ($request->file);
foreach ($files as $file) {

  // dd($request->file);
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }



      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);
      // dd($url);

      $temp = explode("/", $url);
      $temp = end($temp);
 try{
      $img = Image::make($file)
      ->resize(300, 300)->stream();



      $path = Storage::disk('public')->put($temp, $img);
        }catch (\Exception $e) { 
          $path = 1;
               }


       $fid = DB::table("contribute_file")->insertGetId([
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
            'type' => 0,
            'user_id' => Auth()->user()->id,
            'name'=>$root_file->name,
            'origin_name'=>$file_name,
            'project_id'=>0,
            'open'=>$root_file->open
        ]);
       // dd($fid);

       
      }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}

 function editFile(Request $request){
    $title = $request->title;
    $tagArr = [];

    $tags = explode(",", $request->tags);

    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("tags")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }foreach ($tagArr as $tag) {
      echo $tag."<br>";
    }
    // dd($tagArr);

    // dd($request->all());
  $i = DB::table("contribute_file")->where("project_id",$request->id)->count();
  // try{

  // dd($request->file);
  $files = ($request->file);
  // dd($request->file);
foreach ($files as $file) {

  // dd($request->file);
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }

      if(strlen($title) < 2){
        $title =  $file_name;
      }

      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);
      // dd($url);

      $temp = explode("/", $url);
      $temp = end($temp);
 try{
      $img = Image::make($file)
      ->resize(300, 300)->stream();



      $path = Storage::disk('public')->put($temp, $img);
        }catch (\Exception $e) { 
          $path = 1;
               }

       // dd("123");
      // $img = Image::make($file)
      // ->resize(300, 300)->stream();



      // $path = Storage::disk('public')->put($temp, $img);


      $i = $i +1;

       $fid = DB::table("contribute_file")->insertGetId([
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
            'type' => 0,
            'user_id' => Auth()->user()->id,
            'name'=>$title,
            'origin_name'=>$file_name,
            'project_id'=>0,
            'open'=>$request->open
        ]);
       // dd($fid);
       foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $fid,
            'tag_id' => $tag

        ]);
       }

      
 $sid_array = $request->sid;

    // dd($sid_array);
    if($sid_array != null){
      foreach ($sid_array as $sid) {
        DB::table('contribute_file_user')->insert([
          'file_id' => $fid,
          'user_id' => $sid
      ]);

    
            
        }
    }

      
 $did_array = $request->did;

 if($did_array != null){
   foreach ($did_array as $did) {
    // dd($did);
          DB::table('contribute_file_department')->insert([
          'file_id' => $fid,
          'department_id' => $did
      ]);
}
        }
      }

//     }
// catch (\Exception $e) { 
//     return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
//                }

      $lead = $this->getLead();

       foreach ($lead as $lid) {
          DB::table('warehouse_noti')->insert([
          'fid' => $fid,
          'user_id' => $lid
      ]);
      }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}
  function editFileName(Request $request){

     $tagArr = [];

    $tags = explode(",", $request->tags);
    // dd($tags);
    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("tags")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }foreach ($tagArr as $tag) {
      echo $tag."<br>";
    }

 $name = DB::table('contribute_file')
              ->where('id', $request->id)->first()->name;
     DB::table('contribute_file')
              ->where('name', $name)
              ->update(['name' => $request->title,
            'type' => $request->type,
            'open'=>$request->open]);
    // dd($request->id);


               if($request->file != null){
                      $file =$request->file[0];
                       $file_name = $file->getClientOriginalName();
                      if(strlen($file_name) < 2){
                    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

                      }
                      // dd($title);
                      $path = $file->store('system');

                      $url = Storage::url($path);

                    DB::table('contribute_file')
                                ->where('id', $request->id)
                              ->update(['name' => $request->title,'url' => $url]);

                        
               }





       $fname =  DB::table('contribute_file')->where("id",$request->id)->first()->name;
       $fids = DB::table('contribute_file')->where("name",$fname)->pluck("id")->toArray();



       DB::table('contribute_file_tags')
              ->whereIn('file_id', $fids)->delete();


              foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
       }
      


        DB::table('contribute_file_user')->whereIn("file_id", $fids)->delete();
 $sid_array = $request->sid;
 if($sid_array != null){
      foreach ($sid_array as $sid) {
   foreach ($fids as $myid) {
        DB::table('contribute_file_user')->insert([
          'file_id' => $myid,
          'user_id' => $sid
      ]);

    }
            
        }
    }

      
 $did_array = $request->did;

        DB::table('contribute_file_department')->whereIn("file_id", $fids)->delete();
 if($did_array != null){
   foreach ($did_array as $did) {
   foreach ($fids as $myid) {
    // dd($did);
          DB::table('contribute_file_department')->insert([
          'file_id' => $myid,
          'department_id' => $did
      ]);
      }
}
        }
      



 return Redirect()->back()->with('notification',' Đã sửa tệp tin thành công !');

}
    function editTag(Request $request){
// dd($request->id);
     $tagArr = [];

    $tags = explode(",", $request->tags);

    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr[] =  DB::table("tags")->where("name",$tag)->first()->id;
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr[] = $id;
      }
    }foreach ($tagArr as $tag) {
      echo $tag."<br>";
    }

 
      if($request->type > -2){
       DB::table('contribute_file_tags')
              ->where('file_id', $request->id)->delete();
              foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
       }
     }elseif($request->type == -2){
       DB::table('schedule_file_tag')
              ->where('schedule_id', $request->id)->delete();
              foreach ($tagArr as $tag) {
         # code...
       DB::table("schedule_file_tag")->insert([
            'schedule_id' => $request->id,
            'tag_id' => $tag

        ]);
       }
       }elseif($request->type == -3){
       DB::table('schedule_messages_tag')
              ->where('message_id', $request->id)->delete();
              foreach ($tagArr as $tag) {
         # code...
       DB::table("schedule_messages_tag")->insert([
            'message_id' => $request->id,
            'tag_id' => $tag

        ]);
       }
       }elseif($request->type == -4){
       DB::table('schedule_sub_messages_tag')
              ->where('message_id', $request->id)->delete();
              foreach ($tagArr as $tag) {
         # code...
       DB::table("schedule_sub_messages_tag")->insert([
            'message_id' => $request->id,
            'tag_id' => $tag

        ]);
       }

      }



 return Redirect()->back()->with('notification',' Đã sửa tệp tin thành công !');

}
     


function DeleteFile($id){
  if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}

         $name = DB::table("contribute_file")->where("id",$id)->first()->name;
        // dd("tight");
       DB::table("contribute_file")->where("name",$name)->delete();
       DB::table('contribute_file_tags')
              ->where('file_id', $id)->delete();

 return Redirect()->back()->with('notification',' Đã xóa tệp tin thành công !');

}

function DeleteFilebyId($id){
  if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}

        // dd("tight");
       DB::table("contribute_file")->where("id",$id)->delete();
       DB::table('contribute_file_tags')
              ->where('file_id', $id)->delete();

 return Redirect()->back()->with('notification',' Đã xóa tệp tin thành công !');

}



public function content(){
  $notes = DB::table("building_history")
    ->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
     ->select("building_job.id as id","building_job.name as name","building_history.machine as machine",
      "building_history.lead as lead","building_history.worker as worker","building_history.description as description",
      "building_history.input as input","building_history.acceptance as acceptance","building_history.id as hid",
   "building_history.created_at as created_at")

  ->get();

  $jobs = DB::table("jobs")
    ->leftJoin('department', 'jobs.department_id', '=', 'department.id')
    ->leftJoin('job_comments', 'jobs.department_id', '=', 'job_comments.job_id')
     ->select("jobs.id as id","jobs.name as name","jobs.des as des","department.name as dname",
   "jobs.created_at as created_at",
    DB::raw("group_concat(job_comments.content SEPARATOR '<br>') as content")
            )
  ->groupBy("jobs.id")
  ->get();
  
  // dd($jobs);

    return view('warehouse.content',compact("notes","jobs"));

}

    function MessSearch(){
        $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();
        $schedule_messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
         ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time"
                       ,"users.name as name","users.avatar as avatar","schedule.title as title","schedule.id as sid")
                    ->whereIn("schedule_messages.schedule_id", $sid)
                ->orderBy('schedule_messages.created_at', 'asc')->get();
            ;
            // dd($schedule_messages);

        $tid = DB::table("schedule_thread_user")
            ->where("user_id",Auth()->user()->id)->pluck('thread_id')->toArray();

        $thread_messages = DB::table("schedule_sub_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
         ->leftJoin('schedule_threads', 'users.id', '=', 'schedule_sub_messages.messages_id')
         ->leftJoin('schedule', 'schedule.id', '=', 'schedule_threads.schedule_id')
                    ->select("schedule_sub_messages.id as id","schedule_sub_messages.user_id as user_id",
                            "schedule_sub_messages.body as body",
                        "schedule_sub_messages.attachment as attachment","schedule_sub_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar"
                       ,"schedule.title as title","schedule.id as sid")
                    ->whereIn("schedule_sub_messages.messages_id", $tid)
                    ->orWhere("open",1)
                ->orderBy('schedule_sub_messages.created_at', 'asc')->get();
            ;


        $zone_mess = [];
        if($this->checkMap()){
            $zone_mess = DB::table("zone_messages")  
            ->leftJoin('users', 'users.id', '=', 'zone_messages.user_id')
            ->leftJoin('zone', 'zone.id', '=', 'zone_messages.zone_id')
            ->leftJoin('zone_process', 'zone_process.zone_id', '=', 'zone.id')
            ->select("zone_messages.id as id","zone_messages.user_id as user_id",
                    "zone_messages.body as body",
                "zone_messages.attachment as attachment","zone_messages.created_at as time"
              ,"users.name as name","users.avatar as avatar",
                "zone.name as zname","zone_process.id as zid")
        ->orderBy('zone_messages.created_at', 'asc')->get();
            ;
        }

         return view('warehouse.mess',compact("schedule_messages","thread_messages","zone_mess"));

    }


        public function jsonDetail($data){   

    $uid = Auth::user()->id;
    $rids = DB::table("user_role")->where("user_id",$uid)->pluck("role_id")->toArray();

    $dids = DB::table("roles")->whereIn("id",$rids)->pluck("department_id")->toArray();

if($this->checkLead()){
     DB::table("warehouse_noti")->where("seen",0)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
  }


if($this->checkLead()){
    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )


            ->groupBy('contribute_file.name')->get();

  }
else{
  $fids = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->leftJoin('contribute_file_user', 'contribute_file_user.file_id', '=', 'contribute_file.id')
    ->leftJoin('contribute_file_department', 'contribute_file_department.file_id', '=', 'contribute_file.id')

    ->whereIn("contribute_file_department.department_id",$dids)
    ->orWhere("contribute_file_user.user_id",$uid)
    ->orWhere("contribute_file.open",1)
    ->distinct()->pluck("contribute_file.id")->toArray();

 $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
      ,"contribute_file.open as open"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )
    ->whereIn("legal_process.id",$fids)
    ->leftJoin('legal_process_file', 'legal_process_file.id', '=', 'legal_process_file.file_id')
            ->groupBy('legal_process_file.name')->get();

}

if($this->checkHuman()){


 $file2 = DB::table("legal_process")
    ->leftJoin('legal_process_file', 'legal_process.id', '=', 'legal_process_file.lp_id')
    ->select("legal_process.title as name","legal_process_file.title as fname","legal_process_file.id as id", "legal_process_file.url as url","legal_process_file.created_at as created_at")
    ->get();


// dd($file2);  
 $cv = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->groupBy('files.id')->get();
}else{
  $file2  = [];
  $cv = [];
}



if($this->checkLead()){
    $schedules = DB::table("schedule")->get();
     $schedule_files = DB::table("schedule_file")
    ->leftJoin('schedule', 'schedule.id', '=', 'schedule_file.schedule_id')
    ->leftJoin('users', 'users.id', '=', 'schedule_file.user_id')
     ->select("schedule_file.id as id",
        "schedule_file.user_id as user_id",
        "schedule.id as sid",
        "schedule.title as stitle",
                "schedule_file.title as title",
                "schedule_file.type as type",
                "schedule_file.url as url",
                "schedule_file.created_at as time",
            "users.name as uname")
->get();


}else{
$sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();

$schedules = DB::table("schedule")->whereIn("id",$sid)->get();
}
    // dd($job_files);


if($this->checkContributeMap()){
    $zone_history = DB::table("history_zone")
    ->leftJoin('zone', 'zone.id', '=', 'history_zone.zone_id')
     ->select("history_zone.id as id","zone.name as name","history_zone.description as description","history_zone.url as url",
   "history_zone.created_at as created_at")
    ->get();


    $build_history = DB::table("building_history_img")
    ->leftJoin('building_history', 'building_history.id', '=', 'building_history_img.history_id')
    ->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
     ->select("building_history_img.id as id","building_job.name as name","building_history_img.url as url",
   "building_history_img.created_at as created_at")
    ->get();
}else{
  $zone_history  = [];
  $build_history = [];
}

 $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();
        $schedule_messages = DB::table("schedule_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
         ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
                    ->select("schedule_messages.id as id","schedule_messages.user_id as user_id",
                            "schedule_messages.body as body",
                        "schedule_messages.attachment as attachment","schedule_messages.created_at as time"
                       ,"users.name as name","users.avatar as avatar","schedule.title as title","schedule.id as sid")
                    ->whereIn("schedule_messages.schedule_id", $sid)
                ->orderBy('schedule_messages.created_at', 'asc')->get();
            ;
            // dd($schedule_messages);

        $tid = DB::table("schedule_thread_user")
            ->where("user_id",Auth()->user()->id)->pluck('thread_id')->toArray();

        $thread_messages = DB::table("schedule_sub_messages")
         ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
         ->leftJoin('schedule_threads', 'users.id', '=', 'schedule_sub_messages.messages_id')
         ->leftJoin('schedule', 'schedule.id', '=', 'schedule_threads.schedule_id')
                    ->select("schedule_sub_messages.id as id","schedule_sub_messages.user_id as user_id",
                            "schedule_sub_messages.body as body",
                        "schedule_sub_messages.attachment as attachment","schedule_sub_messages.created_at as time"
                      ,"users.name as name","users.avatar as avatar"
                       ,"schedule.title as title","schedule.id as sid")
                    ->whereIn("schedule_sub_messages.messages_id", $tid)
                    ->orWhere("open",1)
                ->orderBy('schedule_sub_messages.created_at', 'asc')->get();
            ;


        $zone_mess = [];
        if($this->checkMap()){
            $zone_mess = DB::table("zone_messages")  
            ->leftJoin('users', 'users.id', '=', 'zone_messages.user_id')
            ->leftJoin('zone', 'zone.id', '=', 'zone_messages.zone_id')
            ->leftJoin('zone_process', 'zone_process.zone_id', '=', 'zone.id')
            ->select("zone_messages.id as id","zone_messages.user_id as user_id",
                    "zone_messages.body as body",
                "zone_messages.attachment as attachment","zone_messages.created_at as time"
              ,"users.name as name","users.avatar as avatar",
                "zone.name as zname","zone_process.id as zid")
        ->orderBy('zone_messages.created_at', 'asc')->get();
            ;
        }


         $build_mess = [];
        if($this->checkMap()){
            $build_mess = DB::table("building_messages")  
            ->leftJoin('users', 'users.id', '=', 'building_messages.user_id')
            ->leftJoin('buildingg', 'buildingg.id', '=', 'building_messages.building_id')
            ->select("building_messages.id as id","building_messages.user_id as user_id",
                    "building_messages.body as body",
                "building_messages.attachment as attachment","building_messages.created_at as time"
              ,"users.name as name","users.avatar as avatar",
                "buildingg.title as btitle")
        ->orderBy('building_messages.created_at', 'asc')->get();
            ;
        }


    return view('warehouse.index',compact("build_history","cv","zone_history","schedules","file",
      "schedule_files","schedule_messages","thread_messages"
      ,"zone_mess","build_mess","file2"
    ));

  }


}