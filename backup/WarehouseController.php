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

class WarehouseController extends Controller
{	

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
    return view('warehouse.detail', compact('name','files'));
}
  public function dataAll(){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }


    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.name')->get();

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);

if($this->checkLead()){
     DB::table("warehouse_noti")->where("seen",0)->where("user_id",Auth()->user()->id)->update(["seen" =>1]);
  }


    $file = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url"
      ,"contribute_file.type as type"
      ,"contribute_file.created_at as time"
              ,DB::raw("count(DISTINCT contribute_file.id) as num")
              ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags")
    )

            ->groupBy('contribute_file.name')->get();

    $cv = DB::table("files")->get();

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

    // dd($job_files);

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

    return view('warehouse.fileall',compact("build_history",
      "tags","cv","zone_history","schedules","file",
      "schedule_files","schedule_attachment","schedule_subattachment"
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

    // dd($file);

    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


    return view('warehouse.fileall-img',compact('file',"tags"));

  }

     public function ImageList(){
         if(!$this->checkContributeMap()){
        return redirect("/");
      }
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
"schedule_messages.id as id",DB::raw('-1 as type'),"schedule_messages.attachment as url"
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


        $query = $query->union($process_file)->union($zone_file);
        ->union($schedule_attachment)
        ->union($schedule_files)
        ->union($schedule_subattachment);

    $file = $query->paginate(24);
    $menu = $query->paginate(24);


    $tags = DB::table("tags")->pluck('name')->toArray();
    $tags = json_encode($tags);


    return view('warehouse.img-list',compact('file',"tags","menu"));

  }

public function ImageListInput(Request $request){

    // dd("????");

         if(!$this->checkContributeMap()){
        return redirect("/");
      }
    // dd($request->type);
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
    print_r($tagArr);

    // dd($tags);

    print_r($tagArr);
    $file = "";
    foreach ($tagArr as $tag) {
      # code...


    $array = DB::table("contribute_file")
    ->leftJoin('contribute_file_tags', 'contribute_file.id', '=', 'contribute_file_tags.file_id')
    ->leftJoin('tags', 'contribute_file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('users', 'users.id', '=', 'contribute_file.user_id')
    ->select("users.name as uname","contribute_file.name as name"
      ,"contribute_file.id as id","contribute_file.type as type","contribute_file.url as url",
      "contribute_file.url_resize as url_resize","tags.id as tags"

    )

    ->where("tags.id",$tag)
    ->where(function($q) {
          $q->where("contribute_file.url","like","%.png%")
    ->orWhere("contribute_file.url","like","%.jpeg%")
    ->orWhere("contribute_file.url","like","%.jpg%");
  })
    ->distinct()->pluck('contribute_file.id')->toArray();
// dd($array);
 

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
     ->whereIn("contribute_file.id",$array);

$process_id =  DB::table("building_history")
->leftJoin('building_job', 'building_job.id', '=', 'building_history.task_id')
->leftJoin('building_history_tag', 'building_history_tag.history_id', '=', 'building_history.id')
->leftJoin('tags', 'building_history_tag.tag_id', '=', 'tags.id')
    ->where("tags.id",$tag)->distinct()->pluck('building_history.id')->toArray();

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


$zone_id =  DB::table("history_zone")
->leftJoin('history_zone_tag', 'history_zone_tag.history_id', '=', 'history_zone.id')
->leftJoin('tags', 'history_zone_tag.tag_id', '=', 'tags.id')
    ->where("tags.id",$tag)->distinct()->pluck('history_zone.id')->toArray();

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

     

    }

    
    
    }
    if($file ==""){
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


//   $job_moniters = DB::table("jobs")
//     ->Join('job_moniters', 'jobs.id', '=', 'job_moniters.jobs_id')
// ->leftJoin('job_tag', 'job_tag.history_id', '=', 'job_moniters.id')
// ->leftJoin('tags', 'job_tag.tag_id', '=', 'tags.id')
//      ->select("jobs.name as uname","job_moniters.content as name",
// "job_moniters.id as id",DB::raw('-1 as type'),"job_moniters.link as url"
//   ,"job_moniters.link as url_resize"
//               ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
//  ->groupBy('job_moniters.id')
//     ->where("job_moniters.link","like","%.png%")
//     ->orWhere("job_moniters.link","like","%.jpeg%")
//     ->orWhere("job_moniters.link","like","%.jpg%");


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


//     $schedule_attachment = DB::table("schedule_messages")
//     ->leftJoin('schedule_messages_tag', 'schedule_messages_tag.message_id', '=', 'schedule_messages.id')
//     ->leftJoin('tags', 'schedule_messages_tag.tag_id', '=', 'tags.id')
//     ->leftJoin('schedule', 'schedule.id', '=', 'schedule_messages.schedule_id')
//       ->leftJoin('users', 'users.id', '=', 'schedule_messages.user_id')
//       ->select("users.name as uname","schedule_messages.body as name",
// "schedule_messages.id as id",DB::raw('-1 as type'),"schedule_messages.attachment as url"
//   ,"schedule_messages.attachment as url_resize"
//               ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
//  ->groupBy('schedule_sub_messages.id')
//     ->where("schedule_sub_messages.attachment","<>", "NULL")
//     ->where("schedule_messages.attachment","like","%.png%")
//     ->orWhere("schedule_messages.attachment","like","%.jpeg%")
//     ->orWhere("schedule_messages.attachment","like","%.jpg%");

//     $schedule_subattachment = DB::table("schedule_sub_messages")
//     ->leftJoin('schedule_sub_messages_tag', 'schedule_sub_messages_tag.message_id', '=', 'schedule_sub_messages.id')
//     ->leftJoin('tags', 'schedule_sub_messages_tag.tag_id', '=', 'tags.id')
//       ->leftJoin('users', 'users.id', '=', 'schedule_sub_messages.user_id')
//       ->select("users.name as uname","schedule_sub_messages.body as name",
// "schedule_sub_messages.id as id",DB::raw('-1 as type'),"schedule_sub_messages.attachment as url"
//   ,"schedule_sub_messages.attachment as url_resize"
//               ,DB::raw("group_concat(tags.name SEPARATOR ', ') as tags"))
//  ->groupBy('schedule_sub_messages.id')
//     ->where("schedule_sub_messages.attachment","<>", "NULL")
//     ->where("schedule_sub_messages.attachment","like","%.png%")
//     ->orWhere("schedule_sub_messages.attachment","like","%.jpeg%")
//     ->orWhere("schedule_sub_messages.attachment","like","%.jpg%");



 // dd($zone_file->get() );
      $file = $query;
      if($process_file->count()> 0 ){
      $file = $file->union($process_file);
    }
      if($zone_file->count()> 0 ){
      $file = $file->union($zone_file);
    }

     
    //    if($schedule_files->count()> 0 ){
    //   $file = $file->union($schedule_files);
    // }

    //    if($schedule_attachment->count()> 0 ){
    //   $file = $file->union($schedule_attachment);
    // }

    //    if($schedule_subattachment->count()> 0 ){
    //   $file = $file->union($schedule_subattachment);
    // }



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
foreach ($request->file as $file) {
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

      // $img = Image::make($file)
      // ->resize(300, 300)->stream();



      // $path = Storage::disk('public')->put($temp, $img);


      $i = $i +1;

       $fid = DB::table("contribute_file")->insertGetId([
            'url' => $url,
            'url_resize' => "/storage/public/".$temp,
            'type' => $request->type,
            'user_id' => Auth()->user()->id,
            'name'=>$title,
            'project_id'=>$request->id
        ]);

       foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $fid,
            'tag_id' => $tag

        ]);
       }

      }


//         }
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

     DB::table('contribute_file')
              ->where('id', $request->id)
              ->update(['name' => $request->title,
            'type' => $request->type]);
    // dd($request->id);


       DB::table('contribute_file_tags')
              ->where('file_id', $request->id)->delete();
              foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
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

 

       DB::table('contribute_file_tags')
              ->where('file_id', $request->id)->delete();
              foreach ($tagArr as $tag) {
         # code...
       DB::table("contribute_file_tags")->insert([
            'file_id' => $request->id,
            'tag_id' => $tag

        ]);
       }
      



 return Redirect()->back()->with('notification',' Đã sửa tệp tin thành công !');

}
     


function DeleteFile($id){
  if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}

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
}