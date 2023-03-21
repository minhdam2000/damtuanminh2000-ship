<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use DB;
use Redirect,Response;
use Carbon\Carbon;

use App\Duong2amlich;


class CalenderctController extends Controller
{

    public function DragEvent(Request $request){

        $event = DB::table("calendar_event")
        ->where("id",$request->id)
        ->first();

        
        $dfStart = Carbon::createFromFormat('Y-m-d', $event->date);
        $dfEnd = Carbon::createFromFormat('Y-m-d', $event->end_date);
        $datediff = $dfEnd->diffInHours($dfStart);
        // dd($datediff);
        $start = $request->start;
        $end = Carbon::createFromFormat('Y-m-d', $request->start)->addHours($datediff);

        DB::table("calendar_event")
        ->where("id",$request->id)
        ->update([
            "date"=>$start,
            "end_date"=>$end,
        ]);

        return true;
    }
	public function company(){
    $companys  = DB::table("company_canlender")
    ->leftJoin('company_canlender_list', 'company_canlender.id', '=', 'company_canlender_list.list_id')
    ->select("company_canlender.name as name"
      ,"company_canlender.id as id","company_canlender.name as name"
              ,DB::raw("group_concat(company_canlender.name SEPARATOR ', ') as company_canlender")
    )
    ->groupBy('company_canlender.id')
            ->get();
    return view('company.calender_name',compact('companys'));

  }
    public function addNamecalenderct(Request $req){

   DB::table('company_canlender')->insert([
                    'name' => $req->name
                    
                ]);
            return Redirect()->back()->with('notification',' Đã tạo sự kiện thành công ');
 }
 function DeleteCompanyName($id){
    DB::table("company_canlender")->where("id",$id)->delete();
    return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}
function DeleteCompanyList($id){
    DB::table("calendar_event")->where("id",$id)->delete();
    return Redirect()->back()->with('warning',' Đã xóa tệp tin thành công !');
}

 public function calendar($id){
    $companys = DB::table("company_canlender")
    ->leftJoin('company_canlender_list', 'company_canlender.id', '=', 'company_canlender_list.list_id')
    
    ->select("company_canlender.name as name"
      ,"company_canlender.id as id","company_canlender.name as name"
      
  )
    ->groupBy('company_canlender.id')
    ->where("company_canlender.id",$id)
    ->first();

    $calendar_event = DB::table("calendar_event")->where("calendar_id",$id)->get();


    
    
    

     // dd($tags);


    return view('company.calender_list',compact("id",'companys',"calendar_event"));

}

 public function addNewCanlenderEvent(Request $req){
 DB::table('calendar_event')->insert([
    'calendar_id' => $req->id,
    'name' => $req->name,
    'date' => $req->date,
    'end_date' => $req->end_date,
    'calendar_lunar' => $req->calendar_lunar,
    'calendar_preply' => $req->calendar_preply,
    'start_time'=>$req->start_time,
    'end_time'=>$req->end_time,
    'note'=>$req->note,
    
]);
 return Redirect()->back()->with('notification',' Đã tạo sự kiện thành công ');
}

public function EditCanlenderEvent(Request $req){
    DB::table('calendar_event')->where('id', $req->id)->update([
        'name' => $req->name,
        'date' => $req->date,
        'calendar_lunar'=>$req->calendar_lunar,
        'calendar_preply'=>$req->calendar_preply,
        'end_date'=>$req->end_date,
        'start_time' =>$req->start_time,
        'end_time'=>$req->end_time,
        'note'=>$$req->note,
    ]);
    return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
}

 public function CompanyName($id){
    $companys = DB::table("company_canlender")
            ->first();

     $company_eventtag = DB::table("company_canlender_list")->where("list_id",$id)->get();    
            return view('company.calender_name',compact("id",'companys',"company_eventtag"));

    }

    public function deleteDanhSach(Request $req){
        // print($req);
    $data = $req->post();
    $flag = 0;
    foreach ($data as $key => $value){
        if(is_int($key)){
                // print($key);
            try{
              
                DB::table('vip_event')->where("id",intval($key))->delete();
            }
            catch (\Exception $e) { 
                $flag = 1;
            }
        }
    }
    if ($flag == 0){
        return Redirect()->back()->with('notification',' Đã xóa tất cả khách hàng.');
    }else{
        return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa khách');

    }
    
    

}
 public function CalendarEvent($calendar_id){

   $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
   $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

// lịch dương
   $schedules = [];

        $schedules = DB::table("calendar_event")
        ->where("calendar_id",$calendar_id)
        ->where("calendar_lunar",1)
        ->where("calendar_preply",0)
        ->select('id','calendar_event.name as name','date as date', 'end_date as end_date',
        'start_time as start_time', 'end_time as end_time'
    )
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
            $temp->start_time = $schedule->start_time;
            $temp->end_time = $schedule->end_time;

            $schedule_list[] = $temp;
        }

        $cur = $cur->addDay(); 
    }
}


//lịch âm
$schedule_lunars = [];

        $schedule_lunars = DB::table("calendar_event")
        ->where("calendar_id",$calendar_id)
        ->where("calendar_lunar",0)
        ->where("calendar_preply",0)
        ->select('id','calendar_event.name as name','date as date', 'end_date as end_date',
        'start_time as start_time', 'end_time as end_time')
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
            $temp->title = $schedule->name." (".Carbon::parse(Duong2amlich::convertSolar2Lunar($cur->format('Y-m-d')))->format('d/m')." Âm)";
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

//         $start_calender = $start_calender->addDay(); 

//     }



// //lay danh sach su kien lap lai
// $schedule_list = [];
  
        $schedules = DB::table("calendar_event")
        ->where("calendar_id",$calendar_id)
        ->where("calendar_preply",">",0)  
        ->where("calendar_lunar",1)
        ->select('id','calendar_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"calendar_preply as calendar_preply"
        )
        ->get();
    
// dd($schedules);
foreach($schedules as $schedule){

    $check = 0;
    for($i =0;$i < 10;$i++){
        if($schedule->calendar_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->calendar_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }


        if($schedule->calendar_preply == 3){
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
  // return 0;
// dd($schedule_list);
// lấy sự kiện lặp lại lich âm
  
        $schedules = DB::table("calendar_event")
        ->where("calendar_id",$calendar_id)
        ->where("calendar_preply",">",0)
        ->where("calendar_lunar",0)
        ->select('id','calendar_event.name as name','date as date', 'end_date as end_date'
        ,'start_time as start_time', 'end_time as end_time'
        ,"calendar_preply as calendar_preply"
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

        if($schedule->calendar_preply == 1){
                $cur = Carbon::parse($schedule->date)->addWeeks($i); 
                $final = Carbon::parse($schedule->end_date)->addWeeks($i); 
        }

        if($schedule->calendar_preply == 2){
                $cur = Carbon::parse($schedule->date)->addMonths($i); 
                $final = Carbon::parse($schedule->end_date)->addMonths($i); 

        }

        if($schedule->calendar_preply == 3){
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
            $temp->title = $schedule->name." (".Carbon::parse(Duong2amlich::convertSolar2Lunar($cur->format('Y-m-d')))->format('d/m')." Âm)";
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
 public function updateCompany(Request $req){
          
 
        DB::table("company_canlender")->where('id', $req->id)->update([
            'name'=>$req->name,
            
        ]);

        return Redirect()->back()->with('notification', 'cập nhật thông tin thành công');
    }

}