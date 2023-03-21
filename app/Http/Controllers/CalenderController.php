<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use DB;
use Redirect,Response;
use Carbon\Carbon;

use App\Duong2amlich;


class CalenderController extends Controller
{
   
    public function index($id)
    {
        dd($id);
        $pid = DB::table("building_job")
        ->where("building_job.id",$id)->first()->project_id;
        $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
        $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
        
        $data0 = DB::table("weather")->where("project_id",$pid)->whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)->select('id','des as title','start', 'end','low as low','high as high');


        $data = DB::table("building_history")
        ->where("building_history.task_id",$id)
        ->whereDate('building_history.start', '>=', $start)->whereDate('building_history.end',   '<=', $end)->select('building_history.id',DB::raw('"0" as title'),'building_history.start', 'building_history.end',DB::raw('"0" as low'),DB::raw('"0" as high'));

         // $data0 = $data0->union($data)->get();
        return Response::json($data0->get());
        // }
        // return view('fullcalendar');
    }

    public function schedule(){

       $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
       $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
       $sid = (!empty($_COOKIE["sid"])) ? ($_COOKIE["sid"]) : ('');
// dd($sid);
// $sid = "79,-99";
       if($sid != ""){
        $sid = explode(",",$sid);

        if (in_array("-99", $sid)) {
            $schedules = DB::table("schedule")
            ->whereIn("id",$sid)
        ->where("is_preply",0)
            ->select('id','schedule.title as title','start_date as start', 'end_date as end',"schedule.status as status")
            ->get();
        }else{
            $schedules = DB::table("schedule")
            ->whereIn("id",$sid)
        ->where("is_preply",0)
            ->select('id','schedule.title as title','start_date as start', 'end_date as end',"schedule.status as status")
            ->get();
        }
    }else{
        if($this->checkLead()){

            $schedules = DB::table("schedule")
            ->Where("status",5)
            ->select('id','schedule.title as title','start_date as start', 'end_date as end',"schedule.status as status")
            ->get();
// dd($schedules);

        }else{
            $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();

            $schedules = DB::table("schedule")
            ->whereIn("id",$sid)
            ->Where("status",5)
            ->select('id','schedule.title as title','start_date as start', 'end_date as end',"schedule.status as status")
            ->get();

        }
    }

// dd($schedules);
    $schedule_list = [];
    foreach($schedules as $schedule){
    // continue;
        $cur = Carbon::parse($schedule->start);
        $final  = Carbon::parse($schedule->end);
        while($cur <= $final){
            $temp_time = $cur->format('Y-m-d');
            if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
                $temp = new \stdClass();
                $temp->id = $schedule->id;
                $temp->title = $schedule->title;
                $temp->status = $schedule->status;
                $temp->start = $cur->format('Y-m-d');
                $temp->end = $cur->format('Y-m-d');

                $schedule_list[] = $temp;
            }

            $cur = $cur->addDay(); 
        }
    }

    return $schedule_list;
}

public function vipschedule($vip_id){

   $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
   $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
   $sid = (!empty($_COOKIE["sid"])) ? ($_COOKIE["sid"]) : ('');

// lịch dương
   $schedules = [];
    // k dc ay su kien lap lai
    $sid = explode(",",$sid);

    $schedules = DB::table("vip_event")
    ->whereIn("id",$sid)
    ->where("vip_id",$vip_id)
    ->where("is_lunar",1)
    ->where("is_preply",0)
    ->select('id','vip_event.name as name','date as date', 'end_date as end_date')
    ->get();
    


$schedule_list = [];
foreach($schedules as $schedule){
    // continue;
    $cur = Carbon::parse($schedule->date);
    $final  = Carbon::parse($schedule->end_date);
   
    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name;
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
}


//lịch âm
    $schedule_lunars = DB::table("vip_event")
    ->whereIn("id",$sid)
    ->where("is_lunar",0)
    ->where("is_preply",0)
    ->where("vip_id",$vip_id)
    ->select('id','vip_event.name as name','date as date', 'end_date as end_date')
    ->get();
    


foreach($schedule_lunars as $schedule){
    // continue;
    $cur = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->date));
    $final  = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->end_date));
    
    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title =$schedule->name;
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        } 

        $cur = $cur->addDay(); 
    }
}

// hien lich am

// $start_calender = Carbon::parse($start);
// $end_calender = Carbon::parse($end);
// while($start_calender< $end_calender){
//         $temp_time = $start_calender->format('Y-m-d');
//         // if(strval($temp_time) != "1" ){
//             $temp = new \stdClass();
//             $temp->id = "0";
//             $temp->title =Carbon::parse(Duong2amlich::convertSolar2Lunar($start_calender->format('Y-m-d')))->format('d/m');
//             $temp->status = 9;
//             $temp->start = $start_calender->format('Y-m-d');
//             $temp->end = $start_calender->format('Y-m-d');

//             $schedule_list[] = $temp;

//         $start_calender = $start_calender->addDay(); }



//lay danh sach su kien lap lai
// $schedule_list = [];

    $schedules = DB::table("vip_event")
        ->whereIn("id",$sid)
        ->where("vip_id",$vip_id)
        ->where("is_preply",">",0)  
        ->where("is_lunar",1)
        ->select('id','vip_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"is_preply as is_preply"
        )
        ->get();


foreach($schedules as $schedule){

    $check = 0;
    for($i =0;$i < 10;$i++){
        if($schedule->is_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->is_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }


        if($schedule->is_preply == 3){
                $cur = Carbon::parse($schedule->date)->addYears($i); 
                $final = Carbon::parse($schedule->end_date)->addYears($i); 

        }


        $check_cur  = 0;
        $check_final = 0;

        if($start <  $cur  && $cur < $end){
            $check_cur == 1;
        }

        if($start <  $final  && $final < $end){
            $check_final = 1;
        }

        // if($check_cur == 0 && $check_final == 0){
        //     // $cur = $cur->addYear(); 
        //     // $final = $final->addYear(); 
        //     $cur = $cur->addDays(7); 
        //     $final = $final->addDays(7); 

        // }else{
        //     break;
        // }


    
    if($check_cur == 0 && $check_final == 0){
                continue;
        }
    $this_event = $cur;
    while($this_event <= $final){
        $temp_time = $this_event->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name;
            $temp->status = 1;
            $temp->start = $this_event->format('Y-m-d');
            $temp->end = $this_event->format('Y-m-d');
            $temp->start_time = $schedule->start_time;
            $temp->end_time = $schedule->end_time;

            $schedule_list[] = $temp;
        }

        $this_event = $this_event->addDay(); 
    }


    }
  }
    // k dc ay su kien lap lai
    
     $schedules = DB::table("vip_event")
        ->whereIn("id",$sid)
    ->where("vip_id",$vip_id)
        ->where("is_preply",">",0)
        ->where("is_lunar",0)
        ->select('id','vip_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"is_preply as is_preply"
    )
        ->get();

// dd($schedules);
foreach($schedules as $schedule){
    // continue;

    $check = 0;
    $cur = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->date));
    $final  = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->end_date));
    for($i =0;$i < 10;$i++){
    $check_cur = 0;
    $check_final = 0;

        if($schedule->is_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->is_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }

        if($schedule->is_preply == 3){
                $cur = Carbon::parse($schedule->date)->addYears($i); 
                $final = Carbon::parse($schedule->end_date)->addYears($i); 

        }

        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
            $check_cur == 1;
        }

        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
            $check_final = 1;
        }

        // if($check_cur == 0 && $check_final == 0){
        //     // $cur = $cur->addYear(); 
        //     // $final = $final->addYear(); 


        //     $cur = $cur->addDays(7); 
        //     $final = $final->addDays(7); 
        // }else{
        //     break;
        // }


    if($check_cur == 0 && $check_final == 0){
                continue;
        }

    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name."(".Carbon::parse(Duong2amlich::convertSolar2Lunar($cur->format('Y-m-d')))->format('d/m')." Âm)";
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');
            $temp->start_time = $schedule->start_time;
            $temp->end_time = $schedule->end_time;

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
    }
  }
return $schedule_list;

}

    public function UserSchedule(){

   $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
   $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
   $sid = (!empty($_COOKIE["sid"])) ? ($_COOKIE["sid"]) : ('');

// --------------------------------
// LẤY SỰ KIỆN LỊCH DƯƠNG K LẶP
// --------------------------------

   $schedules = [];
   if($sid != ""){
    $sid = explode(",",$sid);

    $schedules = DB::table("vip_event")
    ->whereIn("vip_id",$sid)
    ->where("is_lunar",1)
    ->where("is_preply",0)
    ->select('id','vip_event.name as name','date as date', 'end_date as end_date','vip_id as vip_id')
    ->get();
    
}

    
$schedule_list = [];
foreach($schedules as $schedule){
    // continue;
    $cur = Carbon::parse($schedule->date);
    $final  = Carbon::parse($schedule->end_date);
   
    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->vip_id = $schedule->vip_id;
            $temp->id = $schedule->id;
            $temp->title = $schedule->name;
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
}
    
// --------------------------------
// LẤY SỰ KIỆN LỊCH âM K LẶP
// --------------------------------

$schedule_lunars = [];
if($sid != ""){
    $schedule_lunars = DB::table("vip_event")
    ->whereIn("vip_id",$sid)
    ->where("is_lunar",0)
    ->where("is_preply",0)
    ->select('id','vip_event.name as name','date as date', 'end_date as end_date','vip_id as vip_id')
    ->get();
    
}

foreach($schedule_lunars as $schedule){
    // continue;
    $cur = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->date));
    $final  = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->end_date));
    
    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->vip_id = $schedule->vip_id;
            $temp->id = $schedule->id;
            $temp->title =$schedule->name;
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        } 

        $cur = $cur->addDay(); 
    }
}

// // --------------------------------
// // LẤY tOAN BỘ LỊCH ÂM
// // --------------------------------


// $start_calender = Carbon::parse($start);
// $end_calender = Carbon::parse($end);
// while($start_calender< $end_calender){
//         $temp_time = $start_calender->format('Y-m-d');
//         // if(strval($temp_time) != "1" ){
//             $temp = new \stdClass();
//             $temp->id = "0";
//             $temp->title =Carbon::parse(Duong2amlich::convertSolar2Lunar($start_calender->format('Y-m-d')))->format('d/m');
//             $temp->status = 9;
//             $temp->start = $start_calender->format('Y-m-d');
//             $temp->end = $start_calender->format('Y-m-d');

//             $schedule_list[] = $temp;

//         $start_calender = $start_calender->addDay(); }



/// --------------------------------
// LẤY SỰ KIỆN LỊCH DƯƠNG LẶP
// --------------------------------


if($sid != ""){

$schedules = DB::table("vip_event")
->whereIn("vip_id",$sid)    
->where("is_preply",">",0)
->where("is_lunar",1)
->select('id','vip_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"is_preply as is_preply","vip_event.vip_id as vip_id"
    )
->get();
    
}





foreach($schedules as $schedule){

    $check = 0;
    for($i =0;$i < 10;$i++){
        if($schedule->is_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->is_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }


        if($schedule->is_preply == 3){
                $cur = Carbon::parse($schedule->date)->addYears($i); 
                $final = Carbon::parse($schedule->end_date)->addYears($i); 

        }


        $check_cur  = 0;
        $check_final = 0;

        if($start <  $cur  && $cur < $end){
            $check_cur == 1;
        }

        if($start <  $final  && $final < $end){
            $check_final = 1;
        }
  
    if($check_cur == 0 && $check_final == 0){
                continue;
        }
    $this_event = $cur;
    while($this_event <= $final){
        $temp_time = $this_event->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name;
            $temp->vip_id = $schedule->vip_id;
            $temp->status = 1;
            $temp->start = $this_event->format('Y-m-d');
            $temp->end = $this_event->format('Y-m-d');
            $temp->start_time = $schedule->start_time;
            $temp->end_time = $schedule->end_time;

            $schedule_list[] = $temp;
        }

        $this_event = $this_event->addDay(); 
    }


    }
  }




/// --------------------------------
// LẤY SỰ KIỆN LỊCH ÂM LẶP
// --------------------------------
$schedules = [];

if($sid != ""){
    $schedules = DB::table("vip_event")
    ->whereIn("vip_id",$sid)
    ->where("is_preply",">",0)
    ->where("is_lunar",0)
    ->select('id','vip_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"is_preply as is_preply","vip_event.vip_id as vip_id"
    )
    ->get();
  }  

// dd($schedules);
foreach($schedules as $schedule){
    // continue;

    $check = 0;
    for($i =0;$i < 10;$i++){
    $check_cur = 0;
    $check_final = 0;

        if($schedule->is_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->is_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }

        if($schedule->is_preply == 3){
                $cur = Carbon::parse($schedule->date)->addYears($i); 
                $final = Carbon::parse($schedule->end_date)->addYears($i); 

        }

 $cur = Carbon::parse(Duong2amlich::convertLunar2Solar($cur->format('Y-m-d')));
    $final  = Carbon::parse(Duong2amlich::convertLunar2Solar($final->format('Y-m-d')));
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
            $check_cur == 1;
        }

        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
            $check_final = 1;
        }

        // if($check_cur == 0 && $check_final == 0){
        //     // $cur = $cur->addYear(); 
        //     // $final = $final->addYear(); 


        //     $cur = $cur->addDays(7); 
        //     $final = $final->addDays(7); 
        // }else{
        //     break;
        // }


    if($check_cur == 0 && $check_final == 0){
                continue;
        }

    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->vip_id = $schedule->vip_id;
            $temp->title = $schedule->name."(".Carbon::parse(Duong2amlich::convertSolar2Lunar($cur->format('Y-m-d')))->format('d/m')." Âm)";
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');
            $temp->start_time = $schedule->start_time;
            $temp->end_time = $schedule->end_time;

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
  }
}
//return $schedule_list;




// /// --------------------------------
// // LẤY SỰ KIỆN THEO TAG
// // --------------------------------




   $schedules = [];
   if($sid == ""){
    return $schedule_list;
   }
   foreach($sid as $vip_id){
        $tid = DB::table("vip_tag_connection")->where("vip_id",$vip_id)->pluck("tag_id")->toArray();


/// --------------------------------
//  SỰ KIỆN LỊCH DƯƠNG k LẶP
// --------------------------------


        $schedules = DB::table("vip_tag_event")
        ->leftJoin("vip_tag","vip_tag.id","vip_tag_event.tag_id")
        ->select('vip_tag_event.id as id','vip_tag_event.name as name','date as date', 'end_date as end_date',"vip_tag.name as tag_name")
        ->whereIn("tag_id",$tid)
        ->where("is_lunar",1)
        ->where("is_preply",0)
        ->get();

    // $schedule_list = [];
    foreach($schedules as $schedule){
        // continue;
        $cur = Carbon::parse($schedule->date);
        $final  = Carbon::parse($schedule->end_date);
       
        while($cur <= $final){
            $temp_time = $cur->format('Y-m-d');
            if($start <  $temp_time  && $temp_time < $end){
            // if(strval($temp_time) != "1" ){
                $temp = new \stdClass();
                $temp->id = $schedule->id;
                $temp->title = $schedule->tag_name. ": ". $schedule->name;
                $temp->status = 5;
                $temp->vip_id = $vip_id;
                $temp->start = $cur->format('Y-m-d');
                $temp->end = $cur->format('Y-m-d');

                $schedule_list[] = $temp;
            }

            $cur = $cur->addDay(); 
        }
    }


/// --------------------------------
//  SỰ KIỆN LỊCH ÂM k LẶP
// --------------------------------


    $schedule_lunars = DB::table("vip_tag_event")
    ->leftJoin("vip_tag","vip_tag.id","vip_tag_event.tag_id")
    ->select('vip_tag_event.id as id','vip_tag_event.name as name','date as date', 'end_date as end_date',"vip_tag.name as tag_name")
    ->whereIn("tag_id",$tid)
    ->where("is_lunar",0)
    ->where("is_preply",0)
    ->get();
    // dd($schedule_lunars);
        
    

    foreach($schedule_lunars as $schedule){
        // continue;
        $cur = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->date));
        $final  = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->end_date));
        // dd($cur);
        while($cur <= $final){
            $temp_time = $cur->format('Y-m-d');
            if($start <  $temp_time  && $temp_time < $end){
            // if(strval($temp_time) != "1" ){
                $temp = new \stdClass();
                $temp->id = $schedule->id;
                $temp->title = $schedule->tag_name. ": ". $schedule->name;
                $temp->status = 5;
                $temp->vip_id = $vip_id;
                $temp->start = $cur->format('Y-m-d');
                $temp->end = $cur->format('Y-m-d');

                $schedule_list[] = $temp;
            } 

            $cur = $cur->addDay(); 
        }
    }
    // dd($schedule_list);


    //lay danh sach su kien lap lai
    $schedules = DB::table("vip_tag_event")
    ->leftJoin("vip_tag","vip_tag.id","vip_tag_event.tag_id")
    ->select('vip_tag_event.id','vip_tag_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"is_preply as is_preply"
    )
    ->whereIn("tag_id",$tid)
    ->where("is_preply",">",0)
    ->where("is_lunar",1)
    ->get();

 /// --------------------------------
//  SỰ KIỆN LỊCH DƯƠNG LẶP
// --------------------------------

    // dd($schedules);
    foreach($schedules as $schedule){

    $check = 0;
    for($i =0;$i < 10;$i++){
        if($schedule->is_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->is_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }


        if($schedule->is_preply == 3){
                $cur = Carbon::parse($schedule->date)->addYears($i); 
                $final = Carbon::parse($schedule->end_date)->addYears($i); 

        }


        $check_cur  = 0;
        $check_final = 0;

        if($start <  $cur  && $cur < $end){
            $check_cur == 1;
        }

        if($start <  $final  && $final < $end){
            $check_final = 1;
        }
  
    if($check_cur == 0 && $check_final == 0){
                continue;
        }
    $this_event = $cur;
    while($this_event <= $final){
        $temp_time = $this_event->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name;
            $temp->status = 1;
            $temp->vip_id = $vip_id;
            $temp->start = $this_event->format('Y-m-d');
            $temp->end = $this_event->format('Y-m-d');
            $temp->start_time = $schedule->start_time;
            $temp->end_time = $schedule->end_time;

            $schedule_list[] = $temp;
        }

        $this_event = $this_event->addDay(); 
    }


    }
  }

   /// --------------------------------
//  SỰ KIỆN LỊCH ÂM k LẶP
// --------------------------------


    $schedules = DB::table("vip_tag_event")
    ->leftJoin("vip_tag","vip_tag.id","vip_tag_event.tag_id")
    ->select('vip_tag_event.id','vip_tag_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"is_preply as is_preply"
    )
    ->whereIn("tag_id",$tid)
    ->where("is_preply",">",0)
    ->where("is_lunar",0)
    ->get();
    // dd($schedules);
    
    
    foreach($schedules as $schedule){
    // continue;

    $check = 0;
    for($i =0;$i < 10;$i++){
    $check_cur = 0;
    $check_final = 0;

        if($schedule->is_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->is_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }

        if($schedule->is_preply == 3){
                $cur = Carbon::parse($schedule->date)->addYears($i); 
                $final = Carbon::parse($schedule->end_date)->addYears($i); 

        }

 $cur = Carbon::parse(Duong2amlich::convertLunar2Solar($cur->format('Y-m-d')));
    $final  = Carbon::parse(Duong2amlich::convertLunar2Solar($final->format('Y-m-d')));
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
            $check_cur == 1;
        }

        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
            $check_final = 1;
        }

        // if($check_cur == 0 && $check_final == 0){
        //     // $cur = $cur->addYear(); 
        //     // $final = $final->addYear(); 


        //     $cur = $cur->addDays(7); 
        //     $final = $final->addDays(7); 
        // }else{
        //     break;
        // }


    if($check_cur == 0 && $check_final == 0){
                continue;
        }

    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name."(".Carbon::parse(Duong2amlich::convertSolar2Lunar($cur->format('Y-m-d')))->format('d/m')." Âm)";
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');
            $temp->vip_id = $vip_id;
            $temp->start_time = $schedule->start_time;
            $temp->end_time = $schedule->end_time;

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
   }
  }

}

return $schedule_list;

}


public function viptagschedule($tag_id){

   $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
   $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
   $sid = (!empty($_COOKIE["sid"])) ? ($_COOKIE["sid"]) : ('');


   $schedules = [];
   if($sid != ""){
    // k dc ay su kien lap lai
    $sid = explode(",",$sid);

    $schedules = DB::table("vip_tag_event")
    ->whereIn("id",$sid)
    ->where("tag_id",$tag_id)
    ->where("is_lunar",1)
    ->where("is_preply",0)
    ->select('id','vip_tag_event.name as name','date as date', 'end_date as end_date')
    ->get();

}

// dd($schedules);
// $schedules = DB::table("vip_event")
// ->where("vip_id",$vip_id)->get();
// dd($schedules);
$schedule_list = [];
foreach($schedules as $schedule){
    // continue;
    $cur = Carbon::parse($schedule->date);
    $final  = Carbon::parse($schedule->end_date);
    // dd("?????");
    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name;
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
}


//lịch âm
$schedule_lunars = [];
if($sid != ""){
    $schedule_lunars = DB::table("vip_tag_event")
    ->whereIn("id",$sid)
    ->where("is_lunar",0)
    ->where("is_preply",0)
    ->where("tag_id",$tag_id)
    ->select('id','vip_tag_event.name as name','date as date', 'end_date as end_date')
    ->get();
    
}

foreach($schedule_lunars as $schedule){
    // continue;
    $cur = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->date));
    $final  = Carbon::parse(Duong2amlich::convertLunar2Solar($schedule->end_date));
    
    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title =$schedule->name;
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        } 

        $cur = $cur->addDay(); 
    }
}

// hien lich am

// $start_calender = Carbon::parse($start);
// $end_calender = Carbon::parse($end);
// while($start_calender< $end_calender){
//         $temp_time = $start_calender->format('Y-m-d');
//         // if(strval($temp_time) != "1" ){
//         $temp = new \stdClass();
//         $temp->id = "0";
//         $temp->title =Carbon::parse(Duong2amlich::convertSolar2Lunar($start_calender->format('Y-m-d')))->format('d/m');
//         $temp->status = 9;
//         $temp->start = $start_calender->format('Y-m-d');
//         $temp->end = $start_calender->format('Y-m-d');

//         $schedule_list[] = $temp;

//         $start_calender = $start_calender->addDay();
//          }



//lay danh sach su kien lap lai
// $schedule_list = [];
   if($sid != ""){
    // k dc ay su kien lap lai

    $schedules = DB::table("vip_tag_event")
    ->whereIn("id",$sid)
    ->where("is_preply",">",0)
    ->where("is_lunar",1)
    ->where("tag_id",$tag_id)
    ->select('id','vip_tag_event.name as name','date as date', 'end_date as end_date'
            ,'start_time as start_time', 'end_time as end_time'
            ,"is_preply as is_preply"
        )
    ->get();
    
}


// dd($schedules);
foreach($schedules as $schedule){

    $check = 0;
    for($i =0;$i < 10;$i++){
        if($schedule->is_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->is_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }


        if($schedule->is_preply == 3){
                $cur = Carbon::parse($schedule->date)->addYears($i); 
                $final = Carbon::parse($schedule->end_date)->addYears($i); 

        }


        $check_cur  = 0;
        $check_final = 0;

        if($start <  $cur  && $cur < $end){
            $check_cur == 1;
        }

        if($start <  $final  && $final < $end){
            $check_final = 1;
        }
    if($check_cur == 0 && $check_final == 0){
                continue;
        }

    // dd("?????");
    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name;
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
  }

}
// dd("234");
// lấy sự kiện lặp lại lich âm
  if($sid != ""){
    // k dc ay su kien lap lai
    // $sid = explode(",",$sid);

    $schedules = DB::table("vip_tag_event")
    ->whereIn("id",$sid)
    ->where("is_preply",">",0)
    ->where("is_lunar",0)
    ->where("tag_id",$tag_id)
    ->select('id','vip_tag_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"is_preply as is_preply"
    )
    ->get();
    
}
// dd($schedules);
foreach($schedules as $schedule){

   
    $check = 0;
    for($i =0;$i < 10;$i++){
        if($schedule->is_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->is_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }


        if($schedule->is_preply == 3){
                $cur = Carbon::parse($schedule->date)->addYears($i); 
                $final = Carbon::parse($schedule->end_date)->addYears($i); 

        }
 $cur = Carbon::parse(Duong2amlich::convertLunar2Solar($cur->format('Y-m-d')));
    $final  = Carbon::parse(Duong2amlich::convertLunar2Solar($final->format('Y-m-d')));
        



        $check_cur  = 0;
        $check_final = 0;

        if($start <  $cur  && $cur < $end){
            $check_cur == 1;
        }

        if($start <  $final  && $final < $end){
            $check_final = 1;
        }
    if($check_cur == 0 && $check_final == 0){
                continue;
        }

    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->name;
            $temp->status = 1;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
  }
}
return $schedule_list;
}   
public function building(){

   $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
   $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');
   $sid = (!empty($_COOKIE["sid"])) ? ($_COOKIE["sid"]) : ('');
// dd($sid);
// $sid = "79,-99";
   if($sid != ""){
    $sid = explode(",",$sid);

    if (in_array("-99", $sid)) { 
        $schedules = DB::table("buildingg")
        ->whereIn("id",$sid)
        ->orWhere("status",3)
        ->select('id','buildingg.title as title','start_date as start', 'end_date as end',"buildingg.status as status")
        ->get();
    }else{
        $schedules = DB::table("buildingg")
        ->whereIn("id",$sid)
        ->select('id','buildingg.title as title','start as start', 'end  as end',"buildingg.status as status")
        ->get();
    }
}else{
    if($this->checkLead()){

        $schedules = DB::table("buildingg")
        ->Where("status",5)
        ->select('id','buildingg.title as title','start as start', 'end  as end',"buildingg.status as status")
        ->get();
// dd($schedules);

    }else{
        $sid = DB::table("schedule_user")->where("user_id",Auth()->user()->id)->pluck('schedule_id')->toArray();

        $schedules = DB::table("schedule")
        ->whereIn("id",$sid)
        ->Where("status",5)
        ->select('id','buildingg.title as title','start as start', 'end  as end',"buildingg.status as status")
        ->get();

    }
}

// dd($schedules);
$schedule_list = [];
foreach($schedules as $schedule){
    // continue;
    $cur = Carbon::parse($schedule->start);
    $final  = Carbon::parse($schedule->end);
    // echo $cur->format('Y-m-d');
    // echo "<br>";
    // echo $start;
    // echo "<br>";
    // echo $end;


    //     if($start <  $cur->format('Y-m-d') && $cur->format('Y-m-d') < $end){
    //             dd("124");
    //     }
    // dd("?????");
    while($cur <= $final){
        $temp_time = $cur->format('Y-m-d');
        if($start <  $temp_time  && $temp_time < $end){
        // if(strval($temp_time) != "1" ){
            $temp = new \stdClass();
            $temp->id = $schedule->id;
            $temp->title = $schedule->title;
            $temp->status = $schedule->status;
            $temp->start = $cur->format('Y-m-d');
            $temp->end = $cur->format('Y-m-d');

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
}



// $schedule_list =  [$schedule_list[0],$schedule_list[12]];
 // dd($schedule_list);

// setcookie("sid", 0, time()+3600*24, "/", false);

return Response::json($schedule_list);
}

public function get($id){
    $history =  DB::table("building_history")->where("id",$id)->first();

    $history_img = DB::table("building_history_img")->where("history_id",$id)->get();



    return json_encode([$history , $history_img ]);
}

public function weather($id,$tid){
    $weather =  DB::table("weather")->where("id",$id)->first();

    try{
        $history =  DB::table("building_history")->where("task_id",$tid)->where("start",$weather->start)->first();

        $history_img = DB::table("building_history_img")->where("history_id",$history->id)->get();
    }
    catch (\Exception $e) { 
        $history = 0;
        $history_img  = 0;
    }
    return json_encode([$weather,$history , $history_img,]);
}
public function store(Request $request)
{  
    $insertArr = [ 'title' => $request->title,
    'start' => $request->start,
    'end' => $request->end
];
        // dd("!@4124");
$event = DB::table("building_history")->insert($insertArr);   
return Response::json($event);
}


public function update(Request $request)
{   
    $where = array('id' => $request->id);
    $updateArr = ['title' => $request->title,'start' => $request->start, 'end' => $request->end];
    $event  =DB::table("building_history")->where($where)->update($updateArr);
    
    return Response::json($event);
} 






public function destroy(Request $request)
{
    $event = DB::table("building_history")->where('id',$request->id)->delete();
    
    return Response::json($event);
}    


}