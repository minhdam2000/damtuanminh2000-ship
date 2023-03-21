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
use Carbon\Carbon;
use Mail;

use Illuminate\Support\Str;
use Illuminate\Http\Request;


use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\TblWidth;



class BuildingController extends Controller
{   

    public function contractor()
    {
          if(!$this->checkLead()){
                return redirect("/");
          }
                // dd(Auth::user()->role_id);
                $contractors = DB::table("contractors")->get();
                return view('building.contractor', compact('contractors'));
            
    }



  public function addNewContractor(Request $req){
     // try{
          DB::table("users")->where("email",$req->email)->where("status",0)->delete();
            $new_consumer = new Consumer();
            $new_consumer->name = $req->name;
            $new_consumer->phone_number = $req->phone_number;
            $new_consumer->identify_card = $req->identify;
            $new_consumer->save();

            $id = DB::table("contractors")->insertGetId([
                "name"=>$req->name,
                "email"=>$req->email,
                "proxy"=>$req->proxy,
                "phone"=>$req->phone,

            ]);


             $new_user = new User();
            // $new_user->user_id = Auth()->user()->id;
            $new_user->name = $req->name;
            $new_user->email = $req->email;
            $new_user->phone = $req->phone;


            // $new_user->iden_date = $req->iden_date;

            // $new_user->iden_location = $req->iden_location;

            // $new_user->tax_code = $req->tax_code;

            // $new_user->birth_date = $req->birth_date;

            // $new_user->begin_date = $req->begin_date;
            // $new_user->bank = $req->bank;

            // $new_user->bank_name = $req->bank_name;

            $new_user->role = 2;
            // if($req->role > 0 )
            //     $new_user->role_id = 0;
            // if($req->department == 12){
            //     $new_user->role_id = -($req->role);
            // }

            // $new_user->password = Hash::make($req->password);

            $pass = Str::random(25);
            $new_user->password = Hash::make($pass);

          
            $new_user->save();

            // $department = Department::where("id",$req->department)->first()->name;
            // $role = Role::where("id",$req->role)->first()->name;
            $data = array('mypass'=>$pass,"myemail"=>$req->email,"email"=>$req->email);
            // dd($data);
                  Mail::send('newcontractor', $data, function($message) use ($data)  {
                     $message->to($data['email'], 'thông báo tài khoản cho nhà thầu')->subject
                        ('Thông báo tài khoản cho nhà thầu');
                     $message->from('automail.lopital@gmail.com','Lopital');
                  });
      


            return Redirect()->back()->with('notification',' Đã tạo nhà thầu thành công ');

            // }
            //     catch (\Exception $e) { 
            //     return Redirect()->back()->with('warning',' Thiếu thông tin ');
            //     }

  }
  


   public function editContractor(Request $req){
             DB::table("contractors")->where('id', $req->id)->update([
                "name"=>$req->name,
                "proxy"=>$req->proxy,
                "phone"=>$req->phone,

            ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

    public function deleteContractor($id){
        $count = DB::table("buildingg_contractor")->where("contractor_id",$id)->count();

        if($count <2){
            $mail = DB::table("contractors")->where('id', $id)->first()->email;
            DB::table("users")->where("email",$mail)->update(["status"=>0]);
        }
        DB::table("contractors")->where('id', $id)->delete();
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

  public function addNewJob(Request $req){

if($req->duration !=null && is_int(intval($req->duration))){
        // dd("????");
        if(intval($req->duration) > 0){

            $duration = $req->duration;
            $start = Carbon::createFromFormat('Y-m-d', $req->start ); 
            $end = $start->addDays($req->duration)->format('Y-m-d');
            $start = Carbon::createFromFormat('Y-m-d', $req->start );
        }
    }else{
        $start = Carbon::createFromFormat('Y-m-d', $req->start ); 
        $end = Carbon::createFromFormat('Y-m-d', $req->end ); 


        $timestamp1 = strtotime($req->start );
        $timestamp2 = strtotime($req->end);
        $duration = intval(($timestamp2 - $timestamp1)/(60*60*24));
        // dd($duration);


    }


            $id = DB::table("building_job")->insertGetId([
                "name"=>$req->name,
                "duration"=>$duration,
                "start"=>$start,
                "end"=>$end,
                "project_id"=>$req->pid

            ]);


            return Redirect()->back()->with('notification',' Đã tạo hợp đồng thành công ');

        
  }

   public function saveProjectCache(Request $req){
    $check =   DB::table("building_job_user")
        ->where("job_id",$req->id)
        ->where("user_id", Auth()->user()->id)->count();
        if($check > 0){
        DB::table("building_job_user")
        ->where("job_id",$req->id)
        ->where("user_id", Auth()->user()->id)
        ->update(["cache"=>$req->cache]);
        
        }else{

        DB::table("building_job_user")
        ->where("id",$req->id)
        ->where("user_id", Auth()->user()->id)
        ->insert([
            "user_id"=>Auth()->user()->id,
            "job_id"=>$req->id,
            "cache"=>$req->cache
        ]);
        }

        return 0;
    }

      public function saveBuiltCache(Request $req){

         $check =   DB::table("buildingg_user")
        ->where("job_id",$req->id)
        ->where("user_id", Auth()->user()->id)->count();
        if($check > 0){
        DB::table("buildingg_user")
        ->where("job_id",$req->id)
        ->where("user_id", Auth()->user()->id)
        ->update(["cache"=>$req->cache]);
        
        }else{

        DB::table("buildingg_user")
        ->where("id",$req->id)
        ->where("user_id", Auth()->user()->id)
        ->insert([
            "user_id"=>Auth()->user()->id,
            "job_id"=>$req->id,
            "cache"=>$req->cache
        ]);
        }

        return 0;
    }


   public function editJob(Request $req){
           DB::table("building_job")->where("id",$req->id)->update([
                "name"=>$req->name,
                "duration"=>$req->duration,
                "start"=>$req->start,
                "end"=>$req->end,
                "project_id"=>$req->pid

            ]);
        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

 public function removeNoti($id){
        $count =   DB::table("build_noti")
    ->where("user_id",Auth()->user()->id)
    ->where("building_id",$id)
    ->distinct()->delete();
        return Redirect()->back()->with('notification', 'Đã bỏ theo dõi');
    }


 public function deleteJob($id){
        $count = DB::table("buildingg")->where("project_id",$id)->count();
        if($count > 0){

        return Redirect()->back()->with('warning', 'Không thể xóa hợp đồng đang thực hiện');
        }
        DB::table("building_job")->where('id', $id)->delete();
        return Redirect()->back()->with('notification', 'Đã xóa hợp đồng thành công');
    }
      public function contract(){

        if(!$this->checkContributeMap()){
            return redirect("/");
        }
        $projects =DB::table("projects")
->rightJoin('building_job', 'projects.id', '=', 'building_job.project_id')->select("building_job.id as id","projects.name as name","building_job.name as jname","projects.id as pid","building_job.duration as duration",
"building_job.start as start","building_job.end as end","building_job.real_percent as real_percent",
"building_job.payment_percent as payment_percent","building_job.acceptance_percent as acceptance_percent")->where("building_job.level",0)
->get();


    $build_arr = DB::table("build_noti")
    ->select("building_id")
    ->where("user_id",Auth()->user()->id)
    ->distinct()->pluck("building_id")->toArray();

    // dd($build_arr);
    $building =DB::table("buildingg")->whereIn("id",$build_arr)
                ->orderBy('project_id', 'asc')->get();


    $pids = DB::table("projects")->get();
    return view('building.contract', compact("building",'build_arr','projects',"pids"));
}

    public function list(){
        if(!$this->checkContributeMap()){
            return redirect("/");
        }
        $projects =DB::table("projects")
->rightJoin('building_job', 'projects.id', '=', 'building_job.project_id')->select("building_job.id as id","projects.name as name","building_job.name as jname","projects.id as pid","building_job.duration as duration",
"building_job.start as start","building_job.end as end","building_job.real_percent as real_percent",
"building_job.payment_percent as payment_percent","building_job.acceptance_percent as acceptance_percent")->where("building_job.level",0)
->get();


    $build_arr = DB::table("build_noti")
    ->select("building_id")
    ->where("user_id",Auth()->user()->id)
    ->distinct()->pluck("building_id")->toArray();

    // dd($build_arr);
    $building =DB::table("buildingg")->whereIn("id",$build_arr)
                ->orderBy('project_id', 'asc')->get();


    $pids = DB::table("projects")->get();
    return view('building.project', compact("building",'build_arr','projects',"pids"));
}

      public function data($id){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }
      $total_job = DB::table("building_job")->where("id",$id)->first();



    $display_type = 0;
    // $task_total = DB::table("building_job")->where("level",0)->where("project_id",$id)->first();

    $task_total = DB::table("buildingg")

    ->select(
                DB::raw('AVG(real_percent) as real_percent'),
                DB::raw('AVG(acceptance_percent) as acceptance_percent'),
                DB::raw('AVG(payment_percent) as payment_percent')
    )
    ->where("root_id",0)->where("project_id",$id)->first();

    DB::table("building_job")->where("id",$id)->update([
    "real_percent"=>$task_total->real_percent,
    "acceptance_percent"=>$task_total->acceptance_percent,
    "payment_percent"=>$task_total->payment_percent,
    ]);




    $start = DB::table('buildingg')->where("root_id",0)->where("project_id",$id)->min('start');

    if($start == null){
        $start = DB::table('building_job')->where("id",$id)->first()->start;
    }

     // $buildingg =DB::table("buildingg")->get();
     //  for ($i =0;$i <5;$i ++){
     //    foreach($buildingg as $bgg){
     //        $check  = DB::table("buildingg")
     //        ->where("last_id",$bgg->id)
     //         ->count();
     //         if($check  > 0){
     //        $new_start =  DB::table("buildingg")->where("last_id",$bgg->id)
     //         ->min('start');


     //        $new_end =  DB::table("buildingg")->where("last_id",$bgg->id)
     //         ->max('end');

     //        $timestamp1 = strtotime($new_start );
     //        $timestamp2 = strtotime($new_end);
     //        $duration = intval(($timestamp2 - $timestamp1)/(60*60*24));

     //           DB::table("buildingg")->where("id",$bgg->id)->update(
     //            [
     //                "duration"=>$duration,
     //                "start"=>$new_start,
     //                "end"=>$new_end,
     //            ]
     //        );
     //       }

     //    }

     //  }



    $start_arr = explode("-",$start);
    $syear = $start_arr[0];
    $smonth = $start_arr[1];



    $end = DB::table('buildingg')->where("root_id",0)->where("project_id",$id)->max('end');

     if($end == null){
        $end = DB::table('building_job')->where("id",$id)->first()->end;
    }

    $end_arr = explode("-",$end);
    $eyear = $end_arr[0];
    $emonth = $end_arr[1];


    $duration = DB::table('buildingg')->where("root_id",0)->where("project_id",$id)->max('duration');


    $building =DB::table("buildingg")->where("root_id",0)->where("project_id",$id)->get();



    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);





$built_list =DB::table("buildingg")
->select("id","stt","root_id")
->where("project_id",$id)->get();



$cache =DB::table("building_job_user")
->where("job_id",$id)
->where("user_id",Auth()->user()->id)
->first();
if($cache != null){
$cache = $cache->cache;
}else{
    $cache = "none";
}
// dd($cache);

// dd($built_list);

   $contractors = DB::table("contractors")->get();
    return view('building.file',compact("total_job","contractors","building",
        "display_type",'task_total','id',"tags",
        "built_list","duration","start","cache"
        ,"smonth","syear","eyear","emonth"));

  }


      public function detail($id){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }
      $total_job = DB::table("buildingg")->where("id",$id)->first();



    $display_type = 0;
    // $task_total = DB::table("building_job")->where("level",0)->where("project_id",$id)->first();

    $task_total = DB::table("buildingg")

    ->select(
                DB::raw('AVG(real_percent) as real_percent'),
                DB::raw('AVG(acceptance_percent) as acceptance_percent'),
                DB::raw('AVG(payment_percent) as payment_percent')
    )->where("id",$id)->first();

    DB::table("building_job")->where("id",$id)->update([
    "real_percent"=>$task_total->real_percent,
    "acceptance_percent"=>$task_total->acceptance_percent,
    "payment_percent"=>$task_total->payment_percent,
    ]);


try{
    $start = DB::table('buildingg')->where("last_id",$id)->min('start');



    $start_arr = explode("-",$start);
    $syear = $start_arr[0];
    $smonth = $start_arr[1];



    $end = DB::table('buildingg')->where("last_id",$id)->max('end');
    $end_arr = explode("-",$end);
    $eyear = $end_arr[0];
    $emonth = $end_arr[1];


    $duration = DB::table('buildingg')->where("last_id",$id)->max('duration');


    $building =DB::table("buildingg")->where("last_id",$id)->get();

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);
  }catch (\Exception $e) { 
          
 return Redirect()->back()->with('warning',' Hạng mục không chứa thông tin chi tiết!');
               }

  // $buildingg =DB::table("buildingg")->get();
  //     for ($i =0;$i <5;$i ++){
  //       foreach($buildingg as $bgg){
  //           $check  = DB::table("buildingg")
  //           ->where("last_id",$bgg->id)
  //            ->count();
  //            if($check  > 0){
  //           $new_start =  DB::table("buildingg")->where("last_id",$bgg->id)
  //            ->min('start');


  //           $new_end =  DB::table("buildingg")->where("last_id",$bgg->id)
  //            ->max('end');

  //           $timestamp1 = strtotime($new_start );
  //           $timestamp2 = strtotime($new_end);
  //           $duration = intval(($timestamp2 - $timestamp1)/(60*60*24));

  //              DB::table("buildingg")->where("id",$bgg->id)->update(
  //               [
  //                   "duration"=>$duration,
  //                   "start"=>$new_start,
  //                   "end"=>$new_end,
  //               ]
  //           );
  //          }

  //       }

  //     }
      
// dd($building);
$built_list =DB::table("buildingg")
->select("id","stt","root_id","last_id")
->where("last_id",$id)->get();

// dd($built_list);

$cache =DB::table("buildingg_user")
->where("job_id",$id)
->where("user_id",Auth()->user()->id)
->first();
if($cache != null){
$cache = $cache->cache;
}else{
    $cache = "none";
}
   $contractors = DB::table("contractors")->get();
    return view('building.detail',compact("total_job","contractors","building",
        "display_type",'task_total','id',"tags",
        "built_list","duration","start","cache"
        ,"smonth","syear","eyear","emonth"));

  }




public function postEditMini(Request $req){

     if(!$this->checkContributeMap()){
        return 0;
      }

      if(intval($req->duration) > 0){

            $duration = $req->duration;
            $start = Carbon::createFromFormat('Y-m-d', $req->start ); 
            $end = $start->addDays($req->duration)->format('Y-m-d');
            $start = Carbon::createFromFormat('Y-m-d', $req->start );
        
    }else{
        $start = Carbon::createFromFormat('Y-m-d', $req->start ); 
        $end = Carbon::createFromFormat('Y-m-d', $req->end ); 


        $timestamp1 = strtotime($req->start );
        $timestamp2 = strtotime($req->end);
        $duration = intval(($timestamp2 - $timestamp1)/(60*60*24));
        // dd($duration);


    }

    DB::table("buildingg")->where("id",$req->id)->update(
        [
            "duration"=>$duration,
            "start"=>$start,
            "end"=>$end,
            "stt"=>$req->stt,
            "title"=>$req->title,
        ]
    );
  return 1;

}


public function postEdit(Request $req){
     if(!$this->checkContributeMap()){
        return redirect("/");
      }
    DB::table("buildingg")->where("id",$req->id)->update(
        [
           "stt"=>$req->stt,
            "title"=>$req->title,
            "des"=>$req->des,
            "duration"=>$req->duration,
            "start"=>$req->start,
            "end"=>$req->end,
        ]
    );
 $cids = $req->cid;
 if($cids != null){
    foreach($cids as $cid){

        DB::table("buildingg_contractor")->insert([
            "building_id"=>$req->id,
            "contractor_id"=>$cid
        ]);
    }
}

        return redirect()->back()->with('notification',' Đã chỉnh sửa hạng mục');
}



public function edit($id){
    $built = DB::table("buildingg")->where("id",$id)->first();
    $contractors = DB::table("contractors")->get();

    return view('building.edit',compact('built','contractors'));
    
}


public function addStep(Request $req){
     if(!$this->checkLead()){
        return redirect("/");
      }
      // dd($req->duration);
    if($req->duration !=null && is_int(intval($req->duration))){
        // dd("????");
        if(intval($req->duration) > 0){

            $duration = $req->duration;
            $start = Carbon::createFromFormat('Y-m-d', $req->start );
            $end = clone $start; 
            $end->addDays($req->duration)->format('Y-m-d');
        }
    }else{
        $start = Carbon::createFromFormat('Y-m-d', $req->start ); 
        $end = Carbon::createFromFormat('Y-m-d', $req->end ); 


        $timestamp1 = strtotime($req->start );
        $timestamp2 = strtotime($req->end);
        $duration = intval(($timestamp2 - $timestamp1)/(60*60*24));
        // dd($duration);


    }

    $bid = DB::table("buildingg")->insertGetId(
        [
            "stt"=>$req->stt,
            "project_id"=>$req->id,
            "title"=>$req->title,
            "des"=>$req->des,
            "duration"=>$duration,
            "start"=>$start,
            "end"=>$end,
        ]
    );

//     $cids = $req->cid;
//     foreach($cids as $cid){

//     DB::table("buildingg_contractor")->insert([
//         "building_id"=>$bid,
//         "contractor_id"=>$cid
//     ]);
// }


        return redirect()->back()->with('notification',' Đã thêm tệp thành công');
}



public function addSubstep(Request $req){
     if(!$this->checkLead()){
        return redirect("/");
      }



try{
    // dd($req->id);
   $root =  DB::table("buildingg")->where("id",$req->id)->first();

 if($req->root_id > 0){

    $root_id = $req->root_id;
 }else{
    $root_id = $req->id;
 }

   if($req->duration !=null && is_int(intval($req->duration))){
        // dd("????");
        if(intval($req->duration) > 0){

            $duration = $req->duration;
            $start = Carbon::createFromFormat('Y-m-d', $req->start );
            $end = clone $start; 
            $end->addDays($req->duration)->format('Y-m-d');

        }
    }else{
        $start = Carbon::createFromFormat('Y-m-d', $req->start ); 
        $end = Carbon::createFromFormat('Y-m-d', $req->end ); 


        $timestamp1 = strtotime($req->start );
        $timestamp2 = strtotime($req->end);
        $duration = intval(($timestamp2 - $timestamp1)/(60*60*24));
        // dd($duration);


    }

 
    $bid = DB::table("buildingg")->insertGetId(
        [
            "stt"=>$req->stt,
            "project_id"=>$root->project_id,
            "root_id"=>$root->id,
            "last_id"=>$root_id,
            "title"=>$req->title,
            "des"=>$req->des,
            "duration"=>$duration,
            "start"=>$start,
            "end"=>$end,
        ]
    );

//      $cids = $req->cid;
//     foreach($cids as $cid){

//     DB::table("buildingg_contractor")->insert([
//         "building_id"=>$req->id,
//         "contractor_id"=>$bid
//     ]);
// }
}      
catch (\Exception $e) { 
    return Redirect()->back()->with('warning',' Thiếu thống tin !');;
               }


        return redirect()->back()->with('notification',' Đã thêm hạng mục thành công');
}

public function insertLoop($oid,$nid){
   $task_total = DB::table("building_job")->where("id",$oid)->first();
 $tasks =  DB::table("building_job")->where("level","like",$task_total->level.".%")->where("level","not like",$task_total->level.".%.%")
    ->where("project_id",$task_total->project_id)
    ->get();
    $i = 1;
    foreach($tasks as $task){
        $tid =   DB::table("buildingg")->insertGetId(
        [
            "stt"=>$i,
            "project_id"=>$task_total->project_id,
            "root_id"=>$nid,
            "last_id"=>$nid,
            "title"=>$task->name,
            "duration"=>$task->duration,
            "start"=>$task->start,
            "end"=>$task->end,
        ]
    );

        $this->insertLoop( $task->id,$tid);
        $i = $i+1;
    }



}


public function conSelect($id){
      $contractors = DB::table("contractors")->get();

    $selected = DB::table("buildingg_contractor")->where("building_id",$id)->pluck('contractor_id')->toArray();
    return json_encode([$contractors,$selected]);
}

public function convertDB($id){


    $task_total = DB::table("building_job")->where("level",0)->where("project_id",$id)->first();

    // $bid = DB::table("buildingg")->insertGetId(
    //     [
    //         "stt"=>1,
    //         "project_id"=>$task_total->project_id,
    //         "title"=>$task_total->name,
    //         "des"=>"",
    //         "duration"=>$task_total->duration,
    //         "start"=>$task_total->start,
    //         "end"=>$task_total->end,
    //     ]
    // );


    $tasks =  DB::table("building_job")
    ->where("level","<>",0)
    ->where("level","not like","%.%")->where("project_id",$id)->get();
// dd($tasks);
    $i =1;
    foreach($tasks as $task){
        $tid =   DB::table("buildingg")->insertGetId(
        [
            "stt"=>$i,
            "project_id"=>$task->project_id,
            "root_id"=>0,
            "last_id"=>0,
            "title"=>$task->name,
            "duration"=>$task->duration,
            "start"=>$task->start,
            "end"=>$task->end,
        ]
    );

        $this->insertLoop($task->id,$tid);
        $i =$i +1;
    }
}

public function deleteStep($id){
     if(!$this->checkLead()){
        return redirect("/");
      }

    DB::table("buildingg")->where("id",$id)->delete();


        return redirect()->back()->with('notification',' Đã xóa tệp thành công');
}


public function getSubAsJson($id){

   $data = DB::table("buildingg")->where("last_id",$id)->get();

   return json_encode($data);
}


  public function taskInfo($id){
 if(!$this->checkContributeMap()){
        return redirect("/");
      }
  
    $task = DB::table("building_job")->where("id",$id)->first();

    return json_encode($task);
  }


    public function processInfo($id){
 if(!$this->checkContributeMap()){
        return redirect("/");
      }
  
    $level = DB::table("building_job")->where("id",$id)->first()->level;
    $percent = DB::table("building_job")->where("id",$id)->first()->real_percent;

    $check_flag = DB::table("building_job")->where("level","<>",0)->where("level","like",$level.".%")->where("level","not like",$level.".%.%")->count();



    return json_encode([$percent,$check_flag]);
  }



  public function task($preid,$id){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }

  
    $task_total = DB::table("building_job")->where("id",$id)->first();


    $task =  DB::table("building_job")->where("level","like",$task_total->level.".%")->where("level","not like",$task_total->level.".%.%")
    ->where("project_id",$task_total->project_id)
    ->get();
    // dd($task_total->level);
    $task_check =  DB::table("building_job")->where("level","like",$task_total->level.".%.%")
    ->where("project_id",$task_total->project_id)->count();

    $file =  DB::table("building_job")->where("level","like",$task_total->level.".%")
    ->where("project_id",$task_total->project_id)->count();
    // dd($file);
    $display_type = 1;
    if($file == 0){
    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);
$files = DB::table("contribute_taskfile")
    ->leftJoin('contribute_taskfile_tags', 'contribute_taskfile.id', '=', 'contribute_taskfile_tags.file_id')
    ->leftJoin('tags', 'contribute_taskfile_tags.tag_id', '=', 'tags.id')
    ->select("contribute_taskfile.name as name"
      ,"contribute_taskfile.id as id","contribute_taskfile.type as type","contribute_taskfile.url as url"
      ,"contribute_taskfile.type as type"
      ,"contribute_taskfile.created_at as time"
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_taskfile.id')
            ->where("contribute_taskfile.project_id",$id)
            ->get();
            // dd($files[0]->tags);
        // dd("????");
        return view('building.tfile',compact("display_type","task_total",'files',"preid","id","tags"));

    }




    $first = DB::table('building_job')->where("level","like",$task_total->level.".%")->where("level","not like",$task_total->level.".%.%")
    ->where("project_id",$task_total->project_id)->min('start');

    $duration = DB::table('building_job')->where("level","<>",0)->where("level","like",$task_total->level.".%")->where("level","not like",$task_total->level.".%.%")
    ->where("project_id",$task_total->project_id)->max('duration');

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


  $task_ids = DB::table('building_job')->where("level","like",$task_total->level.".%")
  ->orWhere("level",$task_total->level)
    ->where("project_id",$task_total->project_id)->pluck('id')->toArray();

$contribute_all = DB::table("building_history")
->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
->leftJoin('users', 'users.id', '=', 'building_history.user_id')
->select("users.name as uname","building_history.id as id","building_history.description as des"
  ,"building_job.name as name","building_job.level as level","building_job.start as start"
  ,"building_history.updated_at as updated_at")
->whereIn("building_job.id",$task_ids)
->get();


   $contracts =  DB::table("buiding_contract")
->leftJoin('contractors', 'contractors.id', '=', 'buiding_contract.contractor_id')
->select("buiding_contract.name as name","buiding_contract.id as id","buiding_contract.doc as doc","buiding_contract.mpp as mpp","buiding_contract.amount as amount"
  ,"contractors.name as cname","contractors.proxy as proxy"
  ,"contractors.phone as phone"

)->where("buiding_contract.project_id",$task_total->project_id)
   ->get();


   $contractors = DB::table("contractors")->get();
$notes = DB::table("building_history")
->where("building_history.task_id",$id)->get();
   // $contractors = DB::table("contractors")->get();
    return view('building.file',compact('preid','display_type','task_total',"task",'id',"tags","contractors","contracts","task_check",
      "duration","first","contribute_all","notes"));

  }

  function editTask(Request $request){

      

     DB::table('building_job')
              ->where('id', $request->id)
              ->update(['name' => $request->name,
                'note'=>$request->note]);
  
 return Redirect()->back()->with('notification',' Đã cập nhật thông tin thành công !');

}
    
      public function editPayment($id){
 if(!$this->checkContributeMap()){
        return redirect("/");
      }
  
    $level = DB::table("building_job")->where("id",$id)->first()->level;

    $check_flag = DB::table("building_job")->where("level","<>",0)->where("level","like",$level.".%")->where("level","not like",$level.".%.%")->count();

      $real_percent = DB::table("building_job")->where("id",$id)->first()->real_percent;
      if ($real_percent > 99){
    if($check_flag  < 1){
       DB::table("building_job")->where("id",$id)->update(["payment_status"=>1,"payment_percent"=>100]);
     
         $task =  DB::table('building_job')
              ->where('id', $id)->first();
        // dd($task);
    $level = $task->level;
    $pid = $task->project_id;
    $level = explode(".",$level);
      // dd($level);
if(count($level) == 3){

 $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".".$level[1].".%")
 ->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      $paycount = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->where("payment_status",1)->count();

      
      $final_percent = round(floatval($paycount)*100/$count,2);
       DB::table('building_job')
       ->where("level",$level[0].".".$level[1])
       ->where("project_id",$pid)
       ->update(['payment_percent' => $final_percent]);




 $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      foreach ($list_jobs as $job) {
        $final_percent = $final_percent + $job->payment_percent;

      }
      $final_percent = round(floatval($final_percent)/$count,2);

       DB::table('building_job')
       ->where("level",$level[0])
       ->where("project_id",$pid)
       ->update(['payment_percent' => $final_percent]);

    }elseif(count($level) == 2){
      // dd($level);
      $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;

      $paycount = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->where("payment_status",1)->count();

      
      $final_percent = round(floatval($paycount)*100/$count,2);
      // dd($final_percent);

       DB::table('building_job')
       ->where("level",$level[0])
       ->where("project_id",$pid)
       ->update(['payment_percent' => $final_percent]);

    }


  $list_jobs =  DB::table("building_job")->where("level","<>",0)->where("level","not like","%.%")->where("project_id",$pid)->get();
      $count =  DB::table("building_job")->where("level","<>",0)->where("level","not like","%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      foreach ($list_jobs as $job) {
        $final_percent = floatval($final_percent) + $job->payment_percent;

      }
      $final_percent = round(floatval($final_percent)/$count,2);
    
      // dd($final_percent);
       DB::table('building_job')
       ->where("level",0)
       ->where("project_id",$pid)
       ->update(['payment_percent' => $final_percent]);

    }
  }

    if($check_flag  > 0 || $real_percent < 99){
      return redirect()->back()->with("warning","Chỉ có thể nghiệm thu khi tiến độ thực tế hoàn thành");
    }else{
        return redirect()->back()->with("notification","Đã cập nhật thanh toán thành công");
    }
  }

    
      public function editAcceptance($id){
 if(!$this->checkContributeMap()){
        return redirect("/");
      }
  
    $level = DB::table("building_job")->where("id",$id)->first()->level;

    $check_flag = DB::table("building_job")->where("level","<>",0)->where("level","like",$level.".%")->where("level","not like",$level.".%.%")->count();

      $real_percent = DB::table("building_job")->where("id",$id)->first()->real_percent;
      if ($real_percent > 99){
    if($check_flag  < 1){
       DB::table("building_job")->where("id",$id)->update(["acceptance_status"=>1,"acceptance_percent"=>100]);
     
         $task =  DB::table('building_job')
              ->where('id', $id)->first();
        // dd($task);
    $level = $task->level;
    $pid = $task->project_id;
    $level = explode(".",$level);
      // dd($level);
if(count($level) == 3){

 $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".".$level[1].".%")
 ->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      $paycount = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->where("acceptance_status",1)->count();

      
      $final_percent = round(floatval($paycount)*100/$count,2);
       DB::table('building_job')
       ->where("level",$level[0].".".$level[1])
       ->where("project_id",$pid)
       ->update(['acceptance_percent' => $final_percent]);




 $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      foreach ($list_jobs as $job) {
        $final_percent = $final_percent + $job->acceptance_percent;

      }
      $final_percent = round(floatval($final_percent)/$count,2);

       DB::table('building_job')
       ->where("level",$level[0])
       ->where("project_id",$pid)
       ->update(['acceptance_percent' => $final_percent]);

    }elseif(count($level) == 2){
      // dd($level);
      $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;

      $paycount = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->where("acceptance_status",1)->count();

      
      $final_percent = round(floatval($paycount)*100/$count,2);
      // dd($final_percent);

       DB::table('building_job')
       ->where("level",$level[0])
       ->where("project_id",$pid)
       ->update(['acceptance_percent' => $final_percent]);

    }


  $list_jobs =  DB::table("building_job")->where("level","<>",0)->where("level","not like","%.%")->where("project_id",$pid)->get();
      $count =  DB::table("building_job")->where("level","<>",0)->where("level","not like","%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      foreach ($list_jobs as $job) {
        $final_percent = floatval($final_percent) + $job->acceptance_percent;

      }
      $final_percent = round(floatval($final_percent)/$count,2);
    
      // dd($final_percent);
       DB::table('building_job')
       ->where("level",0)
       ->where("project_id",$pid)
       ->update(['acceptance_percent' => $final_percent]);

    }
  }

    if($check_flag  > 0 || $real_percent < 99){
      return redirect()->back()->with("warning","Chỉ có thể nghiệm thu khi tiến độ thực tế hoàn thành");
    }else{
        return redirect()->back()->with("notification","Đã cập nhật thanh toán thành công");
    }
  }

  function editDetailProcess(Request $request){

     DB::table('buildingg')
              ->where('id', $request->id)
              ->update([

                'real_percent' => $request->real_percent,
                'payment_percent' => $request->payment_percent,
                'acceptance_percent' => $request->acceptance_percent


            ]);
 return Redirect()->back()->with('notification',' Đã cập nhật thông tin thành công !');
  }

  function editProcess(Request $request){

      // dd($request->real_percent);
    // dd($request->id);
     DB::table('building_job')
              ->where('id', $request->id)
              ->update(['real_percent' => $request->real_percent]);
  
      // dd("done");
     $task =  DB::table('building_job')
              ->where('id', $request->id)->first();
    $level = $task->level;
    $pid = $task->project_id;
    $level = explode(".",$level);
    if(count($level) == 3){

 $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".".$level[1].".%")
 ->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      foreach ($list_jobs as $job) {
        $final_percent = $final_percent + $job->real_percent;

      }
      $final_percent = round($final_percent/$count,2);

       DB::table('building_job')
       ->where("level",$level[0].".".$level[1])
       ->where("project_id",$pid)
       ->update(['real_percent' => $final_percent]);




 $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      foreach ($list_jobs as $job) {
        $final_percent = $final_percent + $job->real_percent;

      }
      $final_percent = round(floatval($final_percent)/$count,2);

       DB::table('building_job')
       ->where("level",$level[0])
       ->where("project_id",$pid)
       ->update(['real_percent' => $final_percent]);

    }elseif(count($level) == 2){
      // dd($level[0]);
      $list_jobs = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->get();
      $count = DB::table('building_job')->where("level","<>",0)->where("level","like",$level[0].".%")->where("level","not like",$level[0].".%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      foreach ($list_jobs as $job) {
        $final_percent = floatval($final_percent) + $job->real_percent;

      }
      $final_percent = round(floatval($final_percent)/$count,2);
    

       DB::table('building_job')
       ->where("level",$level[0])
       ->where("project_id",$pid)
       ->update(['real_percent' => $final_percent]);

    }


  $list_jobs =  DB::table("building_job")->where("level","<>",0)->where("level","not like","%.%")->where("project_id",$pid)->get();
      $count =  DB::table("building_job")->where("level","<>",0)->where("level","not like","%.%")->where("project_id",$pid)->count();
      $final_percent = 0;
      foreach ($list_jobs as $job) {
        $final_percent = floatval($final_percent) + $job->real_percent;

      }
      $final_percent = round(floatval($final_percent)/$count,2);
    
      // dd($final_percent);
       DB::table('building_job')
       ->where("level",0)
       ->where("project_id",$pid)
       ->update(['real_percent' => $final_percent]);

 return Redirect()->back()->with('notification',' Đã cập nhật thông tin thành công !');

}
    

// function DeleteFile($id){
//   if(!$this->checkLead()){
//         return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
// }

//         $name = DB::table("contribute_file")->where("id",$id)->first()->name;
//         // dd("tight");
//        DB::table("contribute_file")->where("name",$name)->delete();
//           DB::table('contribute_file_tags')
//               ->where('file_id', $id)->delete();

//  return Redirect()->back()->with('notification',' Đã xóa tệp tin thành công !');

// }



  public function addHistory(Request $request)
    {
       if(!$this->checkMap()){
        return redirect("/");
      }
      
        // if ($request->file == null){
        //    return Redirect()->back()->with('warning', 'Chưa có tệp tải lên');
        // }
      // $image = $request->file('file');;

      // $img = Image::make($image->getRealPath());

      // $img = $request->file;
      $id =  $request->id;
      $des = $request->note;

// try{

      // dd($request);
        $his_id = DB::table("building_history")->insertGetId([
                  "description"=>$des,
                  "start"=>$request->date,
                  "end"=>$request->date,
                  "machine"=>$request->machine,
                  "lead"=>$request->lead,
                  "worker"=>$request->worker,
                  "input"=>$request->input,
                  "acceptance"=>$request->accept,
                  "vstm"=>$request->vstm,
                  "detail"=>$request->detail,
                  "task_id"=>$request->task_id,
                  "user_id"=>Auth()->user()->id
        ]);

   $templateFile = '../storage/app/word_template/tc.docx';


    $templateObject = new TemplateProcessor($templateFile);
    \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(false);

    $parser = new \HTMLtoOpenXML\Parser();


    $date = explode("-", $request->date);

      $templateObject->setValue('day', $date[2]);
      $templateObject->setValue('month', $date[1]);
      $templateObject->setValue('year', $date[0]);


    $weather = DB::table("weather")->where("start",$request->date)->count();
    // dd($weather);
    if($weather <= 0){
      $weatherStr = "Tổng quan : Nắng,nóng, Nhiệt độ từ 23*C đến 30*C, độ ẩm không khí 30%";
    }else{

    $weather = DB::table("weather")->where("start",$request->date)->first();
      $weatherStr = "Tổng quan : ".$weather->des.", Nhiệt độ từ ".$weather->low."*C đến ".$weather->high."*C, độ ẩm không khí ".$weather->humidity."%";
    }
        $templateObject->setValue('weather', $weatherStr);
      print($request->machine);
      $str = (preg_replace('#</[^>]+>#', ', ', $request->machine));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = (preg_replace('#, ,#', '', $str));
      $str =  rtrim($str, ", ");
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
     
      $templateObject->setValue('machine', $str);
      $templateObject->setValue('lead', $request->lead);
      $templateObject->setValue('worker', $request->worker);
      // dd($request->vstm);
      if($request->vstm == 1){
        $vsmtStr = "TỐT";
      }elseif($request->vstm == 2){
        $vsmtStr = "BÌNH THƯỜNG";
      }else{
        $vsmtStr = "KÉM";

      }
      $templateObject->setValue('vsmt', $vsmtStr);


       $str = (preg_replace('#</[^>]+>#', ', ', $request->note));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);

      $str =  rtrim($str, ", ");
      $templateObject->setValue('note', $str);

       $str = (preg_replace('#</[^>]+>#', ', ', $request->input));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
      $str =  rtrim($str, ", ");


      $templateObject->setValue('input', $str);

      $str = (preg_replace('#</[^>]+>#', ', ', $request->accept));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
      $str =  rtrim($str, ", ");

      $templateObject->setValue('accept', $str);

      $str = (preg_replace('#</[^>]+>#', ', ', $request->detail));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
      $str =  rtrim($str, ", ");

      $templateObject->setValue('detail', $str);



\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
    $wordDocumentFile = $templateObject->saveAs("../storage/app/nhatki/".$request->task_id."-".$his_id.".docx");


        DB::table("building_history_tag")->insert([
                  "history_id"=>$his_id,
                  "tag_id"=>11,
        ]);

         DB::table("building_history_tag")->insert([
                  "history_id"=>$his_id,
                  "tag_id"=>26,
        ]);

         DB::table("building_history_tag")->insert([
                  "history_id"=>$his_id,
                  "tag_id"=>27,
        ]);

   
      try{
foreach ($request->file as $file) {
      $path = $file->store('contribute');
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

      // dd($path);


        $his_id = DB::table("building_history_img")->insertGetId([
                  "history_id"=>$his_id,
                  "url"=>$url,
                  "url_small"=>"/storage/public/".$temp
        ]);



      // $new_history = new Historyzone();
      // $new_history->zone_id = $id;
      // $new_history->url = $url;
      // $new_history->description = $des;
      // $new_history->save();

          
      // $destinationPath = public_path().'/js-css/img/history/';

      // $request->file->move($destinationPath,'zone'.$id.'_'.$new_history->id.'.jpg');


      // Historyzone::where('id', $new_history->id)->update([
      //       'url' => $url
      //   ]);

    //      $templateFile = '../storage/app/word_template/tc.docx';
    // $templateObject = new TemplateProcessor($templateFile);

    //   $templateObject->setValue('note', $des);


    // $wordDocumentFile = $templateObject->saveAs("../storage/app/nhatki/test.docx");

}
   }
catch (\Exception $e) { 
         return back()->with('notification', 'Đã cập nhật nhật ký');;
        
              }
  
         return back()->with('notification', 'Đã cập nhật nhật ký');;
    
        // event($e = new RedisEvent($request->all()));

      // $image->move($destinationPath.'');
      // return "true";
  }

   public function editHistory(Request $request)
    {
       if(!$this->checkMap()){
        return redirect("/");
      }
      
      $id =  $request->id;
      $des = $request->note;

// try{

      // dd($id);
         DB::table("building_history")->where("id",$request->id)->update([
                  "description"=>$des,
                  "machine"=>$request->machine,
                  "lead"=>$request->lead,
                  "worker"=>$request->worker,
                  "input"=>$request->input,
                  "acceptance"=>$request->accept,
                  "vstm"=>$request->vstm,
                  "detail"=>$request->detail,
                  "task_id"=>$request->task_id,
                  "user_id"=>Auth()->user()->id
        ]);


     

         $templateFile = '../storage/app/word_template/tc.docx';


    $templateObject = new TemplateProcessor($templateFile);
    \PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(false);

    $parser = new \HTMLtoOpenXML\Parser();

    $his = DB::table("building_history")->where("id",$request->id)->first();
    
     $start= $his->start;

    $date = explode("-", $start);

      $templateObject->setValue('day', $date[2]);
      $templateObject->setValue('month', $date[1]);
      $templateObject->setValue('year', $date[0]);


    $weather = DB::table("weather")->where("start",$start)->count();
    // dd($weather);
    if($weather <= 0){
      $weatherStr = "Tổng quan : Nắng,nóng, Nhiệt độ từ 23*C đến 30*C, độ ẩm không khí 30%";
    }else{

    $weather = DB::table("weather")->where("start",$start)->first();
      $weatherStr = "Tổng quan : ".$weather->des.", Nhiệt độ từ ".$weather->low."*C đến ".$weather->high."*C, độ ẩm không khí ".$weather->humidity."%";
    }
      $templateObject->setValue('weather', $weatherStr);
      print($request->machine);
      $str = (preg_replace('#</[^>]+>#', ', ', $request->machine));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = (preg_replace('#, ,#', '', $str));
      $str =  rtrim($str, ", ");
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
     
      $templateObject->setValue('machine', $str);
      $templateObject->setValue('lead', $request->lead);
      $templateObject->setValue('worker', $request->worker);
      // dd($request->vstm);
      if($request->vstm == 1){
        $vsmtStr = "TỐT";
      }elseif($request->vstm == 2){
        $vsmtStr = "BÌNH THƯỜNG";
      }else{
        $vsmtStr = "KÉM";

      }
      $templateObject->setValue('vsmt', $vsmtStr);


       $str = (preg_replace('#</[^>]+>#', ', ', $request->note));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);

      $str =  rtrim($str, ", ");
      $templateObject->setValue('note', $str);

       $str = (preg_replace('#</[^>]+>#', ', ', $request->input));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
      $str =  rtrim($str, ", ");


      $templateObject->setValue('input', $str);

      $str = (preg_replace('#</[^>]+>#', ', ', $request->accept));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
      $str =  rtrim($str, ", ");

      $templateObject->setValue('accept', $str);

      $str = (preg_replace('#</[^>]+>#', ', ', $request->detail));
      $str = (preg_replace('#<[^>]+>#', '', $str));
      $str = str_replace('&nbsp;', '', $str);
      $str = iconv(mb_detect_encoding($str, mb_detect_order(), true), "UTF-8", $str);
      $str =  rtrim($str, ", ");

      $templateObject->setValue('detail', $str);




\PhpOffice\PhpWord\Settings::setOutputEscapingEnabled(true);
       $wordDocumentFile = $templateObject->saveAs("../storage/app/nhatki/".$request->task_id."-".$request->id.".docx");
   
      try{
foreach ($request->file as $file) {
      $path = $file->store('contribute');
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

      // dd($path);


        $his_id = DB::table("building_history_img")->insertGetId([
                  "history_id"=>$request->id,
                  "url"=>$url,
                  "url_small"=>"/storage/public/".$temp
        ]);



      // $new_history = new Historyzone();
      // $new_history->zone_id = $id;
      // $new_history->url = $url;
      // $new_history->description = $des;
      // $new_history->save();

          
      // $destinationPath = public_path().'/js-css/img/history/';

      // $request->file->move($destinationPath,'zone'.$id.'_'.$new_history->id.'.jpg');


      // Historyzone::where('id', $new_history->id)->update([
      //       'url' => $url
      //   ]);
}
   }
catch (\Exception $e) { 
         return back()->with('notification', 'Đã cập nhật nhật ký');;
        
              }
  
         return back()->with('notification', 'Đã cập nhật nhật ký');;
    
        // event($e = new RedisEvent($request->all()));

      // $image->move($destinationPath.'');
      // return "true";
  }


 public function addContract(Request $request)
    {
       if(!$this->checkMap()){
        return redirect("/");
      }
      // dd($request->file0);

      $path = $request->file0->store('contribute');
      $url1 = Storage::url($path);

      $path = $request->file2->store('contribute');
      $url2 = Storage::url($path);

      // dd($path);
      if($request->contractor > 0){
     DB::table("contractors")->where('id', $request->contractor)->update([
            'name' => $request->cname,
            'proxy' => $request->proxy,
            'phone' => $request->phone
        ]);
     $contractor = $request->contractor;
      }else{

        $contractor= DB::table("contractors")->insertGetId([
            'name' => $request->cname,
            'proxy' => $request->proxy,
            'phone' => $request->phone
        ]);
      }

        $his_id = DB::table("buiding_contract")->insertGetId([
                  "contractor_id"=>$contractor,
                  "project_id"=>$request->project_id,
                  "name"=>$request->name,
                  "amount"=>$request->amount,
                  "doc"=>$url1,
                  "mpp"=>$url2
        ]);



    
  
         return back()->with('notification', 'Đã cập nhật hợp đồng');;
    
  }

  
 function editTaskFile(Request $request){
    $title = $request->title;
    // dd($request->all());

    $tagArr = [];

    $tags = explode(",", $request->tags);

    foreach ($tags as $tag) {
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

  try{
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);



       $fid = DB::table("contribute_taskfile")->insertGetId([
            'url' => $url,
            'type' => 2,
            'user_id' => Auth()->user()->id,
            'name'=>$title,
            'project_id'=>$request->id
        ]);

  foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_taskfile_tags")->insert([
            'file_id' => $fid,
            'tag_id' => $tag

        ]);
       }

      }

      }


      
catch (\Exception $e) { 
    return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
               }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}
  function editTaskFileName(Request $request){

      $tagArr = [];

    $tags = explode(",", $request->tags);

    foreach ($tags as $tag) {
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

     DB::table('contribute_taskfile')
              ->where('id', $request->id)
              ->update(['name' => $request->title]);
    // dd($request->id);
     DB::table('contribute_taskfile_tags')
  ->where('file_id', $request->id)->delete();
  foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_taskfile_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
       }


 return Redirect()->back()->with('notification',' Đã sửa tệp tin thành công !');

}
    


function deleteTaskFile($id){
  if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}

       DB::table("contribute_taskfile")->where("id",$id)->delete();
          DB::table('contribute_taskfile_tags')
              ->where('file_id', $id)->delete();

 return Redirect()->back()->with('notification',' Đã xóa tệp tin thành công !');

}


 function pinMess($id){
    // dd("????");
    $message = DB::table('building_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("building_messages")->where("id",$id)->update(["pin"=>1]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    
    // }else{
    //             return redirect("/");

    // }
  }
function unpinMess($id){
    $message = DB::table('building_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("building_messages")->where("id",$id)->update(["pin"=>0]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }




   function saveMess($id){
    // dd("123");
    $message = DB::table('building_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    if(strlen($message->attachment) > 0){
    DB::table("building_messages")->where("id",$id)->update(["storage"=>1]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
     }
      return Redirect()->back()->with('warning',' Minh chứng buộc phải có tệp đính kèm!');

    // }else{
    //             return redirect("/");

    // }
  }
function unsaveMess($id){
    $message = DB::table('building_messages')->where("id",$id)->first();
    // if($message->user_id == Auth()->user()->id){
    DB::table("building_messages")->where("id",$id)->update(["storage"=>0]);
         return Redirect()->back()->with('notification',' Đã thêm tin nhắn vào mục ghi nhớ!');
    // }else{
    //             return redirect("/");

    // }
  }


  public function warehouseJob($id){
    $type = 1;

    $delete_route = "file-delete-only";

    $cv = DB::table("building_files")->where("build_id",$id)
    ->leftJoin('building_file_tags', 'building_files.id', '=', 'building_file_tags.file_id')
    ->leftJoin('tags', 'building_file_tags.tag_id', '=', 'tags.id')
    ->select("building_files.name as name","building_files.created_at as created_at"
        ,"building_files.id as id","building_files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
        ,DB::raw("count(DISTINCT building_files.id) as num")
)
    ->groupBy('building_files.name')
    ->where("building_files.type",$type)
    ->get();



    $tag_groups = DB::table("tag_group")->get();
     $tag_groups_arr = [];
    foreach($tag_groups as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(";",DB::table("tags")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
        $tag_groups_arr[$tag->id]=$data;
    }


    return view('building.warehouse',compact("id","delete_route",'cv',"tag_groups_arr","type"));

  }



   public function warehouseDetail($root_id,$id){

    $total_file = DB::table("building_files")->where("id",$id)->first();
    $files = DB::table("building_files")->where("name",$total_file->name)->get();
    return view('building.warehouse_detail', compact('total_file','files',"id","root_id"));
   }

   public function warehouse($id){
    $type = 0;
    $delete_route = "file-delete";

    $build = DB::table("buildingg")
    ->where("id",$id)->first();
    $build_arr = DB::table("buildingg")
    ->where("root_id",$id)
    ->orWhere("last_id",$id)
    ->orWhere("id",$id)
    ->pluck("id")->toArray();

    $cv = DB::table("building_files")->whereIn("build_id",$build_arr)
    ->leftJoin('building_file_tags', 'building_files.id', '=', 'building_file_tags.file_id')
    ->leftJoin('tags', 'building_file_tags.tag_id', '=', 'tags.id')
    ->select("building_files.name as name","building_files.created_at as created_at"
        ,"building_files.id as id","building_files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
        ,DB::raw("count(DISTINCT building_files.id) as num")
)
    ->groupBy('building_files.name')
    ->where("building_files.type",$type)
    ->get();



    $tag_groups = DB::table("tag_group")->get();
     $tag_groups_arr = [];
    foreach($tag_groups as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(";",DB::table("tags")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
        $tag_groups_arr[$tag->id]=$data;
    }


    return view('building.warehouse',compact("id","delete_route",'build','cv',"tag_groups_arr","type"));

  }

   function addFile(Request $request){
  $root_file = DB::table("building_files")->where("id",$request->root_id)->first();

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


       $fid = DB::table("building_files")->insertGetId([
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
            'type' => 0,
            'user_id' => Auth()->user()->id,
            'name'=>$root_file->name,
            'origin_name'=>$file_name,
        ]);
       // dd($fid);
        $building = $this->getLead();
       // print_r($lead)

              foreach ($building as $buil) {
                DB::table('building_noti')->insert([
                'event_id' => $file_id,
                'user_id' => $lid
            ]);
            }

      }
     return Redirect()->back()->with('warning',' Đã thêm tệp tin thành công !');

}

function DeleteFile($id){
    $bf = DB::table("building_files")->where("id",$id)->first();
    DB::table("building_files")->where("name",$bf->name)->delete();
     return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}

function DeleteFileById($root_id,$id){
    $name = DB::table("building_files")->where("id",$id)->first()->name;
    $bf = DB::table("building_files")->where("id",$id)->delete();

    $new_id = DB::table("building_files")->where("name",$name)->first()->id;
    return Redirect("building/warehouse/detail/".$root_id."/".$new_id)->with('warning',' Đã xóa tệp tin thành công !');

    // return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}



function DeleteFileOnly($id){
        if(!$this->checkLead()){
            $allow_list = [28,198,180,179,189];
            if(!in_array(Auth()->user()->id, $allow_list)){

             return Redirect()->back()->with('warning',' Bạn không có quyền thực hiện hành động này !');
            }
      }

    
    $bf = DB::table("building_files")->where("id",$id)->first();
    DB::table("building_files")->where("name",$bf->name)->delete();

    return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}


 function editFile(Request $request){

         if(!$this->checkHuman()){
        return redirect("/");
      }


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
    }




    $title = $request->title;
    // dd($request->all());
  $i = DB::table("files")->where("project_id",$request->id)->count();
  // try{
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if($request->title == null){
        $title = $file->getClientOriginalName();
      }
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);

      $i = $i +1;

      $file_id =  DB::table("building_files")->insertGetId([
            'build_id' => $request->id,
            'origin_name' => $file->getClientOriginalName(),
            'url' => $url,
            'name'=>$title,
            'type'=>$request->type
        ]);


        DB::table('building_file_tags')
              ->where('file_id', $file_id)->delete();


              foreach ($tagArr as $tag) {
         # code...
       DB::table("building_file_tags")->insert([
            'file_id' => $file_id,
            'tag_id' => $tag

        ]);
       }

     



        // print_r($return);
        $building = $this->getLead();
       // print_r($lead)

              foreach ($building as $buil) {
                DB::table('building_noti')->insert([
                'event_id' => $file_id,
                'user_id' => $buil
            ]);
            }
       // $lead = $this->getLead();
       // print_r($lead)

            //   foreach ($lead as $lid) {
            //     DB::table('file_noti')->insert([
            //     'event_id' => $file_id,
            //     'user_id' => $lid
            // ]);
            // }
      }


//         }
// catch (\Exception $e) { 
//     return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
//                }

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
    }

    if($request->file == null){


     DB::table('building_files')
              ->where('id', $request->id)
              ->update(['name' => $request->title]);
    }else{
        $file =$request->file[0];
       $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);


    DB::table('building_files')
              ->where('id', $request->id)
              ->update(['name' => $request->title,'url' => $url]);

    }

 DB::table('building_file_tags')
->where('file_id',$request->id)->delete();


              foreach ($tagArr as $tag) {
         # code...
       DB::table("building_file_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
       }


 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}
    


public function mergeSelectPdf($id){
    // dd($_COOKIE['cv_temp']);
    if(!isset($_COOKIE['cv_temp'])){
        return redirect()->back()->with('warning',' Không đọc từ từ khóa');

    }
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

    // $process_name = DB::table("process")->where("id",$id)->first()->name;
    // dd($process_name);
       $files = DB::table("building_files")
    ->leftJoin('building_file_tags', 'building_files.id', '=', 'building_file_tags.file_id')
    ->leftJoin('tags', 'building_file_tags.tag_id', '=', 'tags.id')
    ->select("building_files.name as name","building_files.created_at as created_at"
        ,"building_files.id as id","building_files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)
    ->where('build_id', $id)
    ->where('building_files.name',"like", "%".$_COOKIE['cv_temp']."%")
    ->orWhere('tags.name',"like", "%".$_COOKIE['cv_temp']."%")
    ->orderBy('building_files.name', 'desc')
    ->groupBy('building_files.id')

    ->get();
        // dd(count($files));

        $pdf = new \PDFMerger();
            foreach ($files  as $file) {
                // dd($file->url);
                try{

        if(strpos($file->url,".pdf") > 0 ){
        $url =  str_replace("/storage/","storage/app/",$file->url);
        $pdf->addPDF($path.$url,'all');
    }

        // break;
    }      catch (\Exception $e){
           continue;
        }
            }
     
                try{
        $pdf->merge('download', "HSPL.pdf");
         }      catch (\Exception $e){
            dd($e);
        return redirect()->back()->with('warning',' Đã có lỗi tệp tin, vui lòng liên hệ admin');

        }

        //         try{
        // $pdf->merge('download', "HSPL.pdf");
        //  } catch (Exception $ex) {
        //     dd($ex);
        // }

        return Redirect("/");
}



public function mergeAllPdf($id){
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

    // $process_name = DB::table("process")->where("id",$id)->first()->name;
    // dd($process_name);
       $files = DB::table("building_files")
                ->where('build_id', $id)
                ->orderBy('name', 'desc')->get();
        // dd(count($files));

                try{
        $pdf = new \PDFMerger();
            foreach ($files  as $file) {
                // dd($file->url);
                try{

        if(strpos($file->url,".pdf") > 0 ){
        $url =  str_replace("/storage/","storage/app/",$file->url);
                // dd($url);
        $pdf->addPDF($path.$url,'all');
    }

        // break;
    }      catch (\Exception $e){
           continue;
        }
            }
     
        $pdf->merge('download', "HSPL.pdf");
         }      catch (\Exception $e){
        return redirect()->back()->with('warning',' Đã có lỗi tệp tin, vui lòng liên hệ admin');

        }
        return Redirect("/");
}



public function mergeAllPdfTest($id){
     if(!$this->checkLead()){
        return redirect("/");
      }
    ini_set('memory_limit', '2048M');
        $path = "/var/www/html/ship/";

    // $process_name = DB::table("process")->where("id",$id)->first()->name;
    // dd($process_name);
       $files = DB::table("building_files")
                ->where('build_id', $id)
                ->orderBy('name', 'desc')->get();
        // dd(count($files));

        $pdf = new \PDFMerger();
        $i = 0;
            foreach ($files  as $file) {

                // dd($file->url);
                try{

        if(strpos($file->url,".pdf") > 0 ){

            // echo $file->url;echo "<br>";
        // if($i > 3){
        //     break;
        // }
        // if($i < 1){
        //     // echo $file->url;
        //     $i = $i +1;
        //     continue;
        // }
        $url =  str_replace("/storage/","storage/app/",$file->url);
                // dd($url);
        $pdf->addPDF($path.$url,'all');
        $i = $i +1;
    }
        // break;
    }      catch (\Exception $e){
           continue;
        }
            }
        // dd($i);

        try{
        $pdf->merge('download', "HSPL.pdf");
         } catch (\Exception $ex) {
            dd($ex);
        }
        // return Redirect("/");
}


}
