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
use App\Consumer2;
use App\Job;
use App\Jobmoniters;
use App\Staff;
use App\Accountant;
use App\Department;
use App\Event;
use App\Role;

use Intervention\Image\ImageManagerStatic as Image;


use Illuminate\Support\Str;
use Illuminate\Http\Request;

class HumanController extends Controller
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

  public function getConsumer(){
       if(!$this->checkLead()){
        return redirect("/");
      }

         $consumers = DB::table("consumer")
    ->leftJoin('consumer_grouptag', 'consumer_grouptag.consumer_id', '=', 'consumer.id')
    ->leftJoin('tag_group', 'consumer_grouptag.group_id', '=', 'tag_group.id')
    ->leftJoin('consumer_tags', 'consumer_tags.consumer_id', '=', 'consumer.id')
    ->leftJoin('tags', 'consumer_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'consumer.user_id')
    ->select("consumer.name as name"
      ,"consumer.id as id"
      ,"consumer.birth_date as birth_date","consumer.phone_number as phone_number"
      ,"consumer.identify_card as identify_card","consumer.iden_date as iden_date"
      ,"consumer.iden_location as iden_location","consumer.address as address"
      ,"consumer.email as email"
      ,"consumer.created_at as time"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
              ,DB::raw("group_concat(distinct consumer_grouptag.group_id SEPARATOR ', ') as group_tags")
              ,DB::raw("group_concat(distinct  tag_group.name SEPARATOR ', ') as group_tag_names")
    )
            ->groupBy('consumer.id')->get();

        
          $event_list = DB::table("consumer_alert")
    ->leftJoin('consumer_alert_tag', 'consumer_alert.id', '=', 'consumer_alert_tag.alert_id')
    ->leftJoin('tags', 'consumer_alert_tag.tag_id', '=', 'tags.id')
    ->select("consumer_alert.title as title"
      ,"consumer_alert.id as id","consumer_alert.content as content" ,"consumer_alert.created_at as time"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )
            ->groupBy('consumer_alert.id')->get();



    $tag_groups = DB::table("tag_group")->get();
     $tag_groups_arr = [];
    foreach($tag_groups as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(";",DB::table("tags")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
        $tag_groups_arr[$tag->id]=$data;
    }

    //   


        


            return view('map.consumer_list', compact('consumers','event_list',"tag_groups","tag_groups_arr"));
        
    }


  public function ConsumerAlert(){


    return view('consumer.alert');
   }


   public function createConsumerAlert(Request $request){

      // dd($request->cid);

      $cids = explode(",",$request->cid);
      // dd($cids);

      foreach($cids as $cid){
       DB::table("consumer_user_alert")->insert([
            'consumer_id' => $cid,
            'alert_id' => $request->fid

        ]);
      }

        return redirect("/consumer-list");
   }
   public function createAlert(Request $request){
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
      // echo $tag."<br>";
    }
 $fid = DB::table("consumer_alert")->insertGetId([
            'user_id' => Auth()->user()->id,
            'title'=>$request->title,
            'content'=>$request->content,
        ]);
   
       // dd($fid);
       foreach ($tagArr as $tag) {
         # code...
       DB::table("consumer_alert_tag")->insert([
            'alert_id' => $fid,
            'tag_id' => $tag

        ]);
       }

// dd($tagArr );
     $consumer_select_ids =  DB::table("consumer")
    ->leftJoin('consumer_tags', 'consumer_tags.consumer_id', '=', 'consumer.id')
    ->leftJoin('tags', 'consumer_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'consumer.user_id')
    ->whereIn("tags.id",$tagArr)
    ->select("consumer.id")->distinct()->pluck("consumer.id")->toArray();
    

    $consumers = DB::table("consumer")
    ->leftJoin('consumer_tags', 'consumer_tags.consumer_id', '=', 'consumer.id')
    ->leftJoin('tags', 'consumer_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'consumer.user_id')
    ->select("consumer.name as name"
      ,"consumer.id as id"
      ,"consumer.birth_date as birth_date","consumer.phone_number as phone_number"
      ,"consumer.identify_card as identify_card","consumer.iden_date as iden_date"
      ,"consumer.iden_location as iden_location","consumer.address as address"
      ,"consumer.email as email"
      ,"consumer.created_at as time"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )
            ->groupBy('consumer.id')
            ->whereIn("consumer.id",$consumer_select_ids)
            ->get();


    // dd($consumer_select);

            return view('consumer.confirm', compact('consumers',"fid"));

   }



    public function getSaleConsumerInfo($id){  
      
    $consumers = Consumer::where("id",$id)->first();
    $consumers2 = 1;
    if ($consumers->married == 2){
    $consumers2 = Consumer2::where("consumer_id",$id)->first();
    }
    return json_encode([  $consumers,  $consumers2]);
  }


public function getPersonalPage(){

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
    ->where("open",0)->where("user_id",Auth()->user()->id)

            ->groupBy('contribute_file.name')->get();

            // dd(Auth::user()->role_id);
               $department =  DB::table("users")
        ->leftJoin('user_department', 'user_department.user_id', '=', 'users.id')
        ->leftJoin('department', 'department.id', '=', 'user_department.department_id')
        ->select(DB::raw("group_concat(DISTINCT(department.name) SEPARATOR ', ') as dname"))
        ->groupBy("users.id")->where("users.id",Auth()->user()->id)->first()->dname;
            return view('personal.page', compact('department',"file"));
        
    }
    public function updatePersonal(request $req){
      $url = "";
      if ($req->file !== null){

      $file = $req->file;
      $file_name = $file->getClientOriginalName();
      $path = $file->store('system');

      $url = Storage::url($path);
      
    
      User::where('id', Auth::user()->id)->update([
            "avatar" => $url
        ]);

}

      User::where('id', Auth::user()->id)->update([
            'name' => $req->name,
            'phone' => $req->phone,
            'identify' => $req->identify
        ]);
      return Redirect()->back()->with('notification',' Đã thay đổi thông tin cã nhân');
  }

    public function getConsumerInfo($id){
       if(!$this->checkSaleMap()){
        return redirect("/");
      }
            // dd(Auth::user()->role_id);
               $infomation = DB::table("zone_process")
     ->leftJoin('zone', 'zone_process.zone_id', '=', 'zone.id')
     ->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
    ->select("zone_process.id as id","zone.name as name","zone.gap as gap", "zone.state as state")
    ->where("consumer.id","=",$id)->get();


    return json_encode($infomation);

        
    }
    public function consumerDelete($id){
        if(!$this->checkSaleMap()){
          return redirect("/");
        }

        Consumer::where("id",$id)->delete();
        return redirect()->back()->with("notification","Đã xóa khách hàng thành công");
    }
     public function getAdminJobs(){
       if(!$this->checkLead()){
        return redirect("/");
      }
        // if(Auth()->user()->admin_id > 1){
        //   return Redirect()->route("index");
        // }
$job_count = DB::table("jobs")->count();
              $job_check =  DB::table("jobs")
              ->select('jobs.status',
                DB::raw('count(*) as total')
            )
            ->groupBy('jobs.status')

            ->get();

            $job_users = DB::table("jobs")
            ->RightJoin('department', 'department.id', '=', 'jobs.department_id')
  ->select("department.id as id", "department.name as name",
                DB::raw('sum(CASE WHEN jobs.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN jobs.status = 1 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN jobs.status = 2 THEN 1 ELSE 0 END) as s2'),
                DB::raw('sum(CASE WHEN jobs.status = 3 THEN 1 ELSE 0 END) as s3'),    
                DB::raw('sum(CASE WHEN CURRENT_TIMESTAMP > jobs.end_date and jobs.status = 0 THEN 1 ELSE 0 END) as s4')
            )

          ->groupBy('department.id')
                ->orderBy('jobs.department_id', 'asc')

          ->get();

          // dd( $job_users);
            $job_all= DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('job_noti', 'job_noti.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('department', 'department.id', '=', 'jobs.department_id')
            ->select("jobs.id as id","jobs.name as name","jobs.des as des","jobs.status as status","department.name as dname","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.status",0)
            ->where("job_noti.user_id",Auth()->user()->id)->get();

            $job_success= DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('job_noti', 'job_noti.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('department', 'department.id', '=', 'jobs.department_id')
            ->select("jobs.id as id","jobs.name as name","jobs.des as des","jobs.status as status","department.name as dname","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("jobs.status",1)->get();

            // dd($job_success);
            $job_fail=  DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('job_noti', 'job_noti.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('department', 'department.id', '=', 'jobs.department_id')
            ->select("jobs.id as id","jobs.name as name","jobs.des as des","jobs.status as status","department.name as dname","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.status",2)
            ->where("job_noti.user_id",Auth()->user()->id)->get();
            $job_stop=  DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('job_noti', 'job_noti.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('department', 'department.id', '=', 'jobs.department_id')
            ->select("jobs.id as id","jobs.name as name","jobs.des as des","jobs.status as status","department.name as dname","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("jobs.status",3)->get();
            // print_r($jobs);
            $job_all_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("job_noti.seen","<",1)->where("jobs.status",0)->count();
            $job_success_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("job_noti.seen","<",1)->where("jobs.status",1)->count();
            $job_fail_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("job_noti.seen","<",1)->where("jobs.status",2)->count();
            $job_stop_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("job_noti.seen","<",1)->where("jobs.status",3)->count();
            $department =Department::get();


            return view('account.admin_job_list', compact('job_all','job_success','job_fail','job_stop','department',"job_count","job_check","job_users","job_all_count","job_success_count","job_fail_count","job_stop_count"));
        
    }
 public function getBarsAdminBk(){
           $level =  Role::where("id",Auth::user()->role_id)->first()->level;
       if($level >2){
        return redirect("/");
      }
          $bars_chart =  DB::table("jobs")
            ->RightJoin('department', 'department.id', '=', 'jobs.department_id')
              ->select("department.id",'department.name',
                DB::raw('sum(CASE WHEN jobs.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN jobs.end_date < CURRENT_DATE() and jobs.status = 0 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN jobs.status = 0 THEN DATEDIFF(end_date,start_date) ELSE 0 END) as d0'),
                DB::raw('sum(CASE WHEN jobs.end_date > CURRENT_DATE() and jobs.status = 0 THEN DATEDIFF(end_date, CURRENT_DATE()) ELSE 0 END) as d1')
           )
             ->groupBy("department.id")
            ->get();
            // dd($bars_chart);
            return $bars_chart;
    }
 public function getBarsAdmin(){
          $bars_chart = DB::table("schedule")
            ->RightJoin('schedule_department', 'schedule.id', '=', 'schedule_department.schedule_id')
            ->RightJoin('department', 'department.id', '=', 'schedule_department.department_id')
              ->select("department.id",'department.name',
                DB::raw('sum(CASE WHEN schedule.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN schedule.end_date < CURRENT_DATE() and schedule.status = 0 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN schedule.status = 0 THEN DATEDIFF(end_date,start_date) ELSE 0 END) as d0'),
                DB::raw('sum(CASE WHEN schedule.end_date > CURRENT_DATE() and schedule.status = 0 THEN DATEDIFF(end_date, CURRENT_DATE()) ELSE 0 END) as d1')
           )
             ->groupBy("department.id")
            ->get();
            // dd($bars_chart);
            return $bars_chart;
    }

    public function getBarsDept($did){
           $level =  Role::where("id",Auth::user()->role_id)->first()->level;
       if($level >2){
        return redirect("/");
      }

             $bars_chart =      DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->RightJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
  ->select("users.id as user_id","users.name as name","roles.name as rname",
              DB::raw('sum(CASE WHEN jobs.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN jobs.end_date < CURRENT_DATE() and jobs.status = 0 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN jobs.status = 0 THEN DATEDIFF(jobs.end_date,jobs.start_date) ELSE 0 END) as d0'),
                DB::raw('sum(CASE WHEN jobs.end_date > CURRENT_DATE() and jobs.status = 0 THEN DATEDIFF(jobs.end_date, CURRENT_DATE()) ELSE 0 END) as d1')
           )
             ->groupBy("users.id")
             ->where("roles.department_id",$did)
                ->where("users.status","<>",0)
            ->get();

            // dd($bars_chart);
            return $bars_chart;
    }

    public function getBarStaff($sid){
           $level =  Role::where("id",Auth::user()->role_id)->first()->level;
     if($level >2){
        return redirect("/");
      }
          $bars_chart =      DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
  ->select("users.id as user_id","roles.department_id as did"
              ,"users.name as name","users.avatar as avatar","roles.name as rname",
                DB::raw('sum(CASE WHEN jobs.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN jobs.status = 1 THEN 1 ELSE 0 END) as s1'),
               DB::raw("date_format(jobs.created_at, '%Y-%m') as time"),DB::raw("date_format(jobs.created_at, '%m/%Y') as time_display")
           )
             ->groupBy("time")
            ->where("job_users.user_id", $sid)
            ->get();

            return $bars_chart;
    }

    public function getDeptJobs($did){
       if(!$this->checkLead()){
        return redirect("/");
      }
      $level = 1;

      $dept = DB::table("department")->where("id",$did)->first();
     $job_count = DB::table("jobs") ->where("jobs.department_id", $did)->count();
              $job_check =  DB::table("jobs")
              ->select('jobs.status',
                DB::raw('count(*) as total')
            )
            ->groupBy('jobs.status')

            ->where("jobs.department_id", $did)
            ->get();

            $job_users = DB::table("jobs")
            ->LeftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->RightJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
  ->select("users.id as user_id","roles.department_id as did"
              ,"users.name as name","users.avatar as avatar","roles.name as rname",
                DB::raw('sum(CASE WHEN jobs.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN jobs.status = 1 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN jobs.status = 2 THEN 1 ELSE 0 END) as s2'),
                DB::raw('sum(CASE WHEN jobs.status = 3 THEN 1 ELSE 0 END) as s3'),
                DB::raw('sum(CASE WHEN CURRENT_TIMESTAMP > jobs.end_date and jobs.status = 0 THEN 1 ELSE 0 END) as s4')
            )



          ->groupBy('users.id')
                ->orderBy('roles.id', 'asc')
                ->where("users.status","<>",0)

          ->where("roles.department_id", $did)
          ->get();



            $job_all= DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('job_noti', 'job_noti.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(DISTINCT users.name SEPARATOR ', ') as names")
              ,DB::raw("group_concat(DISTINCT users.id SEPARATOR ', ') as sid"))
            // ->select(DB::raw("count(users.id)"))
            ->where("job_noti.user_id",Auth()->user()->id)
            ->groupBy('jobs.id',"job_noti.user_id")
            // ->groupBy('jobs.id')
            ->where("jobs.department_id", $did)

            ->where("jobs.status",0)->get();

      
            //  $job_all= DB::table("jobs")
            // ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            // ->leftJoin('job_noti', 'job_noti.job_id', '=', 'jobs.id')
            // ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            // ->leftJoin('department', 'department.id', '=', 'jobs.department_id')
            // ->select("jobs.id as id","jobs.name as name","jobs.des as des","jobs.status as status","department.name as dname","job_noti.seen as seen"
            //   ,"jobs.start_date as start_date","jobs.end_date as end_date"
            //   ,DB::raw("group_concat(users.name SEPARATOR ', ') as names")
            //   ,DB::raw("group_concat(users.id SEPARATOR ', ') as sid"))
            // // ->select(DB::raw("count(users.id)"))
            // ->groupBy('jobs.id')
            // ->where("jobs.status",0)
            // ->where("jobs.department_id", $did)
            // ->where("job_noti.user_id",Auth()->user()->id)->get();


// dd($job_all);
            $job_success= DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names")
              ,DB::raw("group_concat(users.id SEPARATOR ', ') as sid"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.department_id", $did)
            ->where("jobs.status",1);

            // $job_success_count = $job_success->where("job_noti.seen",0)->count();
            $job_success = $job_success->get();

            $job_fail=  DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names")
              ,DB::raw("group_concat(users.id SEPARATOR ', ') as sid"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.department_id", $did)->where("jobs.status",2);



            // $job_fail_count = $job_fail->where("job_noti.seen",0)->count();
            $job_fail = $job_fail->get();

            $job_stop=  DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names")
              ,DB::raw("group_concat(users.id SEPARATOR ', ') as sid"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.department_id", $did)->where("jobs.status",3);



            // $job_stop_count = $job_stop->where("job_noti.seen",0)->count();
            $job_stop = $job_stop->get();


            // $job_based = DB::table("jobs")
            // ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            // ->where("job_noti.user_id",Auth()->user()->id)
            // ->where("jobs.department_id", $did);

            $job_all_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("job_noti.seen","<",1)
            ->where("jobs.department_id", $did)->where("jobs.status",0)->count();
            $job_success_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("job_noti.seen","<",1)
            ->where("jobs.department_id", $did)->where("jobs.status",1)->count();
            $job_fail_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("job_noti.seen","<",1)
            ->where("jobs.department_id", $did)->where("jobs.status",2)->count();
            $job_stop_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("job_noti.seen","<",1)
            ->where("jobs.department_id", $did)->where("jobs.status",3)->count();

            return view('account.dept_jobs_list', compact('job_all','job_success','job_fail','job_stop','level',"job_count", "job_check","job_users","dept","did"
              ,"job_all_count","job_success_count","job_fail_count","job_stop_count"));


    }
    public function getJobs(){
            // dd(Auth::user()->role_id);
           $did = Role::where("id",Auth::user()->role_id)->first()->department_id;
           $level =  Role::where("id",Auth::user()->role_id)->first()->level;

           if($level < 3){

            $job_count = DB::table("jobs") ->where("jobs.department_id", $did)->count();
              $job_check =  DB::table("jobs")
              ->select('jobs.status',
                DB::raw('count(*) as total')
            )
            ->groupBy('jobs.status')

            ->where("jobs.department_id", $did)
            ->get();

            $job_users = DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->RightJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
  ->select("users.id as user_id","roles.department_id as did"
              ,"users.name as name","users.avatar as avatar",
                DB::raw('sum(CASE WHEN jobs.status = 0 THEN 1 ELSE 0 END) as s0'),
                DB::raw('sum(CASE WHEN jobs.status = 1 THEN 1 ELSE 0 END) as s1'),
                DB::raw('sum(CASE WHEN jobs.status = 2 THEN 1 ELSE 0 END) as s2'),
                DB::raw('sum(CASE WHEN jobs.status = 3 THEN 1 ELSE 0 END) as s3'),
                DB::raw('sum(CASE WHEN CURRENT_TIMESTAMP > jobs.end_date and jobs.status = 0 THEN 1 ELSE 0 END) as s4')
            )

          ->groupBy('users.id')
          ->where("roles.department_id", $did)
          ->get();


            $job_all= DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status","jobs.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names")
              ,DB::raw("group_concat(users.id SEPARATOR ', ') as sid"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.department_id", $did)->where("jobs.status",0)->get();



            $job_all_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.user_id",Auth()->user()->id)
            ->where("jobs.status",0)->count();

            $job_success= DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names")
              ,DB::raw("group_concat(users.id SEPARATOR ', ') as sid"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.department_id", $did)
            ->where("jobs.status",1)->get();
            $job_fail=  DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names")
              ,DB::raw("group_concat(users.id SEPARATOR ', ') as sid"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.department_id", $did)->where("jobs.status",2)->get();
            $job_stop=  DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names")
              ,DB::raw("group_concat(users.id SEPARATOR ', ') as sid"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.department_id", $did)->where("jobs.status",3)->get();
            // print_r($jobs);



           
            $job_all_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.seen","<",1)
            ->where("job_noti.user_id",Auth()->user()->id)->where("jobs.status",0)->count();
            $job_success_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.seen","<",1)
            ->where("job_noti.user_id",Auth()->user()->id)->where("jobs.status",1)->count();
            $job_fail_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.seen","<",1)
            ->where("job_noti.user_id",Auth()->user()->id)->where("jobs.status",2)->count();
            $job_stop_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.seen","<",1)
            ->where("job_noti.user_id",Auth()->user()->id)->where("jobs.status",3)->count();


            return view('account.user_jobs_list', compact('job_all','job_success','job_fail','job_stop','level',"job_count", "job_check","job_users","did","job_all_count","job_success_count","job_fail_count","job_stop_count"));

          }else{

             $job_all= DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,"users.name as names")
            // ->select(DB::raw("count(users.id)"))
            ->where("job_users.user_id", Auth()->user()->id)
            ->where("job_noti.user_id", Auth()->user()->id)->where("jobs.status",0)->get();



            $job_success= DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,"users.name as names")
            // ->select(DB::raw("count(users.id)"))
            ->where("job_users.user_id", Auth()->user()->id)
            ->where("job_noti.user_id", Auth()->user()->id)
            ->where("jobs.status",1)->get();


            $job_fail=  DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,"users.name as names")
            // ->select(DB::raw("count(users.id)"))
            ->where("job_users.user_id", Auth()->user()->id)
            ->where("job_noti.user_id", Auth()->user()->id)->where("jobs.status",2)->get();
            $job_stop=  DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status","job_noti.seen as seen"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,"users.name as names")
            // ->select(DB::raw("count(users.id)"))
            ->where("job_users.user_id", Auth()->user()->id)
            ->where("job_noti.user_id", Auth()->user()->id)->where("jobs.status",3)->get();
            // print_r($jobs);
          }   


            $job_all_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.seen","<",1)
            ->where("job_noti.user_id",Auth()->user()->id)->where("jobs.status",0)->count();
            $job_success_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.seen","<",1)
            ->where("job_noti.user_id",Auth()->user()->id)->where("jobs.status",1)->count();
            $job_fail_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.seen","<",1)
            ->where("job_noti.user_id",Auth()->user()->id)->where("jobs.status",2)->count();
            $job_stop_count = DB::table("jobs")
            ->leftJoin('job_noti', 'jobs.id', '=', 'job_noti.job_id')
            ->where("job_noti.seen","<",1)
            ->where("job_noti.user_id",Auth()->user()->id)->where("jobs.status",3)->count();

            // dd($job_based->count());
            // dd(Auth()->user()->id);

            return view('account.user_jobs_list', compact('job_all','job_success','job_fail','job_stop','level',"job_all_count","job_success_count","job_fail_count","job_stop_count"));
        
    }
 public function deleteJobTask($id){

  DB::table('job_task')->where("id",$id)->delete();

  DB::table('job_task_users')->where("task_id",$id)->delete();

 return Redirect()->back()->with('notification',' Đã cập nhật!');
}

public function getTaskUserList($id){
  $check1 = DB::table("job_task")
  ->leftJoin('job_task_users', 'job_task_users.task_id', '=', 'job_task.id')
 ->where("job_task.id",$id)->where('job_task_users.user_id',Auth::id())->count();

  if ($check1 < 1
  && !$this->checkLead()
  && !$this->checkLead()){
    return 0;
  }
  return DB::table("job_task_users")->where("task_id",$id)->pluck('user_id')->toArray();
}

 public function updateTaskFlag($id){
$jid = DB::table('job_task')->where("id",$id)->first()->job_id;
$count1   = DB::table('jobs')->where("id",$jid)->where("user_id",Auth()->user()->id)->count();
 if($count1 > 0){
  DB::table('job_task')->where("id",$id)->update(["flag"=>2]);
 }else{

$count   = DB::table('job_task_users')->where("task_id",$id)->where("user_id",Auth()->user()->id)->count();
if($count > 0){
  DB::table('job_task')->where("id",$id)->update(["flag"=>1]);
 }else{

 return Redirect()->back()->with('warning',' Tài khoản không có quyền cập nhật!');
 }
}

$lead = $this->getLead();

       foreach ($lead as $lid) {
           DB::table('job_noti')->where( 'job_id',$jid)->where('user_id',$lid)->update([
          'seen' => 0
      ]);
      }
$sid = DB::table('job_users')->where("job_id",$jid)->pluck('user_id')->toArray();
foreach($sid as $sid){
      DB::table('job_noti')->where( 'job_id',$jid)->where('user_id',$sid)->update([
          'seen' => 0
      ]);
}

 return Redirect()->back()->with('notification',' Đã cập nhật!');
}

 public function editTask(Request $request){
       if(!$this->checkLead()){
        return redirect("/");
      }
      $task_id = DB::table('job_task')->where("id",$request->id)->update([
          'content' => $request->des,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date
      ]);
    if ($request->file !== null){
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
      
      $temp = explode("/", $url);
      $temp = end($temp);
 try{
      $img = Image::make($file)
      ->resize(300, 300)->stream();



      $path = Storage::disk('public')->put($temp, $img);
        }catch (\Exception $e) { 
          $path = 1;
               }
               
      DB::table('job_task_imgs')->insert([
            'name'=>$file_name,
            'task_id' => $request->id,
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
        ]);
}
}


if ($request->type_id == 0){


      $sid_array = $request->sid;
  DB::table('job_task_users')->where("task_id",$request->id)->delete();
      foreach ($sid_array as $sid) {
          DB::table('job_task_users')->insert([
          'task_id' => $request->id,
          'user_id' => $sid
      ]);
           
        }



 return Redirect()->back()->with('notification',' Đã thêm việc thành công !');
      }else{
 return Redirect()->back()->with('notification',' Đã thêm việc thành công !');

      }


    }

 public function addTask(Request $request){
       if(!$this->checkLead()){
        return redirect("/");
      }
      $task_id = DB::table('job_task')->insertGetId([
          'job_id' => $request->job_id,
          'content' => $request->des,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date
      ]);


         if ($request->file !== null){
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
      
      $temp = explode("/", $url);
      $temp = end($temp);
 try{
      $img = Image::make($file)
      ->resize(300, 300)->stream();



      $path = Storage::disk('public')->put($temp, $img);
        }catch (\Exception $e) { 
          $path = 1;
               }

      DB::table('job_task_imgs')->insert([
            'name'=>$file_name,
            'task_id' => $task_id,
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
        ]);
}
}

    // $response = $this->sendMessage("Công việc con mới: ".$request->name ,0,Auth::user()->id);
      $job_name = DB::table("jobs")->where("id",$request->job_id)->first()->name;
   
    $event  = new Event();
   $event->title = "Công việc con mới";
    $event->type = 1;
    $event->description = $job_name;
    // $data = json_decode($response, true);
    $event->permiss = 0;
    $event->user_id = Auth()->user()->id;

    $event->save();



      $lead = $this->getLead();

       foreach ($lead as $lid) {
             DB::table('job_noti')->where( 'job_id',$request->job_id)->where('user_id',$lid)->update([
          'seen' => 0
      ]);
      }

if ($request->type_id == 0){


      $sid_array = $request->sid;

try{
      foreach ($sid_array as $sid) {
          DB::table('job_task_users')->insert([
          'task_id' => $task_id,
          'user_id' => $sid
      ]);
             DB::table('job_noti')->where( 'job_id',$request->job_id)->where('user_id',$sid)->update([
          'seen' => 0
      ]);

          $response = $this->sendMessage("Công việc mới: ".$request->name ,0,$sid);
        }
      }
  catch (\Exception $e) { 
               // DB::table('job_task')->where("id",$task_id)->delete();   
               // DB::table('job_noti')->where("job_id",$request->job_id)->delete();   
 return Redirect()->back()->with('warning',' Vui lòng chọn người thực hiện !');
                }



 return Redirect()->back()->with('notification',' Đã thêm việc thành công !');
      }else{
 return Redirect()->back()->with('notification',' Đã thêm việc thành công !');

      }


    }

    public function addJobs(Request $request){
       if(!$this->checkLead()){
        return redirect("/");
      }
      // DB::table('jobs')->insert([
      //     'name' => $request->name,
      //     'des' => $request->des,
      //     'start_date' => $request->start_date,
      //     'end_date' => $request->end_date
      // ]);

      $job = new Job();
      $job->user_id = Auth::user()->id;
      $job->name = $request->name;
      $job->des = $request->des;

if ($request->department == -1){
      $job->department_id = Role::where("id",Auth::user()->role_id)->first()->department_id;
    }else{
      $job->department_id = $request->department;
    }
      $job->type_id = $request->type_id;
      $job->start_date = $request->start_date;
      $job->end_date = $request->end_date;
      $job->save();


    if ($request->file !== null){
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
      
      $temp = explode("/", $url);
      $temp = end($temp);
 try{
      $img = Image::make($file)
      ->resize(300, 300)->stream();



      $path = Storage::disk('public')->put($temp, $img);
        }catch (\Exception $e) { 
          $path = 1;
               }
               
      DB::table('job_imgs')->insert([
            'name'=>$file_name,
            'job_id' => $job->id,
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
        ]);
}
}

    $response = $this->sendMessage("Công việc mới: ".$request->name ,0,Auth::user()->id);
   
    $event  = new Event();
   $event->title = "Công việc mới";
    $event->type = 1;
    $event->description = $request->name;
    // $data = json_decode($response, true);
    $event->permiss = 0;
    $event->user_id = Auth()->user()->id;

    $event->save();



      $lead = $this->getLead();

       foreach ($lead as $lid) {
          DB::table('job_noti')->insert([
          'job_id' => $job->id,
          'user_id' => $lid
      ]);
      }

if ($request->type_id == 0){


      $sid_array = $request->sid;

try{
      foreach ($sid_array as $sid) {
          DB::table('job_users')->insert([
          'job_id' => $job->id,
          'user_id' => $sid
      ]);

            DB::table('job_noti')->insert([
          'job_id' => $job->id,
          'user_id' => $sid
      ]);
            
          $response = $this->sendMessage("Công việc mới: ".$request->name ,0,$sid);
        }
  }
                catch (\Exception $e) { 
               DB::table('jobs')->where("id",$job->id)->delete();   
               DB::table('job_noti')->where("job_id",$job->id)->delete();   
 return Redirect()->back()->with('warning',' Vui lòng chọn người thực hiện !');
                }


 return Redirect()->back()->with('notification',' Đã thêm việc thành công !');
      }else{
 return Redirect()->back()->with('notification',' Đã thêm việc thành công !');

      }


    }
      public function updateJobs(Request $request){ 
        if(!$this->checkLead()){
        return redirect("/");
      }

      // $job = new Job();
      // $job->name = $request->name;
      // $job->des = $request->des;
      // $job->start_date = $request->start_date;
      // $job->end_date = $request->end_date;
      // $job->save();
      
      DB::table('jobs')->where("id",$request->id)->update([
          'name' => $request->name,
          'des' => $request->des,
          'start_date' => $request->start_date,
          'end_date' => $request->end_date
      ]);


    if ($request->file !== null){
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
      
      $temp = explode("/", $url);
      $temp = end($temp);
 try{
      $img = Image::make($file)
      ->resize(300, 300)->stream();



      $path = Storage::disk('public')->put($temp, $img);
        }catch (\Exception $e) { 
          $path = 1;
               }
               
      DB::table('job_imgs')->insert([
            'name'=>$file_name,
            'job_id' => $request->id,
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
        ]);
}
}


      $sid_array = $request->sid;
      if ($sid_array !== null){
      DB::table('job_users')->where("job_id",$request->id)->delete();
      foreach ($sid_array as $sid) {
          DB::table('job_users')->insert([
          'job_id' => $request->id,
          'user_id' => $sid
      ]);

      }

      return Redirect()->back()->with('notification',' Đã cập nhật thành công !');;
    }

      return Redirect()->back()->with('notification',' Đã cập nhật thành công !');;
    }

     public function closeJobs(Request $request){

       if(!$this->checkLead()){
        return redirect("/");
      }
      
      
      DB::table('jobs')->where("id",$request->id)->update([
          'status' => $request->status
      ]);

$name =  DB::table('jobs')->where("id",$request->id)->first()->name;

$user_id =  DB::table('jobs')->where("id",$request->id)->first()->user_id;
      if($request->status == 1){

      $response = $this->sendMessage("Công việc hoàn thành: ".$name ,0,$user_id);
      $event  = new Event();
      $event->title = "Công việc hoàn thành";
      $event->type = 1;
      $event->description = $name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = $user_id;
      $event->save();

      $sid = DB::table('job_users')->where("job_id",$request->id)->get();
foreach ($sid as $sid) {
      $response = $this->sendMessage("Công việc hoàn thành: ".$name ,0,$sid->user_id);
      $event  = new Event();
      $event->title = "Công việc hoàn thành";
      $event->type = 1;
      $event->description = $name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = $sid->user_id;
      $event->save();
}
    }elseif($request->status == 2){
      
      $response = $this->sendMessage("Công việc chưa hoàn thành: ".$name ,0,$user_id);
      $event  = new Event();
      $event->title = "Công việc chưa hoàn thành";
      $event->type = 1;
      $event->description = $name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = $user_id;
      $event->save();

      $sid = DB::table('job_users')->where("job_id",$request->id)->get();
foreach ($sid as $sid) {
      $response = $this->sendMessage("Công việc chưa hoàn thành: ".$name ,0,$sid->user_id);
      $event  = new Event();
      $event->title = "Công việc chưa hoàn thành";
      $event->type = 1;
      $event->description = $name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = $sid->user_id;
      $event->save();
       DB::table('job_noti')->where( 'job_id',$request->id)->where('user_id',$sid->user_id)->update([
          'seen' => 0
      ]);

}
    }else{
          
      $response = $this->sendMessage("Công việc đã ngưng: ".$name ,0,$user_id);
      $event  = new Event();
      $event->title = "Công việc đã ngưng";
      $event->type = 1;
      $event->description = $name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = $user_id;
      $event->save();

      $sid = DB::table('job_users')->where("job_id",$request->id)->get();
foreach ($sid as $sid) {
      $response = $this->sendMessage("Công việc đã ngưng: ".$name ,0,$sid->user_id);
      $event  = new Event();
      $event->title = "Công việc đã ngưng";
      $event->type = 1;
      $event->description = $name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = $sid->user_id;
      $event->save();
      DB::table('job_noti')->where( 'job_id',$request->id)->where('user_id',$sid->user_id)->update([
          'seen' => 0
      ]);

}

    }
    $lead = $this->getLead();

       foreach ($lead as $lid) {
           DB::table('job_noti')->where( 'job_id',$request->id)->where('user_id',$lid)->update([
          'seen' => 0
      ]);

      }



      return Redirect()->back()->with('notification',' Đã thao tác thành công !');;

    }

    public function jobsDetail($id){

             $check1 = DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
           ->where("jobs.id",$id)->where('job_users.user_id',Auth::id())->count();

            $check2 = DB::table("jobs")->where("id",$id)->where('user_id',Auth::id())->count();
            if ($check1 < 1 && $check2 < 1){
              return 0;
            }



             $jobs = DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.name as name","jobs.des as des"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')->where("jobs.id",$id)->first();

            return $jobs;
    }
    public function historyJob($id){  
      $check1 = DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
           ->where("jobs.id",$id)->where('job_users.user_id',Auth::id())->count();

            $check2 = DB::table("jobs")->where("id",$id)->where('user_id',Auth::id())->count();
            if ($check1 < 1 && $check2 < 1){
              return 0;
            }
    // $area = Zone::where('area_id', $area_id)->get();

    $area = DB::table('job_moniters')
    ->leftJoin('jobs', 'jobs.id', '=', 'job_moniters.jobs_id')
    ->leftJoin('users', 'users.id', '=', 'job_moniters.user_id')
    ->where([['jobs.id',$id]])
    ->select("users.name as name","job_moniters.content as content",'job_moniters.link as link','job_moniters.created_at as time')->get();
    return json_encode($area);
  }



    public function addHistoryJob(Request $request)
    {   
      $id =  $request->id;
      $des = $request->des;
     $check1 = DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
           ->where("jobs.id",$id)->where('job_users.user_id',Auth::id())->count();

            $check2 = DB::table("jobs")->where("id",$id)->where('user_id',Auth::id())->count();
            if ($check1 < 1 && $check2 < 1){
             return Redirect()->back()->with('warning', 'Tài khoản không có quyền với tác vụ');
        
            }
         // $image = $request->file('file');;

      if ($request->file == null){
           return Redirect()->back()->with('warning', 'Chưa có tệp minh chứng tải lên');
        }
      // $img = Image::make($image->getRealPath());
    // dd($request->file->getClientOriginalName());
      // $img = $request->file;


          
      // $destinationPath = public_path().'/files/jobs/';
      // $file_name = $request->file->getClientOriginalName();
try{
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      $path = $file->store('jobs');

      $url = Storage::url($path);
      
      $new_history = new Jobmoniters();
      $new_history->jobs_id = $id;
      $new_history->user_id = Auth()->user()->id;
      $new_history->content = $des;
      $new_history->link = $url;
      $new_history->save();

       DB::table("job_tag")->insert([
            'history_id' => $file->id,
            'tag_id' => 48

        ]);

      $job_name  = Job::where("id",$id)->first()->name;
}



        }
catch (\Exception $e) { 

        return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');

               }


   
      $response = $this->sendMessage("Cập nhật tiến độ công việc: ".$job_name ,0,Auth::user()->id);
   
      $event  = new Event();
     $event->title = "Cập nhật tiến độ công việc";
      $event->type = 1;
      $event->description = $job_name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = Auth()->user()->id;

      $event->save();

      // $request->file->move($destinationPath, $file_name);
      // Jobmoniters::where('id', $new_history->id)->update([
      //       'link' => $url
      //   ]);



   $lead = $this->getLead();

       foreach ($lead as $lid) {
           DB::table('job_noti')->where( 'job_id',$id)->where('user_id',$lid)->update([
          'seen' => 0
      ]);
      }
      // dd("???????");
        return Redirect()->back()->with('notification',' Đã cập nhật tiến độ ');

    // $zone_contribute = Zone::where("id",$id)->first()->contribute_state;
    // if ($zone_contribute !== $request->state){

    //   Zone::where('id', $id)->update([
    //         'contribute_state' => $request->state
    //     ]);
    //      return redirect('area-contribute-information/'.Zone::where('id', $id)->first()->area_id);
    // }
        // event($e = new RedisEvent($request->all()));

      // $image->move($destinationPath.'');
      // return "true";
  }
  public function addNewConsumer(Request $req){
     try{



   $tagArr = [];

    $tags = explode(",", $req->tags);
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
    }


          if(strlen($req->phone_number) > 15){
            return Redirect()->back()->with('warning',' Số điện thoại quá dài ');
          }
          if(strlen($req->identify) > 15){
            return Redirect()->back()->with('warning',' Chứng minh thư quá dài ');
          }



            $new_consumer = new Consumer();
            $new_consumer->name = $req->name;
            $new_consumer->phone_number = $req->phone_number;
            $new_consumer->identify_card = $req->identify;
            $new_consumer->iden_date = $req->iden_date;
            $new_consumer->birth_date = $req->bd;
            $new_consumer->iden_location = $req->iden_location;
            $new_consumer->address = $req->address;
            $new_consumer->email = $req->email;
            $new_consumer->save();



            $new_user = new User();
            $new_user->name = $new_consumer->name;
            $new_user->email = $new_consumer->email;
            $new_user->phone = $new_consumer->phone_number;
            $new_user->identify = $new_consumer->identify_card;


            $new_user->iden_date = $new_consumer->iden_date;

            $new_user->iden_location = $new_consumer->iden_location;

            $new_user->tax_code = "00000";

            $new_user->birth_date = $new_consumer->birth_date;

            $new_user->role_id = 27;

            $pass = Str::random(25);
            // $new_user->password = Hash::make($pass);
            $new_user->password = Hash::make("123456");

          
            $new_user->save();
            DB::table("consumer")->where("id",$new_consumer->id)->update(["user_id"=>$new_user->id]);

            
           foreach ($tagArr as $tag) {
                 # code...
               DB::table("consumer_tags")->insert([
                    'consumer_id' => $new_consumer->id,
                    'tag_id' => $tag
                ]);
          }


          // $group_tags =  $req->tagids;
          //   foreach ($group_tags as $group) {
          //        # code...
          //      DB::table("consumer_grouptag")->insert([
          //           'consumer_id' => $new_consumer->id,
          //           'group_id' => $group
          //       ]);
          // }

            return Redirect()->route('consumer-list')->with('notification',' Đã tạo khách hàng thành công ');

            }
                catch (\Exception $e) { 
                  dd($e);
                // return Redirect()->back()->with('warning',' Thiếu thông tin ');
                }

  }


  public function CredentialConsumer($Credential_id){
        $Credential = Credential::where('id',$Credential_id)->first();
        $Credential_profiles = CredentialProfile::where('Credential_id',$Credential_id)->distinct()->get(['profile_id','Credential_id','profile_name']);
        $profile_current = CredentialProfile::where([['Credential_id',$Credential_id],['profile_id',$Credential->profile_id]])->get();
        return view('device.Credential_information',compact('Credential','Credential_profiles','profile_current'));
  }

    public function editConsumer(Request $req){
          if(strlen($req->phone_number) > 15){
            return Redirect()->back()->with('warning',' Số điện thoại quá dài ');
          }
          if(strlen($req->identify) > 15){
            return Redirect()->back()->with('warning',' Chứng minh thư quá dài ');
          }

             $tagArr = [];
    $tags = explode(",", $req->tags);
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
    }
    DB::table("consumer_tags")->where("consumer_id",$req->id)->delete();

              foreach ($tagArr as $tag) {
         # code...
       DB::table("consumer_tags")->insert([
            'consumer_id' => $req->id,
            'tag_id' => $tag

        ]);
       }

        Consumer::where('id', $req->id)->update([
            'name' => $req->name,
            'phone_number' => $req->phone_number,
            'identify_card' => $req->identify,
            'birth_date' => $req->bd,
            'iden_date' => $req->iden_date,
            'iden_location' => $req->location,
            'address' => $req->address,
            'email' => $req->email,
        ]);

        DB::table("consumer_grouptag")
        ->where("consumer_id",$req->id)
        ->delete();

         // $group_tags =  $req->tagids;
         //    foreach ($group_tags as $group) {
         //         # code...
         //       DB::table("consumer_grouptag")->insert([
         //            'consumer_id' => $req->id,
         //            'group_id' => $group
         //        ]);
         //  }

        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteConsumer(Request $req){
        // ($req);
        $data = $req->post();
        $flag = 0;
        // dd($data);
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                  
                    Consumer::where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->route('consumer-list')->with('notification',' Đã xóa tất cả khách hàng.');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa khách');

        }
       
        

    }

    public function DepartmentList(){
        $department = Department::get();
        return json_encode($department);
    }
    
    public function getConsumerLegal(){

    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
        $legal_list = DB::table("department_legal")
        ->leftJoin('task', 'task.id', '=', 'department_legal.task_id')
        ->where('department_legal.dept_id', $depart )
        ->select("task.id as id","task.name as name","task.file_flag as file_flag","task.url as url",
        "task.des as des","task.legal as legal","task.status as status","task.type as type",
        "task.department_id as department_id","task.legal_type as legal_type","task.start_date as start_date","task.duration as duration"
        )->get();

        $form_list = DB::table("role_legal")
        ->leftJoin('legal_form', 'role_legal.legal_id', '=', 'legal_form.id')->where("role_legal.user_role",$depart )->select("legal_form.id as id","legal_form.name as name","legal_form.url as url")->get();
      return view('staff.index',compact('legal_list','form_list'));

    }
  public function jobDetail($id){
$job = Job::where("id",$id)->first();
    $level = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->level;

    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
    if($level < 3 && $depart == $job->department_id){
          print_r("oke");
    }else{
      $check1 = DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
           ->where("jobs.id",$id)->where('job_users.user_id',Auth::id())->count();

            $check2 = DB::table("jobs")->where("id",$id)->where('user_id',Auth::id())->count();


            if ($check1 < 1 && $check2 < 1 && !$this->checkLead()){
             return Redirect()->back()->with('warning', 'Tài khoản không có quyền với tác vụ');
        
            }
      }
      if($this->checkLead() || $this->checkLead()){
        $permis = 1;
      }else{
        $permis = 0;

      }
             $job_user = DB::table("jobs")->where("jobs.id",$id)->first()->user_id;

             if($job_user == Auth()->user()->id){
                DB::table("jobs")->where("jobs.id",$id)->update(["seen" =>1]);
             }
                DB::table("job_users")->where("job_id",$id)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
              // dd();
              // if($this->checkLead()){
                 DB::table("job_noti")->where("job_id",$id)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
              // }

      $user = User::where("id",$job->user_id)->first();
      $job_cmt = DB::table("job_comments")->where("job_id",$id)->get();

      $job = DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
            ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
            ->select("jobs.id as id","jobs.user_id as user_id","jobs.name as name","jobs.des as des","jobs.status as status","jobs.department_id as did"
              ,"jobs.start_date as start_date","jobs.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('jobs.id')
            ->where("jobs.id", $id)->first();


      $tasks = DB::table("job_task")
            ->leftJoin('job_task_users', 'job_task_users.task_id', '=', 'job_task.id')
            ->leftJoin('users', 'users.id', '=', 'job_task_users.user_id')
            ->select("job_task.id as id","job_task.content as content",
              "job_task.flag as flag"
              ,"job_task.start_date as start_date","job_task.end_date as end_date"
              ,DB::raw("group_concat(users.name SEPARATOR ', ') as names"))
            // ->select(DB::raw("count(users.id)"))
            ->groupBy('job_task.id')
            ->where("job_task.job_id", $id)->get();


            $comtask = DB::table("job_task")
            ->where("job_task.job_id", $id)
            ->where("job_task.flag", 2)
            ->count();


            $alltask = DB::table("job_task")
            ->where("job_task.job_id", $id)
            ->count();

            if($alltask == 0){
              $percent = 0;
            }else{
                $percent = round($comtask/$alltask,4)*100;
            }

            $check = DB::table("jobs")->where("id", $id)->first()->status;
            if($check  == 1){
              $percent = 100;
            }

 $job_url = DB::table('job_moniters')
    ->leftJoin('jobs', 'jobs.id', '=', 'job_moniters.jobs_id')
    ->leftJoin('users', 'users.id', '=', 'job_moniters.user_id')
    ->where([['jobs.id',$id]])
    ->select("users.name as name","job_moniters.content as content",'job_moniters.link as link','job_moniters.created_at as time')->get();

$staffs = DB::table("job_users")
    ->leftJoin('users', 'users.id', '=', 'job_users.user_id')
     ->select("users.name as name","users.id as id")
            ->where("job_users.job_id", $id)->get();

        return view('account.job_detail', compact('job','user','job_cmt','job_url',"staffs","tasks","permis","percent"));
    }

    public function postJobComment(Request $request){
      $id =  $request->job_id;
     $job = Job::where("id",$id)->first();
    $level = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->level;

    $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
    if($level < 3 && $depart == $job->department_id){
          print_r("oke");
    }else{
      $check1 = DB::table("jobs")
            ->leftJoin('job_users', 'job_users.job_id', '=', 'jobs.id')
           ->where("jobs.id",$id)->where('job_users.user_id',Auth::id())->count();

            $check2 = DB::table("jobs")->where("id",$id)->where('user_id',Auth::id())->count();


            if ($check1 < 1 && $check2 < 1){
             return Redirect()->back()->with('warning', 'Tài khoản không có quyền với tác vụ');
        
            }
      }


      $job_id  = DB::table("job_comments")->insertGetId([
          'user_id' =>  Auth()->user()->id,
          'job_id' => $request->job_id,
          'content' => $request->content,
      ]);

         if ($request->file !== null){
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      $path = $file->store('discuss');

      $url = Storage::url($path);
      
      DB::table('job_comments_url')->insert([
            'job_id' => $job_id,
            'url' => $url
        ]);
}
}

      $job_name  = Job::where("id",$request->job_id)->first()->name;

        $response = $this->sendMessage("Cập nhật bình luận mới: ".$job_name ,0,Auth::user()->id);
   
      $event  = new Event();
     $event->title = "Cập nhật bình luận";
      $event->type = 1;
      $event->description = $job_name;
      // $data = json_decode($response, true);
      $event->permiss = 0;
      $event->user_id = Auth()->user()->id;

      $event->save();

       return Redirect()->back()->with('notification',' Đã thêm bình luận thành công');
    }

      public function getJobComment($job_id){
      return DB::table("job_comments")->where("job_id",$job_id)
      ->leftJoin('users', 'job_comments.user_id', '=', 'users.id')
     ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
     ->leftJoin('department', 'department.id', '=', 'roles.department_id')
     ->select("users.name as name",
      "roles.name as rname","department.name as dname", "job_comments.content as content")
      ->get();

    }

}
