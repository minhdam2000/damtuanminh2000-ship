<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Credential;
use App\Broker;
use DB;
use Carbon\Carbon;
use File;
use App\Consumer;
use App\Job;
use App\Jobmoniters;
use App\Staff;
use App\Accountant;
use App\Department;
use App\Role;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\SimpleType\TblWidth;


class SystemController extends Controller
{   
    public function mytest(){
        $a = "oke";
         return view('buildingBK.mytest',compact('a'));
    }
    public function index(){ 
    // $zone = DB::Table("zone")->where("state",">",-1)->get();
    // foreach ($zone as $zone) {
    //     print($zone->name."<br>");
    // }

if(Auth()->user()->role == 2){

    $cid = DB::table("contractors")->where("email",Auth()->user()->email)->first()->id;

    $building_list = DB::table("buildingg")
    ->LeftJoin("buildingg_contractor","buildingg_contractor.building_id","buildingg.id")
    ->select("buildingg.id as id","buildingg.title as name")
    ->where("buildingg_contractor.contractor_id",$cid)
    ->get();

 return view('building.con-list',compact('building_list'));
}

if(Auth()->user()->role_id == 14 && $_SERVER['REQUEST_URI'] != "/map-config/4"){
    return  redirect("/draw-map");
}
    // dd();
    $did = DB::table("users")->where("id", Auth()->user()->id)->first()->department_id;
    $level =  1;

    $mess_count = DB::table("messages")->where("to_id",Auth()->user()->id)
    ->where("seen",0)->count();

    $thread_count = DB::table("participants")->where("user_id",Auth()->user()->id)
    ->whereRaw('last_read < updated_at')->count();



    // dd($thread_count);
    $mess = $mess_count + $thread_count;

    // dd(Auth()->user()->id);
    $job_lead = DB::table("job_noti")
            ->where("job_noti.user_id", Auth()->user()->id)
            ->where("job_noti.seen","<",1)
            ->count();
    // dd( $job_lead );

    $event = DB::table("event_noti")
            ->where("event_noti.user_id", Auth()->user()->id)
            ->where("event_noti.seen","<",1)
            ->count();




    $warehouse = DB::table("warehouse_noti")
            ->where("warehouse_noti.user_id", Auth()->user()->id)
            ->where("warehouse_noti.seen","<",1)
            ->count();



    $legal = DB::table("file_noti")
            ->where("file_noti.user_id", Auth()->user()->id)
            ->where("file_noti.seen","<",1)
            ->count();

     $job_all= DB::table("jobs")
    ->leftJoin('job_noti', 'job_noti.job_id', '=', 'jobs.id')
    ->where("job_noti.user_id", Auth()->user()->id)
    ->where("job_noti.seen","<",1)->count();
    // dd($job_all);



    $allow_list = [28,191,180,179];
    if(in_array(Auth()->user()->id, $allow_list)){

       $job = $job_all + $job_lead;
            return view('icon.boss',compact('mess','job','event',"legal"));
    }
     if(Auth()->user()->role_id == 5){
            return view('icon.ctv');
}
    
 if(Auth()->user()->role_id == 27){

    $zones= DB::table("zone")->where("consumer_id",Auth()->user()->id)->get();


  $event_list = DB::table("zone_consumer_alert")
    ->leftJoin('zone_alert_tag', 'zone_consumer_alert.id', '=', 'zone_alert_tag.alert_id')
    ->leftJoin('zone_tag', 'zone_alert_tag.tag_id', '=', 'zone_tag.id')
    ->select("zone_consumer_alert.title as title"
      ,"zone_consumer_alert.id as id","zone_consumer_alert.content as content" ,"zone_consumer_alert.created_at as time"
              ,DB::raw("group_concat(zone_tag.name SEPARATOR ', ') as tags")
    )
            ->groupBy('zone_consumer_alert.id')->get();





$owner = strtolower(DB::table("zone")->where("consumer_id",Auth()->user()->id)
            ->select(DB::raw("group_concat(zone.name SEPARATOR ', ') as zname"))
            ->groupBy('consumer_id')->first()->zname);


  // $tags = explode(",",$event_list[1]->tags);

//                         $check = 0;

//                         foreach($tags as $tag){
//                             echo $tag."<br>";
//                             echo $owner."<br>";
//                             echo strpos($tag,$owner)."<br>--------------------<br>";
//                             echo strpos($owner,$tag)."<br>--------------------<br>";
//                             if(strpos($owner,trim($tag)) > -1){
//                                 $check =1;
//                                 break;
//                             }
//                         }
// // dd(strpos("lk11-15","lk"));
// dd($check);


            return view('icon.consumer',compact('event_list','zones',"owner"));
}
   // dd($this->checkLead()); 
    if($this->checkAdmin()){
            return view('icon.admin',compact('mess'));

    }elseif($this->checkLeadDepart()){
            $job = $job_all + $job_lead;
            return view('icon.boss',compact('mess','job','event',"legal"));
    }elseif($this->checkHuman()){
                 $job = $job_all;
             
                    return view('icon.humandept',compact('mess','job'));
              }elseif($this->checkAccount()){
                 $job = $job_all;
             
                    return view('icon.accountant',compact('mess','job'));
              }else{
          if($this->checkSaleMap()){



                $startDate = Carbon::today();
                $endDate = Carbon::today()->addDays(7);

                $task = DB::table('zone_task')
                ->whereBetween('end_date', [$startDate, $endDate])->count();

                $pay = DB::table('zone_pay')
                ->whereBetween('date', [$startDate, $endDate])->count();

                $event = $task + $pay;


                if($this->checkLeadDepart()){
                $job = $job_all + $job_lead;
                    return view('icon.lead',compact('mess','job','event'));
                }else{
                    $job = $job_all;
                    // dd($job);
                    return view('icon.staff',compact('mess','job','event'));
                }
              }else{
                    $job = $job_all;
             
                    return view('icon.contribute',compact('mess','job'));

              }
        }
    }

    public function doc(){ 
    $did = Role::where("id", Auth()->user()->role_id)->first()->department_id;
    $level =  Role::where("id",Auth::user()->role_id)->first()->level;

          
    if($this->checkLead()){

            return view('doc.boss');
    }elseif($this->checkSaleMap()){
            return view('doc.staff');
       
      }else{
     
            return view('doc.contribute');

              }
        
    }

    public function DepartmentList(){
        $department = Department::get();
        return json_encode($department);
    }


    public function getZonePosition(){
        $department = DB::table("zone_posittion")->get();
        return json_encode($department);
    }

    public function staffList(){

        $did = Role::where("id",Auth::user()->role_id)->first()->department_id;
        $level =  Role::where("id",Auth::user()->role_id)->first()->level;

        $role_list = Role::where('department_id',$did)->where("level",">=",$level)->pluck('id')->toArray();
        $staffList = DB::table("users")->where("status",">",0)->whereIn("role_id",$role_list)->get();
        return json_encode($staffList);
    }

     public function staffEditList($id){
        $did = Role::where("id",Auth::user()->role_id)->first()->department_id;
        $level =  Role::where("id",Auth::user()->role_id)->first()->level;

        // $role_list = Role::where('department_id',$did)->where("level",">=",$level)->pluck('id')->toArray();
        // $staffList = DB::table("users")->where("status",">",0)->whereIn("role_id",$role_list)->get();

          $staffList = DB::table("users")->where("status",">",0)->get();

        $selected = DB::table("job_users")->where("job_id",$id)->pluck('user_id')->toArray();
        return json_encode([$staffList,$selected]);
    }

  public function sheduleStaffList($id){
    if($id > 0){

        $sid = DB::table("schedule_user")->where("schedule_id",$id)->pluck('user_id')->toArray();

        if(count($sid) > 0){

       $staffList =   DB::table("users")
        ->leftJoin('department', 'department.id', '=', 'users.department_id')
        ->select("users.id as id","users.name as name",
            "department.name as dname")
        ->whereIn("users.id",$sid)->get();

          }  else{
        $did = DB::table("schedule_department")->where("schedule_id",$id)->pluck('department_id')->toArray();

       $staffList =   DB::table("users")
        ->leftJoin('department', 'department.id', '=', 'users.department_id')
        ->select("users.id as id","users.name as name",
            "department.name as dname")
        ->whereIn("department.id",$did)
        ->get();
        }
    }else{
        $staffList =  DB::table("users")
        ->leftJoin('user_department', 'user_department.user_id', '=', 'users.id')
        ->leftJoin('department', 'department.id', '=', 'user_department.department_id')
        ->select("users.id as id","users.name as name"
              ,DB::raw("group_concat(DISTINCT(department.name) SEPARATOR ', ') as dname"))
        ->groupBy("users.id")
        ->where("department.id","<>",12)->get();
        }
        if($id > 0){
 $did = DB::table("schedule_department")->where("schedule_id",$id)->pluck('department_id')->toArray();

            $dept = DB::table("department")->whereIn("id",$did)->get();
}else{

            $dept = DB::table("department")->get();
}
        return json_encode([$staffList,$dept]);
    }

    public function  getThreadStaff($id){
        $uids = DB::table("schedule_user")->where("schedule_id",$id)->pluck("user_id")->toArray();


        $did = DB::table("schedule_department")->where("schedule_id",$id)->pluck('department_id')->toArray();

        $udids  =   DB::table("users")
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('department', 'department.id', '=', 'roles.department_id')
        ->whereIn("department.id", $did)->pluck('users.id')->toArray();

        $fuids = array_merge($uids,  $udids);


       $staffList =   DB::table("users")
        ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
        ->leftJoin('department', 'department.id', '=', 'roles.department_id')
        ->select("users.id as id","users.name as name", "roles.name as rname",
            "department.name as dname")
        ->whereIn("users.id",$fuids)
        ->get();
    

        $selected =[];
        return json_encode([$staffList,$selected]);

    }
   public function sheduleStaffSelect($id){
      
        $did = DB::table("schedule_department")->where("schedule_id",$id)->pluck('department_id')->toArray();

       $staffList =   DB::table("users")
        ->leftJoin('user_department', 'users.id', '=', 'user_department.user_id')
        ->leftJoin('department', 'department.id', '=', 'user_department.department_id')
        ->select("users.id as id","users.name as name",DB::raw("group_concat(department.name SEPARATOR ', ') as dname") )
        ->groupBy("users.id")
        ->where("users.status",">",0)
        ->where("users.admin_id",">",1)
        ->get();
    

        $selected = DB::table("schedule_user")->where("schedule_id",$id)->pluck('user_id')->toArray();
        return json_encode([$staffList,$selected]);
    }


       public function fileStaffSelect($id){
      
        // $did = DB::table("contribute_file_department")->where("schedule_id",$id)->pluck('department_id')->toArray();

       // $staffList =   DB::table("users")
       //  ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
       //  ->leftJoin('department', 'department.id', '=', 'roles.department_id')
       //  ->select("users.id as id","users.name as name", "roles.name as rname",
       //      "department.name as dname")
       //      ->where("status",">")

         $staffList=    DB::table("users")
        ->leftJoin('user_department', 'user_department.user_id', '=', 'users.id')
        ->leftJoin('department', 'department.id', '=', 'user_department.department_id')
        ->select("users.id as id","users.name as name"
              ,DB::raw("group_concat(DISTINCT(department.name) SEPARATOR ', ') as dname"))
        ->groupBy("users.id")
            ->where("users.status",">",0)->get();

    
    if($id > 0){
        $selected = DB::table("contribute_file_user")->where("file_id",$id)->pluck('user_id')->toArray();
        // dd($selected);
    }else{
        $selected = [];
    }
        return json_encode([$staffList,$selected]);
    }

 public function fileDeptSelect($id){
 

            $dept = DB::table("department")->get();
            if($id > 0){
        $selected = DB::table("contribute_file_department")->where("file_id",$id)->pluck('department_id')->toArray();
        // dd($selected);
    }else{
        $selected = [];
    }
        return json_encode([$dept,$selected]);
    
    }

 public function sheduleDeptSelect($id,$sid){
      
  // if($sid > 0 ){
  //                 $mys = DB::table("schedule")->where("id",$sid)->first();
  //                 $did = DB::table("schedule_department")->where("schedule_id",$mys->id)->pluck('department_id')->toArray();

  //           $dept = DB::table("department")->whereIn("id",$did)->get();
  //           }else{

  //           $dept = DB::table("department")->get();
  //           }

            $dept = DB::table("department")->get();

        $selected = DB::table("schedule_department")->where("schedule_id",$sid)->pluck('department_id')->toArray();
        // dd($selected);
        return json_encode([$dept,$selected]);
    }


    public function staffDepart($did){
        $role_list = Role::where('department_id',$did)->pluck('id')->toArray();
        $staffList = DB::table("users")->where("status",">",0)->whereIn("role_id",$role_list)->get();
        return json_encode($staffList);
    }

   public function staffDepartList($did,$id){
        $role_list = Role::where('department_id',$did)->pluck('id')->toArray();
        $staffList = DB::table("users")->where("status",">",0)->whereIn("role_id",$role_list)->get();
        $selected = DB::table("job_users")->where("job_id",$id)->pluck('user_id')->toArray();
        return json_encode([$staffList,$selected]);
    }



    public function wordEdit(){
            // $PHPWord = new PHPWord();

    $templateFile = 't1.docx';
    $templateObject = new \PhpOffice\PhpWord\TemplateProcessor($templateFile);

    $templateObject->setValue('location', 'Hà Nội');
    $templateObject->setValue('name', 'Trương Tiến Dũng');
    $templateObject->setValue('date', '1997');


    $table = new Table(array('borderSize' => 12, 'borderColor' => 'black', 'width' => 6000,'unit' => TblWidth::TWIP));
    for ($i= 0;$i <  3;$i ++) {
        $table->addRow();
        $table->addCell(3000)->addText("Tiến độ đợt");
        $table->addCell(2000)->addText($i);
    };
    $templateObject->setComplexBlock('table', $table);
    // $templateObject->saveAs('template_with_table.docx');

    $wordDocumentFile = $templateObject->saveAs("tt.docx");

    // $headers = [
    //     'Content-Type' => 'application/msword',
    //     'Cache-Control' => 'max-age=0'
    // ];

    // return response()->download($wordDocumentFile, 'result.docx', $headers);



    }
    public function IconBuild(){
                    return view('icon.building');

    }

    public function IconFinanceLine(){
           

        $fin_line =  DB::table("zone")
        ->leftJoin('zone_process', 'zone.id', '=', 'zone_process.zone_id')
        ->select(DB::raw("sum(final_price) as done"), DB::raw("sum(done) as dept"),   DB::raw("DATE_FORMAT(zone_process.created_at, '%m-%Y') as new_date"),  DB::raw('YEAR(zone_process.created_at) as year, MONTH(zone_process.created_at) as month'))->groupby('year','month')->get();


            $now = Carbon::now();
            $year =  $now->year;
            $month =  $now->month;
        
            $yearList = [];
            $doneList = [];
            $deptList = [];

            for ($i=1;$i<13;$i++ ){
                if ($i <= $month){
                    $yearList[] = $i."-".$year;
                }else{
                    $y = $year -1;
                    $yearList[] = $i."-".$y;
                }
            }
            // dd($yearList);
            foreach($yearList as $year){
                $done = 0;
                $dept = 0;
                foreach($fin_line as $fl){
                    if($year == $fl->new_date || "0".$year == $fl->new_date ){
                        $done = $done + $fl->done;
                        $dept = $dept + $fl->dept;
                    }
                }
                $doneList[] = $done;
                $deptList[] = $dept;
            }

            return json_encode([$yearList,$doneList,$deptList]);
    }

    public function IconFinance(){


               $fin_output = DB::table("finance_output")->select(DB::raw("sum(finance_output.amount) as amount"))->first()->amount;


               $fin_input= DB::table("finance_input")->select(DB::raw("sum(finance_input.amount) as amount"))->first()->amount;

                $fin_asset = DB::table("finance_asset")->select(DB::raw("sum(finance_asset.amount) as amount"))->first()->amount;


               $fin_dept= DB::table("finance_dept")->select(DB::raw("sum(finance_dept.amount) as amount"))->first()->amount;



               $total_acreage = DB::table("zone")->select(DB::raw("sum(acreage) as acreage"))->where("state",0)->first()->acreage;

               $total_buy = DB::table("zone")->select(DB::raw("sum(done) as done"))->first()->done;


       
               $output= DB::table("finance_output")
            ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
            ->select(DB::raw("sum(finance_output.amount) as amount"),DB::raw(" sum(finance_output.amount) /(SELECT sum(amount) from finance_output) as percent"),
          "finance_output_type.name as type_name","finance_output_type.id as type_id")->groupBy('type_id')
            ->where("finance_output.type","<>",9)
            ->get();

            $input = DB::table("finance_input")
            ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
            ->select(DB::raw("sum(finance_input.amount) as amount"),DB::raw(" sum(finance_input.amount) /(SELECT sum(amount) from finance_input) as percent"),
          "finance_input_type.name as type_name","finance_input_type.id as type_id")->groupBy('type_id')->get();

       
               $asset = DB::table("finance_asset")
            ->leftJoin('finance_asset_type', 'finance_asset.type', '=', 'finance_asset_type.id')
            ->select(DB::raw("sum(finance_asset.amount) as amount"),DB::raw(" sum(finance_asset.amount) /(SELECT sum(amount) from finance_asset) as percent"),
          "finance_asset_type.name as type_name","finance_asset_type.id as type_id")->groupBy('type_id')
            ->where("finance_asset_type.id","<>",9)
            ->get();

            $dept = DB::table("finance_dept")
            ->leftJoin('finance_dept_type', 'finance_dept.type', '=', 'finance_dept_type.id')
            ->select(DB::raw("sum(finance_dept.amount) as amount"),DB::raw(" sum(finance_dept.amount) /(SELECT sum(amount) from finance_dept) as percent"),
          "finance_dept_type.name as type_name","finance_dept_type.id as type_id")->groupBy('type_id')->get();


         $salary= DB::table("users")
             ->leftJoin('user_salary', 'user_salary.user_id', '=', 'users.id')
             ->where("users.admin_id",">",1)->where("users.status",">",0)
             ->select(DB::raw("sum(user_salary.salary) as salary"),
              DB::raw("sum(user_salary.kpi) as kpi"),
              DB::raw( "sum(user_salary.penalty) as penalty"))
             ->first();


          $salary_val  =  $salary->salary +  $salary->kpi -  $salary->penalty;
          $gap  =  DB::table("zone")
           ->select(
            DB::raw('sum(zone.gap) as gap'))
           ->first()->gap;

           $output_daily = DB::table("finance_output")
             ->select(DB::raw("sum(finance_output.amount) as amount"))
           ->where("finance_output.type",9)
            ->first()->amount;

            $daily = floatval($output_daily) + floatval($salary_val) + floatval($gap);

              $output_details= DB::table("finance_output")
         ->leftJoin('finance_output_type', 'finance_output.type', '=', 'finance_output_type.id')
         ->leftJoin('users', 'finance_output.user_id', '=', 'users.id')
         ->select("finance_output.id as id","finance_output.title as title",
          "finance_output.description as description","finance_output.amount as amount",
          "finance_output.type as type","finance_output.date as date","users.name as uname",
          "finance_output_type.name as name")
         ->get();


        $input_details= DB::table("finance_input")
         ->leftJoin('finance_input_type', 'finance_input.type', '=', 'finance_input_type.id')
         ->leftJoin('users', 'finance_input.user_id', '=', 'users.id')
         ->select("finance_input.id as id","finance_input.title as title",
          "finance_input.description as description","finance_input.amount as amount",
          "finance_input.type as type","finance_input.date as date","users.name as uname",
          "finance_input_type.name as name")
         ->get();

     
        $asset_details= DB::table("finance_asset")
         ->leftJoin('finance_asset_type', 'finance_asset.type', '=', 'finance_asset_type.id')
         ->leftJoin('users', 'finance_asset.user_id', '=', 'users.id')
         ->select("finance_asset.id as id","finance_asset.title as title",
          "finance_asset.description as description","finance_asset.amount as amount",
          "finance_asset.type as type","finance_asset.date as date","users.name as uname",
          "finance_asset_type.name as name")
         ->get();


$dept_details= DB::table("finance_dept")
         ->leftJoin('finance_dept_type', 'finance_dept.type', '=', 'finance_dept_type.id')
         ->leftJoin('users', 'finance_dept.user_id', '=', 'users.id')
         ->select("finance_dept.id as id","finance_dept.title as title",
          "finance_dept.description as description","finance_dept.amount as amount",
          "finance_dept.type as type","finance_dept.date as date","users.name as uname",
          "finance_dept_type.name as name")
         ->get();

        $output_type = DB::table("finance_output_type")->get();
        $input_type = DB::table("finance_input_type")->get();
        $asset_type = DB::table("finance_asset_type")->get();
        $dept_type = DB::table("finance_dept_type")->get();



            return view('icon.finance',compact('fin_output',"fin_input",
            "fin_asset","fin_dept","asset","dept",
            "total_acreage","total_buy","output","input"
            ,"daily","output_details","input_details"
            ,"asset_details","dept_details"
            ,"output_type","input_type","asset_type","dept_type"));

    }


    public function IconHuman(){
                    return view('icon.human');

    }


    public function IconLegal(){
              $legal = DB::table("file_noti")
                        ->where("file_noti.user_id", Auth()->user()->id)
                        ->where("file_noti.seen","<",1)
                        ->count();

            return view('icon.legal',compact('legal'));

    }


    public function IconReport(){
                    return view('icon.report');

    }


    public function IconSale(){
          $startDate = Carbon::today();
                $endDate = Carbon::today()->addDays(7);

                $task = DB::table('zone_task')
                ->whereBetween('end_date', [$startDate, $endDate])->count();

                $pay = DB::table('zone_pay')
                ->whereBetween('date', [$startDate, $endDate])->count();

                $event =0;

// $startDate = Carbon::today();
// $endDate = Carbon::today()->addDays(7);


$task = DB::table('zone_task')
->leftJoin('zone', 'zone_task.zone_id', '=', 'zone.id')
->leftJoin('staff_task', 'zone_task.task_id', '=', 'staff_task.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
 ->select("consumer.name as cname","consumer.phone_number as cphone","zone.name as zname","zone.id as zid"
    ,"zone_task.end_date as date","staff_task.name as sname")
 // ->where("zone.staff_id", Auth()->user()->id)
// ->whereBetween('end_date', [$startDate, $endDate])

->limit(100)->get();

// dd($task);
$pay = DB::table('zone_pay')
->leftJoin('zone', 'zone_pay.zone_id', '=', 'zone.id')
->leftJoin('consumer', 'zone.consumer_id', '=', 'consumer.id')
 ->select("consumer.name as cname","consumer.phone_number as cphone","zone.name as zname","zone.id as zid"
    ,"zone_pay.date as date","zone_pay.step as step","zone_pay.money as money")
 // ->where("zone.staff_id", Auth()->user()->id)
// ->whereBetween('date', [$startDate, $endDate])

 ->limit(100)->get();

 $zone_alert = DB::table("zone_staff_alert")
             ->where("user_id",Auth()->user()->id)
             ->where("seen",0)->pluck("zone_id")->toArray();

$zone_noti = DB::table("zone")->whereIn("id",$zone_alert)->get();


$consumer_noti = DB::table("consumer_noti")
            ->leftJoin("consumer","consumer.id","=","consumer_noti.consumer_id")
            ->select("consumer.id as id","consumer.name as name","consumer_noti.user_id as uid")
            ->where("consumer_noti.user_id",Auth()->user()->id)->get();



  $event_list = DB::table("zone_consumer_alert")
    ->leftJoin('zone_alert_tag', 'zone_consumer_alert.id', '=', 'zone_alert_tag.alert_id')
    ->leftJoin('zone_tag', 'zone_alert_tag.tag_id', '=', 'zone_tag.id')
    ->select("zone_consumer_alert.title as title"
      ,"zone_consumer_alert.id as id","zone_consumer_alert.content as content" ,"zone_consumer_alert.created_at as time"
              ,DB::raw("group_concat(zone_tag.name SEPARATOR ', ') as tags")
    )
            ->groupBy('zone_consumer_alert.id')->get();

// dd($event_list);
                    return view('icon.sale',compact("event_list",'event',"task","pay","zone_noti","consumer_noti"));

    }


    public function getAdminConfig(){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
      
        // dd(Auth::user()->role_id);
        $config = DB::table("config")
    ->leftJoin('department', 'config.dept_id', '=', 'department.id')
    ->select('config.id as id','config.var as var','config.value as value','config.name as cname','department.name as dname','department.id as did')
        ->get();
          $department = DB::table("department")->get();
        return view('variable.admin-var', compact('config','department')); 
    }

   public function getConfig(){
      if(!$this->checkAdmin()){
        return redirect("/");
      }

        $depart = DB::table("roles")->where("id", Auth()->user()->role_id)->first()->department_id;
        // dd(Auth::user()->role_id);
        $config = DB::table("config")
    ->leftJoin('department', 'config.dept_id', '=', 'department.id')
   ->select('config.id as id','config.var as var','config.value as value','config.name as cname','department.name as dname','department.id as did')
    ->where('dept_id',$depart)->get();

      $department = DB::table("department")->get();

        return view('variable.var', compact('config','department')); 


    }


    public function addNewConfig(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        DB::table("config")->insert([
            'name' => $req->name,
            'value' => $req->value,
            'var' => $req->var,
            'dept_id' => $req->dept_id
        ]);
            return Redirect()->back()->with('notification',' Đã tạo cấu hình thành công ');
    }


    public function editConfig(Request $req){
           if(!$this->checkAdmin()){
        return redirect("/");
      }
        DB::table("config")->where("id",$req->id)->update([
            'name' => $req->name,
            'value' => $req->value,
            'var' => $req->var,
            'dept_id' => $req->dept_id
        ]);
            return Redirect()->back()->with('notification',' Đã sửa cấu hình thành công ');
    }


    public function editConfigValue(Request $req){
             if(!$this->checkAdmin()){
        return redirect("/");
      }
        DB::table("config")->where("id",$req->id)->update([
            'value' => $req->value
        ]);
            return Redirect()->back()->with('notification',' Đã sửa cấu hình thành công ');
    }



 public function deleteConfig(Request $req){
        // print($req);
      if(!$this->checkAdmin()){
        return redirect("/");
      }
      
        $data = $req->post();
        $flag = 0;
        foreach ($data as $key => $value){
            if(is_int($key)){
                // print($key);
                try{
                    DB::table("config")->where("id",intval($key))->delete();
                }
                catch (\Exception $e) { 
                    $flag = 1;
                }
            }
        }
        if ($flag == 0){
                return Redirect()->back()->with('notification',' Đã xóa tất cả  cấu hình');
        }else{
                return Redirect()->back()->with('warning', 'Đã có lỗi xảy ra khi xóa  cấu hình');

        }
       
        

    }


 public function tag(Request $req){
    $tags = DB::table("tag_group")->get();
    foreach($tags as $tag){
        $tagArr = explode(",", $tag->tag);
        // dd(DB::table("tags")->select("name")->whereIn("id",$tagArr)->get()->toArray());
        $data = implode(",",DB::table("tags")->select("name")->whereIn("id",$tagArr)->pluck("name")->toArray());
        $tag->str = $data;
    }
     return view('variable.tag', compact('tags')); 
    

 }
public function deleteTagGroup($id){
     DB::table("tag_group")->where("id",$id)->delete();
    return Redirect()->back()->with('notification',' Đã xóa nhóm!');
     
    

 }
  public function addTagGroup(Request $request){ 

    $tags = explode(",", $request->tags);
    // dd($request->tags);
    $name = $request->name;
    $tagArr = "";


    $count = DB::table("tags")->where("name",$name)->count();
   if($count > 0){

    $tagArr = $tagArr.DB::table("tags")->where("name",$name)->first()->id.",";
   }else{
   $id = DB::table("tags")->insertGetId([
      "name"=>$name
    ]);
    $tagArr = $tagArr.$id.",";
    }
    // dd($tagArr);
    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr = $tagArr.DB::table("tags")->where("name",$tag)->first()->id.",";
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr = $tagArr.$id.",";
      }
    }

    // dd($tagArr);
    $tagArr = substr($tagArr, 0, -1);

    DB::table("tag_group")->insert([
        "name"=>$name,
        "tag"=>$tagArr
    ]);

    return Redirect()->back()->with('notification',' Đã thêm nhóm!');

 }

   public function editTagGroup(Request $request){ 


    $tags = explode(",", $request->tags);
    $name = $request->name;
    $tagArr = "";

    foreach ($tags as $tag) {
        $tag = trim($tag);
       $count = DB::table("tags")->where("name",$tag)->count();
       if($count > 0){

        $tagArr = $tagArr.DB::table("tags")->where("name",$tag)->first()->id.",";
       }else{
       $id = DB::table("tags")->insertGetId([
          "name"=>$tag
        ]);
        $tagArr = $tagArr.$id.",";
      }
    }
    // dd($request->id);

    $tagArr = substr($tagArr, 0, -1);
    DB::table("tag_group")->where("id",$request->id)->update([
      "name"=>$name,
        "tag"=>$tagArr
    ]);

    return Redirect()->back()->with('notification',' Đã thêm nhóm!');

 }


}