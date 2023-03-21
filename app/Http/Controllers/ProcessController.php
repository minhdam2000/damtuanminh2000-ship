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

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProcessController extends Controller
{	
   public function index(){
    $processes  = DB::table("process")->get();
    return view('process.index',compact('processes'));
  }

   public function project(){
    // $processes  = DB::table("process")->where("process.project_id",">",0)->get();

       $processes = DB::table("process")
     ->leftJoin('files', 'process.id', '=', 'files.project_id')
     ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
      ->select("process.id as id","process.name as name",
  DB::raw('sum(CASE WHEN file_noti.seen = 0 and file_noti.user_id = '.Auth()->user()->id.' THEN 1 ELSE 0 END) as noti'),
  DB::raw('count(*) as noti2')
    )
              ->groupBy("process.id")
              ->get();
// dd($processes);
    return view('process.project',compact('processes'));
  }

   public function view($index){


    $process  = DB::table("process")->where("id",$index)->first();
    $curstep_before = DB::table("process")->where("id",$index)->first()->curstep;
    // print_r(Auth()->user()->id);

    $user_cv1 = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)

    ->where("project_id",$index)
    ->where("file_noti.user_id",Auth()->user()->id)
    // ->groupBy("files.id")
    ->where("type",1)
    ->groupBy('files.id')->get();;

    $cv1_ids =  DB::table("files")
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"

)
    ->where("project_id",$index)
    ->where("file_noti.user_id",Auth()->user()->id)
    // ->groupBy("files.id")
    ->where("type",1)->pluck("files.id")->toArray();;
    // dd($cv1);

 $cv1 = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags"))->where("project_id",$index)
    ->where("type",1)
    ->whereNotIn("files.id", $cv1_ids)
    ->groupBy('files.id')->get();;
// dd($cv1);


   $user_cv2 = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")

)
    ->where("project_id",$index)
    ->where("file_noti.user_id",Auth()->user()->id)
    // ->groupBy("files.id")
    ->where("type",2)
    ->groupBy('files.id')->get();;

    $cv2_ids =  DB::table("files")
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at",
        "files.id as id","files.url as url","file_noti.seen as seen"

)
    ->where("project_id",$index)
    ->where("file_noti.user_id",Auth()->user()->id)
    // ->groupBy("files.id")
    ->where("type",2)->pluck("files.id")->toArray();;
    // dd($cv1);

 $cv2 = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->select("files.name as name"
        ,"files.created_at as created_at","files.id as id","files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags"))
    ->where("project_id",$index)
    ->where("type",2)
    ->whereNotIn("files.id", $cv2_ids)
    ->groupBy('files.id')->get();

    $check = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$index],
      ['step.state',0]])->count();
    if($check >0){
    $curstep = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$index],
      ['step.state',0]])->first()->step_id;
  }else{
    $curstep = -1;
  }

  $legal1 = DB::table("legal_process")->where("step_id",1)->where("root_id",0)->where("process_id",$index)->orderBy('stt', 'asc')->get();
  $legal2 = DB::table("legal_process")->where("step_id",2)->where("root_id",0)->where("process_id",$index)->orderBy('stt', 'asc')->get();
  $legal3 = DB::table("legal_process")->where("step_id",3)->where("root_id",0)->where("process_id",$index)->orderBy('stt', 'asc')->get();


  $legal1_full =  DB::table("legal_process")->where("step_id",1)
  ->where("root_id","<>",0)->where("process_id",$index)
    ->count();
 if($legal1_full > 0){
    $count = DB::table("legal_process")->where("step_id",1)->where("root_id","<>",0)->where("process_id",$index)
    ->where("status",1)->count();
    $legal1_percent = round($count / $legal1_full*100,2);
 }else{
    $legal1_percent = 0;
 }
 $legal2_full =  DB::table("legal_process")->where("step_id",2)
  ->where("root_id","<>",0)->where("process_id",$index)
    ->count();


 if($legal2_full > 0){
    $count = DB::table("legal_process")->where("step_id",2)->where("root_id","<>",0)->where("process_id",$index)
    ->where("status",1)->count();
    echo $count;
    $legal2_percent = round($count / $legal2_full*100,2);
 }else{
    $legal2_percent = 0;
 }


 $legal3_full =  DB::table("legal_process")->where("step_id",3)
  ->where("root_id","<>",0)->where("process_id",$index)
    ->count();


  if($legal3_full > 0){
    $count = DB::table("legal_process")->where("step_id",3)->where("root_id","<>",0)->where("process_id",$index)
    ->where("status",1)->count();
    $legal3_percent = round($count / $legal3_full*100,2);
 }else{
    $legal3_percent = 0;
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



  $legal_list =  DB::table("legal_process")
->select("id","stt")
->where("root_id",0)
->where("process_id",$index)->get();

    DB::table("file_noti")
    ->leftJoin("files","files.id","=","file_noti.event_id")
            ->where("file_noti.user_id", Auth()->user()->id)
            ->where("files.project_id",$index)->update(["seen"=>1]);

$tag_groups = DB::table("tag_group")->get();
     $tag_groups_arr = [];
    foreach($tag_groups as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(";",DB::table("tags")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
        $tag_groups_arr[$tag->id]=$data;
    }


    return view('process.view', compact('legal_list','index',"curstep","process","cv1","cv2","user_cv1","user_cv2"
                                        ,"legal1","legal2","legal3"
                                        ,"legal1_percent","legal2_percent","legal3_percent","tag_groups_arr"
                                        ));
  }


   public function viewbk($index){
   
    $process  = DB::table("process")->where("id",$index)->first();
    $curstep_before = DB::table("process")->where("id",$index)->first()->curstep;
    // print_r(Auth()->user()->id);

    $user_cv1 = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")
)

    ->where("project_id",$index)
    ->where("file_noti.user_id",Auth()->user()->id)
    // ->groupBy("files.id")
    ->where("type",1)
    ->groupBy('files.id')->get();;

    $cv1_ids =  DB::table("files")
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"

)
    ->where("project_id",$index)
    ->where("file_noti.user_id",Auth()->user()->id)
    // ->groupBy("files.id")
    ->where("type",1)->pluck("files.id")->toArray();;
    // dd($cv1);

 $cv1 = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags"))->where("project_id",$index)
    ->where("type",1)
    ->whereNotIn("files.id", $cv1_ids)
    ->groupBy('files.id')->get();;
// dd($cv1);


   $user_cv2 = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at"
        ,"files.id as id","files.url as url","file_noti.seen as seen"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags")

)
    ->where("project_id",$index)
    ->where("file_noti.user_id",Auth()->user()->id)
    // ->groupBy("files.id")
    ->where("type",2)
    ->groupBy('files.id')->get();;

    $cv2_ids =  DB::table("files")
    ->leftJoin('file_noti', 'files.id', '=', 'file_noti.event_id')
    ->select("files.name as name","files.created_at as created_at",
        "files.id as id","files.url as url","file_noti.seen as seen"

)
    ->where("project_id",$index)
    ->where("file_noti.user_id",Auth()->user()->id)
    // ->groupBy("files.id")
    ->where("type",2)->pluck("files.id")->toArray();;
    // dd($cv1);

 $cv2 = DB::table("files")
    ->leftJoin('file_tags', 'files.id', '=', 'file_tags.file_id')
    ->leftJoin('tags', 'file_tags.tag_id', '=', 'tags.id')
    ->select("files.name as name"
        ,"files.created_at as created_at","files.id as id","files.url as url"
        ,DB::raw("group_concat(distinct tags.name SEPARATOR ', ') as tags"))
    ->where("project_id",$index)
    ->where("type",2)
    ->whereNotIn("files.id", $cv2_ids)
    ->groupBy('files.id')->get();

    $check = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$index],
      ['step.state',0]])->count();
    if($check >0){
    $curstep = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$index],
      ['step.state',0]])->first()->step_id;
  }else{
    $curstep = -1;
  }

  $legal1 = DB::table("legal_process")->where("step_id",1)->where("root_id",0)->where("process_id",$index)->orderBy('stt', 'asc')->get();
  $legal2 = DB::table("legal_process")->where("step_id",2)->where("root_id",0)->where("process_id",$index)->orderBy('stt', 'asc')->get();
  $legal3 = DB::table("legal_process")->where("step_id",3)->where("root_id",0)->where("process_id",$index)->orderBy('stt', 'asc')->get();


  $legal1_full =  DB::table("legal_process")->where("step_id",1)
  ->where("root_id","<>",0)->where("process_id",$index)
    ->count();
 if($legal1_full > 0){
    $count = DB::table("legal_process")->where("step_id",1)->where("root_id","<>",0)->where("process_id",$index)
    ->where("status",1)->count();
    $legal1_percent = round($count / $legal1_full*100,2);
 }else{
    $legal1_percent = 0;
 }
 $legal2_full =  DB::table("legal_process")->where("step_id",2)
  ->where("root_id","<>",0)->where("process_id",$index)
    ->count();


 if($legal2_full > 0){
    $count = DB::table("legal_process")->where("step_id",2)->where("root_id","<>",0)->where("process_id",$index)
    ->where("status",1)->count();
    echo $count;
    $legal2_percent = round($count / $legal2_full*100,2);
 }else{
    $legal2_percent = 0;
 }


 $legal3_full =  DB::table("legal_process")->where("step_id",3)
  ->where("root_id","<>",0)->where("process_id",$index)
    ->count();


  if($legal3_full > 0){
    $count = DB::table("legal_process")->where("step_id",3)->where("root_id","<>",0)->where("process_id",$index)
    ->where("status",1)->count();
    $legal3_percent = round($count / $legal3_full*100,2);
 }else{
    $legal3_percent = 0;
 }





  $legal_list =  DB::table("legal_process")
->select("id","stt")
->where("root_id",0)
->where("process_id",$index)->get();

    DB::table("file_noti")
    ->leftJoin("files","files.id","=","file_noti.event_id")
            ->where("file_noti.user_id", Auth()->user()->id)
            ->where("files.project_id",$index)->update(["seen"=>1]);

    return view('process.viewbk', compact('legal_list','index',"curstep","process","cv1","cv2","user_cv1","user_cv2"
                                        ,"legal1","legal2","legal3"
                                        ,"legal1_percent","legal2_percent","legal3_percent"
                                        ));
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

   public function processDetail($id){
    $processes = DB::table("process_step")
     ->leftJoin('process', 'process_step.process_id', '=', 'process.id')
    ->leftJoin('step', 'process_step.step_id', '=', 'step.id')
    ->where([['process.id',$id]])
    ->select("process_step.id as ps_id", "process.id as pid", "step.id as sid"
    ,"process.name as process_name", "step.name as step_name","process_step.pos as pos"
    ,"step.state as state", "step.des as des", "step.action as action", "step.legal as legal",
     "step.urlfull as urlfull", "step.urlnonfull as urlnonfull"
    )->get();

    return json_encode($processes);
  }

  public function stepDetail($id){
    $substep_count = DB::table("substep")
    ->where([['step_id',$id]])->count();
    if ($substep_count > 0){
        $data = [];
        $data[] = 1;
        $substeps = DB::table("substep")
    ->where([['step_id',$id]])->orderBy('pos')->get();
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
       $temp[] = $substep->urlfull;
       $temp[] = $substep->urlnonfull;
       $temp[] = $substep->pos;


       // $temp[] = json_encode($substep_innertask);
       // $temp[] = json_encode($substep_outertask);
       // $temp[] = json_encode($substep_processtask);

       $data[] = $temp;
     } 

        return json_encode($data);
    }else{
   $step = DB::table("step_task")
    ->leftJoin('task', 'step_task.task_id', '=', 'task.id')
    ->leftJoin('step', 'step_task.step_id', '=', 'step.id')
    ->where([['step.id',$id]])
    ->select("task.id as id","task.name as name","task.file_flag as file_flag","task.url as url",
    "task.des as des","task.legal as legal","task.status as status","task.type as type",
    "task.department_id as department_id","task.legal_type as legal_type","task.start_date as start_date","task.duration as duration"
    )->get();

    return (json_encode([0,json_encode($step)]));
    }


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
       $temp[] = $substep->urlfull;
       $temp[] = $substep->urlnonfull;

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
    ->leftJoin('task_url', 'task_url.task_id', '=', 'task.id')
    ->leftJoin('substep', 'substep_task.step_id', '=', 'substep.id')
    ->where([['substep.id',$id]])
    ->select("task.id as id","task.name as name","task.file_flag as file_flag","task_url.url as url",
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
   public function addInnerTaskFile(Request $request)
    {

       if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền tải file');
      }
      $id =  $request->step_id;
      $type = $request->type;
      $index = $request->index;
      // if ($type == 0){
      //   $table = "step_innertask";
      // }else{
      //   $table = "substep_innertask";

      // }
       $table  = "task";

try{
  $i = 0;
foreach ($request->file as $file) {
      $destinationPath = public_path().'/files/system/';
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->route('process-index')->with('warning',' Tệp tin khống đúng định dạng !');;

      }
      // $request->file->move($destinationPath, $file_name);

      // print_r(DB::table( $table)->where('id', $id)->first());

      $path = $file->store('system');

      $url = Storage::url($path);
      // DB::table($table)->where('id', $id)->update([
      //       'url' =>  $url
      //   ]);
      $i = $i +1;
      DB::table("task_url")->insert([
            'url' => $url,
            'task_id'=>$id,
            'image_id'=>$i,
        ]);

      DB::table($table)->where('id', $id)->update([
            'status' => 1
        ]);
}
}
catch (\Exception $e) { 

        return Redirect()->route('process-view', ['id' => $index])->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');
        
               }

    return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật tệp thư mục!');
  }
     public function updateInnerTask(Request $request)
    {
       if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền tải file');
      }
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

      $cur_url = DB::table("task_url")->where('task_id', $id)->count();
      if ($file_flag == 0){
      DB::table($table)->where('id', $id)->update([
            'status' => 1
        ]);


        // return Redirect()->route('process-view', ['id' => $index])->with('notification',' Đã cập nhật trạng thái thành công!');

      }else{
      if($cur_url > 0){
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
      // $request->file->move($destinationPath, $file_name);

      // print_r(DB::table( $table)->where('id', $id)->first());

      $path = $request->file->store('system');

      $url = Storage::url($path);
      
      DB::table($table)->where('id', $id)->update([
            'url' => $url
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

       if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
      }
    DB::table("task")->where('id', $request->id)->update([
            'start_date' => $request->start_date,
            'duration' => $request->duration,
            'more' => $request->moreinfo,
        ]);
       return Redirect()->route('process-view', ['id' => $request->index])->with('notification',' Đã cập nhật thông tin thành công !');
  }
  public function updateStepStatus(Request $request)
    {

       if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền tải file');
}
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
      $curstep = DB::table("process")->where("id",$index)->first()->curstep;
    DB::table("process")->where('id', $index)->update([
            'curstep' => $curstep + 1
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
     if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}
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


public function getAdminFileProcess($pid,$sid,$ssid, $id){
  if(!$this->checkAdmin()){
        return redirect()->back();
}
    $type = 1;
    $task = DB::table("task")
    ->where("id",$id)->first();
    $file = DB::table("task_url")->where("task_id",$id)->get();
    $index = $ssid;
    return view('process.file',compact('pid','sid','ssid','index','task','file','id','type'));

  }

   public function getFileProcess($index,$id){
    $type = 2;
    $task = DB::table("task")
    ->where("id",$id)->first();
    $file = DB::table("task_url")->where("task_id",$id)->get();
    return view('process.file',compact('index','task','file','id','type'));

  }


   public function getFileProcessIcon($index,$id){

    $task = DB::table("task")
    ->where("id",$id)->first();
    $file = DB::table("task_url")->where("task_id",$id)->get();

    return view('process.file-icon',compact('index','task','file','id'));

  }

  function editProcessFile(Request $request){
    $title = $request->title;
  $i = DB::table("task_url")->where("task_id",$request->id)->count();
  try{
foreach ($request->file as $file) {
      $file_name = $file->getClientOriginalName();
      if(strlen($file_name) < 2){
    return Redirect()->back()->with('warning',' Tệp tin không đúng định dạng !');

      }
      // dd($title);
      $path = $file->store('system');

      $url = Storage::url($path);

      $i = $i +1;

       DB::table("task_url")->insert([
            'url' => $url,
            'name'=>$title,
            'task_id'=>$request->id,
            'image_id'=>$i,
        ]);



      }


        }
catch (\Exception $e) { 
    return Redirect()->back()->with('warning',' Tệp đã cho quá kích thước hệ thống cho phép !');;
               }

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}
  function editProcessFileName(Request $request){
     DB::table('task_url')
              ->where('id', $request->id)
              ->update(['name' => $request->title]);

 return Redirect()->back()->with('notification',' Đã thêm tệp tin thành công !');

}
    


function DeleteFileProcess($index,$id){
  if(!$this->checkLead()){
        return redirect()->back()->with('warning',' Tài khoản không có quyền thực hiện');
}

  $tid = DB::table("task_url")->where("id",$id)->first()->task_id;
       DB::table("task_url")->where("id",$id)->delete();
 return Redirect()->route('process-file', ['index' => $index,'id' => $tid])->with('notification',' Đã xóa tệp tin !');

}
  

}